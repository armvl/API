<?php

require __DIR__.'/vendor/autoload.php';

const PATH_APP = __DIR__.'/src/';

require PATH_APP.'init/conf.php';
require PATH_APP.'init/errors.php';
require PATH_APP.'lib/common.php';
require PATH_APP.'lib/json.php';

$app = new \Api\App();
$app->guardRequest();
$app->runAction();
$app->display();