<?php
return [

    /**
     * Database array support many database, just specify ids. Default db id is default
     */

    "database" =>
        [
            "ID"      => "default",
            "DRIVER"  => "mysql",
            "HOST"    => "localhost",
            "PORT"    => "",
            "USER"    => "root",
            "PSW"     => "muska88",
            "NAME"    => "phackpcms",
            "OPTIONS" => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"],
        ]

];