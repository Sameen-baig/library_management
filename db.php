<?php
class db {
    protected $connection;
    function __construct(){
        $this->setconnection();
    }
    function setconnection(){
        try{
            $this->connection=new PDO("mysql:host=localhost;dbname=library_managment","root","");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("DB Connection error: ".$e->getMessage());
        }
    }
}
