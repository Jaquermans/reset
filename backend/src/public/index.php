<?php
    require __DIR__.'/../../../vendor/autoload.php';

    $app = (new reset\app())->bootstrap();//Anonymus Class
    $app->run();
