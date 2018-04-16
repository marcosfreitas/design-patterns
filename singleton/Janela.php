<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


#somente 1 instancia no escopo da aplicaçao

class Janela {

    private static $dimension = null;

    private static function setDimensions() {
        self::$dimension = new stdClass();
        self::$dimension->width = 900;
        self::$dimension->height = 600;

        return self::$dimension;
    }


    public static function getInstance() {
        if (empty(self::$dimension)) {
            return self::setDimensions();
        }
        return self::$dimension;
    }

}


$j = Janela::getInstance();

print_r($j);