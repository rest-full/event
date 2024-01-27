<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/pathServer.php';

use Example\Control;

echo (new Control())->eventProccessValidation('beforeFilter');