<?php
session_start();

$isPasswordProtected = false;
$hashedPassword = '$2a$12$wMwpjdVF1koCjqvlTKPlGeZ1aiJjnroho58ICR9FC18nWsUFQh3Lq';
$baseDirectory = __DIR__;
$allowRemoteDownload = true;

if ($isPasswordProtected) {
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        if (isset($_POST['password'])) {
            if (password_verify($_POST['password'], $hashedPassword)) {
                $_SESSION['authenticated'] = true;
            } else {
                die("Incorrect password.");
            }
        } else {
            echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <script>window.onload = function() { document.getElementById("password").focus(); };</script>
            </head>
            <body>
                <div class="container mt-5">
                    <form method="POST" class="text-center">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </body>
            </html>
            ';
            exit();
        }
    }
}

$currentDirectory = isset($_GET['dir']) ? $_GET['dir'] : '.';
$currentDirectory = realpath($currentDirectory) ?: realpath(__DIR__);

if (isset($_POST['create_folder'])) {
    $folderName = $_POST['folder_name'];
    $newFolderPath = $currentDirectory . '/' . $folderName;
    if (!is_dir($newFolderPath)) {
        mkdir($newFolderPath);
        echo "<script>alert('Folder created.');</script>";
    } else {
        echo "<script>alert('Folder already exists.');</script>";
    }
}

if (isset($_POST['create_file'])) {
    $fileName = $_POST['file_name'];
    $fileContent = $_POST['file_content'];
    $newFilePath = $currentDirectory . '/' . $fileName;
    file_put_contents($newFilePath, $fileContent);
    echo "<script>alert('File created.');</script>";
}

if (isset($_FILES['upload_file'])) {
    $uploadedFile = $_FILES['upload_file'];
    $destination = $currentDirectory . '/' . basename($uploadedFile['name']);
    if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {
        echo "<script>alert('File uploaded.');</script>";
    } else {
        echo "<script>alert('Error uploading file.');</script>";
    }
}

if (isset($_POST['rename_item'])) {
    $oldName = $_POST['old_name'];
    $newName = $_POST['new_name'];
    if (rename($currentDirectory . '/' . $oldName, $currentDirectory . '/' . $newName)) {
        echo "<script>alert('Renamed.');</script>";
    } else {
        echo "<script>alert('Error renaming.');</script>";
    }
}

if (isset($_POST['delete_item'])) {
    $itemName = $_POST['item_name'];
    $itemPath = $currentDirectory . '/' . $itemName;
    if (is_dir($itemPath)) {
        rmdir($itemPath);
        echo "<script>alert('Deleted.');</script>";
    } elseif (is_file($itemPath)) {
        unlink($itemPath);
        echo "<script>alert('Deleted.');</script>";
    } else {
        echo "<script>alert('Not found.');</script>";
    }
}

if (isset($_POST['unzip_file'])) {
    $zipFileName = $_POST['zip_file'];
    $zip = new ZipArchive;
    if ($zip->open($currentDirectory . '/' . $zipFileName) === TRUE) {
        $zip->extractTo($currentDirectory);
        $zip->close();
        echo "<script>alert('Unzipped.');</script>";
    } else {
        echo "<script>alert('Error unzipping.');</script>";
    }
}

if (isset($_POST['fetch_remote_file']) && $allowRemoteDownload) {
    $remoteUrl = $_POST['remote_url'];
    $fileName = basename($remoteUrl);
    $localPath = $currentDirectory . '/' . $fileName;
    if (@file_put_contents($localPath, @file_get_contents($remoteUrl))) {
        echo "<script>alert('Downloaded.');</script>";
    } else {
        echo "<script>alert('Error downloading.');</script>";
    }
}

if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = $currentDirectory . '/' . $file;

    if (is_file($filePath)) {
        echo file_get_contents($filePath);
        exit;
    } else {
        echo "File not found.";
        exit;
    }
}

if (isset($_POST['edit_file'])) {
    $fileName = $_POST['file_name'];
    $fileContent = $_POST['file_content'];
    $filePath = $currentDirectory . '/' . $fileName;
    if (file_put_contents($filePath, $fileContent) !== false) {
        echo "<script>alert('File edited.');</script>";
    } else {
        echo "<script>alert('Error editing file.');</script>";
    }
}

$items = scandir($currentDirectory);
$directories = [];
$files = [];
foreach ($items as $item) {
    if ($item === '.' || ($item === '..' && realpath($currentDirectory) === realpath(__DIR__))) continue;
    if (is_dir($currentDirectory . '/' . $item)) {
        $directories[] = $item;
    } else {
        $files[] = $item;
    }
}
sort($directories);
sort($files);

function formatSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        return $bytes . ' bytes';
    } elseif ($bytes == 1) {
        return '1 byte';
    } else {
        return '0 bytes';
    }
}

function generateBreadcrumbs($path) {
    $parts = explode(DIRECTORY_SEPARATOR, trim($path, DIRECTORY_SEPARATOR));
    $breadcrumbs = [];
    $currentPath = '';
    foreach ($parts as $part) {
        $currentPath .= DIRECTORY_SEPARATOR . $part;
        $breadcrumbs[] = '<a href="?dir=' . urlencode($currentPath) . '">' . htmlspecialchars($part) . '</a>';
    }
    return implode(' / ', $breadcrumbs);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>File Manager</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>.modal-card-body textarea {width: 100%;height: 300px;}</style>
</head>
<body>
<section class="section">
<div class="container">
<h1 class="title">File Manager</h1>
<nav class="breadcrumb" aria-label="breadcrumbs">
<ul>
<li><a href="?dir=<?php echo urlencode(realpath(__DIR__)); ?>">Home</a></li>
<?php echo generateBreadcrumbs($currentDirectory); ?>
</ul>
</nav>
<div class="box">
<h2 class="subtitle">Directory: <?php echo htmlspecialchars($currentDirectory); ?></h2>
<div class="columns">
    <div class="column">
        <form method="post" class="box">
            <h3 class="subtitle">New Folder</h3>
            <div class="field has-addons">
                <div class="control">
                    <input type="text" name="folder_name" class="input" placeholder="Name" required>
                </div>
                <div class="control">
                    <button type="submit" name="create_folder" class="button is-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
    <div class="column">
        <form method="post" enctype="multipart/form-data" class="box">
            <h3 class="subtitle">Upload</h3>
            <div class="field has-addons">
                <div class="control">
                    <input type="file" name="upload_file" class="input" required></div>
                <div class="control">
                    <button type="submit" class="button is-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
    <div class="column">
        <form method="post" class="box">
            <h3 class="subtitle">Remote File</h3>
            <div class="field has-addons">
                <div class="control">
                    <input type="url" name="remote_url" class="input" placeholder="URL" required>
                </div>
                <div class="control">
                    <button type="submit" name="fetch_remote_file" class="button is-primary">Fetch</button>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table is-fullwidth is-striped">
<thead>
<tr>
<th>Name</th>
<th>Size</th>
<th>Writable</th>
<th>Last Modified</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($directories as $dir): ?>
<tr>
<td><i class="fas fa-folder"></i> <a href="?dir=<?php echo urlencode($currentDirectory . '/' . $dir); ?>"><?php echo htmlspecialchars($dir); ?></a></td>
<td>-</td>
<td><?php echo is_writable($currentDirectory . '/' . $dir) ? 'Yes' : 'No'; ?></td>
<td><?php echo date("Y-m-d H:i:s", filemtime($currentDirectory . '/' . $dir)); ?></td>
<td>
<button class="button is-small is-info" onclick="renameItem('<?php echo htmlspecialchars($dir); ?>')">Rename</button>
<button class="button is-small is-danger" onclick="deleteItem('<?php echo htmlspecialchars($dir); ?>')">Delete</button>
</td>
</tr>
<?php endforeach; ?>
<?php foreach ($files as $file): ?>
<tr>
<td><i class="fas fa-file"></i> <?php echo htmlspecialchars($file); ?></td>
<td><?php echo formatSize(filesize($currentDirectory . '/' . $file)); ?></td>
<td><?php echo is_writable($currentDirectory . '/' . $file) ? 'Yes' : 'No'; ?></td>
<td><?php echo date("Y-m-d H:i:s", filemtime($currentDirectory . '/' . $file)); ?></td>
<td>
<button class="button is-small is-info" onclick="editFile('<?php echo htmlspecialchars($file); ?>')">Edit</button>
<button class="button is-small is-warning" onclick="renameItem('<?php echo htmlspecialchars($file); ?>')">Rename</button>
<button class="button is-small is-danger" onclick="deleteItem('<?php echo htmlspecialchars($file); ?>')">Delete</button>
<?php if (pathinfo($file, PATHINFO_EXTENSION) == 'zip'): ?>
<form method="post" style="display:inline;">
<input type="hidden" name="zip_file" value="<?php echo htmlspecialchars($file); ?>">
<button type="submit" name="unzip_file" class="button is-small is-link"><i class="fas fa-file-archive"></i> Unzip</button>
</form>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</section>
<div id="editModal" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Edit File</p>
      <button class="delete" aria-label="close" onclick="closeModal('editModal')"></button>
    </header>
    <section class="modal-card-body">
      <form id="editForm" method="post">
        <input type="hidden" id="editFileName" name="file_name">
        <textarea id="editFileContent" name="file_content"></textarea>
    </section>
    <footer class="modal-card-foot">
      <button type="submit" name="edit_file" class="button is-success">Save</button>
      <button class="button" onclick="closeModal('editModal')">Cancel</button>
      </form>
    </footer>
  </div>
</div>
<div id="renameModal" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Rename</p>
      <button class="delete" aria-label="close" onclick="closeModal('renameModal')"></button>
    </header>
    <section class="modal-card-body">
      <form id="renameForm" method="post">
        <input type="hidden" id="oldItemName" name="old_name">
        <div class="field">
          <label class="label">New Name:</label>
          <div class="control">
            <input class="input" type="text" id="newItemName" name="new_name" required>
          </div>
        </div>
    </section>
    <footer class="modal-card-foot">
      <button type="submit" name="rename_item" class="button is-success">Save</button>
      <button class="button" onclick="closeModal('renameModal')">Cancel</button>
      </form>
    </footer>
  </div>
</div>
<script>
function editFile(fileName) {
    fetch('?dir=<?php echo urlencode($currentDirectory); ?>&file=' + encodeURIComponent(fileName))
        .then(response => response.text())
        .then(content => {
            document.getElementById('editFileName').value = fileName;
            document.getElementById('editFileContent').value = content;
            openModal('editModal');
        });
}
function renameItem(itemName) {
    document.getElementById('oldItemName').value = itemName;
    document.getElementById('newItemName').value = itemName;
    openModal('renameModal');
}
function deleteItem(itemName) {
    if (confirm('Are you sure you want to delete this item?')) {
        let form = document.createElement('form');
        form.method = 'post';
        form.innerHTML = `
            <input type="hidden" name="item_name" value="${itemName}">
            <input type="hidden" name="delete_item" value="1">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
function openModal(modalId) {
    document.getElementById(modalId).classList.add('is-active');
}
function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('is-active');
}
document.querySelectorAll('.modal-background, .modal .delete, .modal .cancel').forEach(elem => {
    elem.addEventListener('click', (e) => {
        e.target.closest('.modal').classList.remove('is-active');
    });
});
</script>
</body>
</html>
