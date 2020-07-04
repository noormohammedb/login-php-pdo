<?php
    // echo "Hello World!"."<br/>";
    // echo $_POST["email"]."<br/>".$_POST["password"];

    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "test";
    $dsn = "mysql:host=".$host.";dbname=".$dbName;

    try{
        $db_con = new PDO($dsn, $user, $pass);

        $db_con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "DB Connected";
    }catch(PDOException $e){
        echo "DB Connection Error : ";
        echo $e->getMessage();
    }

    // if($db_con->PDO)

?>