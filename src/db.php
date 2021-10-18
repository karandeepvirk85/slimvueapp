<?php 
// Class Database
Class DataBase{
    // host
    private $strHost = 'localhost';
    // User
    private $strUser = 'root';
    // Password
    private $strPassword = '';
    // DB Name
    private $strDb = 'personal';
    // Connect Function
    public function connectDB(){
       $dbConn = new PDO('mysql:host=localhost;dbname='.$this->strDb,$this->strUser, $this->strPassword);
       $dbConn->setAttribute(PDO::ERRMODE_EXCEPTION,PDO::ERRMODE_WARNING);
       return $dbConn;
    }
}

?>