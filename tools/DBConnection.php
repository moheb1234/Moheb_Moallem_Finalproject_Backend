<?php

class DBConnection
{
    /** @var mysqli $dbConnection */
    private static mysqli $dbConnection;
    /**
     * @return false|mysqli|null
     * @throws Exception
     */
    public static function getDbConnection()
    {

           self::$dbConnection =  mysqli_connect('localhost','root',
               'Moheb.moallem73','film_schema');
           if (!self::$dbConnection){
               throw new Exception("some thing is wrong");
           }

        return self::$dbConnection;
    }
}