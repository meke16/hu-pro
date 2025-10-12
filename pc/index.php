<?php

// Get the page from URL, default to 'display'
$url = $_SERVER['REQUEST_URI'];

switch ($url) {
    case '/display':
        include 'display.php';
        break;

    case '/home':
        include 'home.php';
        break;

    default:
        echo "<h1>404 - Page Not Found</h1>";
        echo $url;
        break;
}
