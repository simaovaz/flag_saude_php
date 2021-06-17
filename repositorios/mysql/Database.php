<?php


class Database 
{

    private const HOST= "localhost";
    private const USER= "simao_vaz";
    private const PASS= "simao_vaz";
    private const DATABASE= "flag_saude_v2";

    private static $connection;

    private function __construct(){}

    public static function db_connect() : mysqli
    {

        if(self::$connection === null){
            $db= new mysqli(self::HOST, self::USER,self::PASS, self::DATABASE);
            if(!$db->connect_error){
                self::$connection= $db;
                self::$connection-> set_charset("utf8mb4");
            }
        }
        return self::$connection;
    }

}


?>