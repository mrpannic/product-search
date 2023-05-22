<?php

class Request {

    private static $fields = [];
    
    public static function all() {
        if(!self::$fields)
            self::$fields = array_merge($_GET, $_POST, requestBody());

        return self::$fields;
    }   

    public static function get($fieldName) {
        return self::all()[$fieldName];
    }

    public static function only($fields = []) {
        $selectedFields = [];
        $requestData = self::all();
        foreach($fields as $field) {
            if(isset($requestData, $field))
                $selectedFields[$field] = $requestData[$field];
        }

        return $selectedFields;
    }
}