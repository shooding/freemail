<?php 
require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

use FreeMail\freemail;

var_dump (freemail::isFree('john@123.com'));
    