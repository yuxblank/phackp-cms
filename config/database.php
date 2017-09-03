<?php
return [

    /**
     * Database array support many database, just specify ids. Default db id is default
     */

    "database" =>
        [
            "ID"      => "default",
            'DSN'     => "mysql:host=localhost;dbname=phackpcms",
            "USER"    => "root",
            "PSW"     => "muska88",
            "OPTIONS" => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"],
        ]

];