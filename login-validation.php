<?php
    // echo "Hello World!"."<br/>";
    // echo $_POST["email"]."<br/>".$_POST["password"];

    $useremail = $_POST["email"];
    $userpassword = md5($_POST["password"]);

    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "test";
    $dsn = "mysql:host=".$host.";dbname=".$dbName;

    try{
        $db_con = new PDO($dsn, $user, $pass);

        $db_con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo "DB Connected";


        $query = $db_con->prepare("SELECT USER_NAME, USER_EMAIL, USER_PASSWORD FROM login_details");
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