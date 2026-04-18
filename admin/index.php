<?php

// Load application config (error reporting, database credentials etc.)
require 'config/config.php';

// The auto-loader to load the php-login related internal stuff automatically
require 'config/autoload.php';


// The Composer auto-loader (official way to load Composer contents) to load external stuff automatically
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

// Start our application
$app = new application();
