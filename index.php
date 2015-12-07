<?php
/**
 * User: Miguel
 * Date: 22/11/2015
 * Time: 11:30
 */
session_start();
//session_destroy();
require_once 'vendor/autoload.php';

use Controller\Battleship;

$controller = new Battleship();
$controller->runAction();
