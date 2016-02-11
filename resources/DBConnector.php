<?php

/**
 * Created by PhpStorm.
 * User: lorenzodaneo
 * Date: 11/02/16
 * Time: 16:17
 */
namespace UniLunch;


class DBConnector{

    private static $servername = "localhost";
    private static $dbname = "speed_food";
    private static $username = "root";
    private static $password = "";
    private static $connection;

    public function __construct(){
    }

    private static function openConnection(){
        self::$connection = mysqli_connect(self::$servername,self::$username,self::$password,self::$dbname);
        if(mysqli_connect_errno()){
            error_log("connect failed");
        }
    }

    private static function closeConnection(){
        mysqli_close(self::$connection);
    }

    public static function getRistoranti(){
        self::openConnection();
        $query_result = mysqli_query(self::$connection,"SELECT * FROM users");
        self::closeConnection();
        $result = array();
        while($user = mysqli_fetch_array($query_result)){
            $result[] = array(
                'id'=>$user['id'],
                'user'=>$user['user'],
                'email'=>$user['email'],
                'nome'=>$user['nome'],
                'descrizione'=>$user['descrizione'],
                'posizione'=>$user['posizione'],
                'img'=>$user['img']
            );
        }
        return json_encode($result);
    }

}