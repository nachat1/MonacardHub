<?php
header('Content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

require_once __DIR__ . '/../api_header.php';
require_once __DIR__ . '/../../classes/utils.php';

Utils::echo_error_json('Error message here.');

?>