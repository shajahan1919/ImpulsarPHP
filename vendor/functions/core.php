<?php

// Define a constant for the URL directory separator if not already defined.
if (!defined('URL_DIRECTORY_SEPARATOR')) {
    define('URL_DIRECTORY_SEPARATOR', '/');
}

/**
 * Polyfill for the `array_key_first` function if it doesn't exist.
 *
 * This function retrieves the first key of an array.
 *
 * @param array $arr The input array.
 * @return mixed The first key of the array, or NULL if the array is empty.
 *
 * Example:
 * ```php
 * $array = ['a' => 1, 'b' => 2];
 * echo array_key_first($array); // Outputs: a
 * ```
 */
if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
        foreach ($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}

/**
 * Check if a given URL starts with a specified key (case-insensitive).
 *
 * @param string|null $key The key to check against.
 * @param string|null $url The URL to verify.
 * @return bool Returns true if the URL starts with the key, false otherwise.
 *
 * Example:
 * ```php
 * echo checkForAPI('api', 'api/users'); // Outputs: true
 * echo checkForAPI('admin', 'api/users'); // Outputs: false
 * ```
 */
function checkForAPI($key, $url) {
    $key = (!is_null($key)) ? $key : '';
    $url = (!is_null($url)) ? $url : '';

    return strtolower(substr(trim($url), 0, strlen(trim($key)))) == strtolower(trim($key));
}

/**
 * Apply server settings from an array of configurations.
 *
 * @param array $settings Associative array of settings (key-value pairs).
 * 
 * Example:
 * ```php
 * save_server_settings(['display_errors' => true, 'memory_limit' => '256M']);
 * ```
 */
function save_server_settings($settings) {
    foreach ($settings as $key => $value) {
        if ($key == 'DISPLAY_ERRORS') {
            error_reporting($value ? E_ALL : 0);
        } else {
            ini_set($key, $value);
        }
    }
}

/**
 * Parse a URL against a given URL pattern.
 *
 * @param string $urlpattern The URL pattern with placeholders (e.g., "/user/{id}/profile").
 * @param string $url The actual URL to be matched (e.g., "/user/123/profile").
 * @return bool Returns true if the URL matches the pattern, false otherwise.
 *
 * Example:
 * ```php
 * echo parseWebURL('/user/{id}/profile', '/user/123/profile'); // Outputs: true
 * ```
 */
function parseWebURL($urlpattern, $url) {
    $urlpattern = trimCornerSlashes($urlpattern);
    $url = trimCornerSlashes($url);

    $urlptrnar = explode(URL_DIRECTORY_SEPARATOR, ltrim($urlpattern, URL_DIRECTORY_SEPARATOR));
    $urlar = explode(URL_DIRECTORY_SEPARATOR, ltrim($url, URL_DIRECTORY_SEPARATOR));
    $ptrsize = count($urlptrnar);
    $urlsize = count($urlar);

    if ($urlpattern === $url) {
        return true;
    } elseif ($urlsize >= $ptrsize) {
        $flag = 0;
        for ($index = 0; $index < $ptrsize; $index++) {
            $pstr = trim($urlptrnar[$index]);
            $ustr = trim($urlar[$index]);
            if (substr($pstr, 0, 1) === "{") {
                // Placeholder match
                $flag++;
            } else {
                if ($pstr === $ustr) {
                    $flag++;
                }
            }
        }
        return $flag === $ptrsize;
    } else {
        return false;
    }
}

/**
 * Get the full base URL of the current request.
 *
 * @return string The complete URL including protocol and domain.
 *
 * Example:
 * ```php
 * echo getURLS(); // Outputs: http://example.com/
 * ```
 */
function getURLS() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'] . URL_PATH . '/';
    return $protocol . $domainName;
}

/**
 * Get the domain name of the current request.
 *
 * @return string The domain name with or without a subdirectory, depending on HOSTED_DIR.
 *
 * Example:
 * ```php
 * echo getDomain(); // Outputs: example.com or example.com/subdir
 * ```
 */
function getDomain() {
    if (HOSTED_DIR == '') {
        $domainName = $_SERVER['HTTP_HOST'];
    } else {
        $domainName = $_SERVER['HTTP_HOST'] . URL_PATH;
    }

    return $domainName;
}

/**
 * Trim corner slashes from a string.
 *
 * @param string $string The input string.
 * @param string $position The position to trim ('both', 'left', or 'right').
 * @return string The string with slashes removed from the specified position.
 *
 * Example:
 * ```php
 * echo trimCornerSlashes('/user/profile/', 'both'); // Outputs: user/profile
 * ```
 */
function trimCornerSlashes($string, $position = 'both') {
    if ($position === "both") {
        if (substr($string, 0, 1) === URL_DIRECTORY_SEPARATOR) {
            $string = substr($string, 1);
        }
        if (substr($string, -1) === URL_DIRECTORY_SEPARATOR) {
            $string = substr($string, 0, -1);
        }
    } elseif ($position === "left") {
        if (substr($string, 0, 1) === URL_DIRECTORY_SEPARATOR) {
            $string = substr($string, 1);
        }
    } elseif ($position === "right") {
        if (substr($string, -1) === URL_DIRECTORY_SEPARATOR) {
            $string = substr($string, 0, -1);
        }
    }
    return $string;
}

/**
 * Set HTTP headers if they have not been sent.
 *
 * @param string $headers The header to be sent.
 *
 * Example:
 * ```php
 * set_header('Content-Type: application/json');
 * ```
 */
function set_header($headers) {
    if (!headers_sent()) {
        header($headers);
    }
}

/**
 * Automatically load PHP files from a specified directory.
 *
 * @param string $functionsDir The directory containing the PHP files.
 *
 * Example:
 * ```php
 * autoLoadFiles('/path/to/functions/');
 * ```
 */
function autoLoadFiles($functionsDir) {
    foreach (glob($functionsDir . '*.php') as $file) {
        require_once $file;
    }
}

?>
