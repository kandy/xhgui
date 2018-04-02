<?php
/**
 * this is a router file for the php Built-in web server
 * https://secure.php.net/manual/en/features.commandline.webserver.php
 *
 * It provides the same "rewrites" as the .htaccess for apache,
 * or the nginx.conf.sample for nginx.
 *
 * example usage: php -S 127.0.0.41:8082 -t ./pub/ router.php
 */


/**
 * Note: the code below is experimental and not intended to be used outside development environment.
 * The code is protected against running outside of PHP built-in web server.
 */

if (php_sapi_name() === 'cli-server') {
    $path = $_SERVER["SCRIPT_FILENAME"];

    switch (pathinfo($path, PATHINFO_BASENAME)) {
        case 'index.php':
        case 'api.php':
            include $path;
            return true;
            break;
        default:
            return false;
    }
}
