<?php

class Utils {

    public static function sanitized_echo($s) {
        echo htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }

    public static function sanitize($s) {
        return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }

    public static function echo_error_json($message) {
        header('Content-type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        exit('{"error":{"message":"'.$message.'"}}');
    }

}