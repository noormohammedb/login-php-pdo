<?php
    // echo "User Name : ".$_POST["user_name"]."<br/>E-mail : ".$_POST["email"]."<br/>Password : ".$_POST["password"]."<br/>";

    $username = $_POST["user_name"];
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

    // echo "<br/> md5 : ". md5($_POST["password"]). "<br/>";

    try{
        $db_con = new PDO($dsn,$user,$pass);

        $db_con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo "<br/> DB Connected <br/>";

        // $query = $db_con -> prepare("INSERT INTO login (USER_NAME, EMAIL, PASSWORD) VALUES ($_POST["user_name"], $_POST["email"], md5($_POST["password"]))")
        // $query = "INSERT INTO login (USER_NAME, PASSWORD)\n VALUES ('".$useremail."', ".$userpassword."');";
        // $query = "INSERT INTO login_details (USER_NAME, USER_EMAIL, USER_PASSWORD) VALUES ('$useremail', `$useremail`, '$userpassword');";
        $query = "INSERT INTO login_details (USER_NAME, USER_EMAIL, USER_PASSWORD) VALUES ('$username','$useremail','$userpassword');";
        // echo "<br/>".$query."<br/>";
        $db_con -> exec($query);
        // $query -> setFetchMode(PDO::FETCH_ASSOC);
        // $data = $query -> fetchAll();

        // echo "<br/> Insertion Sucess <br/>";
		echo '<br/> Signup Success <br/> <a href="index.html">please login</a>';
    }
    catch(PDOException $e){
        echo "DataBase Connection Error <br/>CONTACT ADMINISTRATOR".$e;
    }
    
?>