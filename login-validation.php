<?php
    // echo "Hello World!"."<br/>";
    // echo $_POST["email"]."<br/>".$_POST["password"];

use function PHPSTORM_META\type;

    $useremail = $_POST["email"];
    $userpassword = md5($_POST["password"]);
    
    $file = fopen("credentials.txt","r+");
    
    $host = fgets($file);
    $user = fgets($file);
    $pass = fgets($file);
    $dbName = fgets($file);
    $tableName = fgets($file);
    
    fclose($file);
    
    // echo $host."    ".gettype($host)."<br/> ";
    // echo $user."    ".gettype($user)."<br/> ";
    // echo $pass."    ".gettype($pass)."<br/> ";
    // echo $dbName."    ".gettype($dbName)."<br/> ";
    // echo $tableName."    ".gettype($tableName)."<br/> ";
    
    $host = str_replace(array("\n", "\r"),'',$host);
    $user = str_replace(array("\n", "\r"),'',$user);
    $pass = str_replace(array("\n", "\r"),'',$pass);
    $dbName = str_replace(array("\n", "\r"),'',$dbName);
    $tableName = str_replace(array("\n", "\r"),'',$tableName);

    $dsn = "mysql:host=".$host.";dbname=".$dbName;
    // echo "<br/> ".$dsn;

    try{
        $db_con = new PDO($dsn, $user, $pass);

        $db_con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo "DB Connected";

        $qur = "SELECT USER_NAME, USER_EMAIL, USER_PASSWORD FROM $tableName";
        $query = $db_con->prepare($qur);
        $query -> execute();
        $query -> setFetchMode(PDO::FETCH_ASSOC);
        $data = $query -> fetchAll();
        echo "<br/>";

        // foreach($data as $key1=>$main_value){
        //     echo $key."   ";
        //     foreach($main_value as $key2=>$value){
        //         echo $value;
        //     }
        //     echo "<br/><br/><br/>";
        // }
        foreach(new RecursiveArrayIterator($data) as $key=>$value){
            // echo $value["USER_NAME"]."    ".$value["PASSWORD"]."<br/>";
            
            if(($useremail == $value["USER_EMAIL"]) &&  $userpassword == $value["USER_PASSWORD"])
            {
                echo "Hello ". $value["USER_NAME"] ." You'r Loged In ";
                // echo "<bt/> ".$_POST["password"].' '.$value["PASSWORD"];
                die();
                echo "<br/> not die";
            }
        }
        echo "<br/>Credentials Incorrect <br/>";

        // print_r($data);
        
    }catch(PDOException $e){
        echo "DB Connection Error : ";
        echo $e->getMessage();
    }

    // if($db_con->PDO)
    $db_con = null;
?>