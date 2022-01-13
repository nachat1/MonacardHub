<?php

class Utils {

    public static function sanitized_echo($s) {
        echo htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }

    public static function sanitize($s) {
        return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }

}