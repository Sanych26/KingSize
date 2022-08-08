<?php
    define("DBHOST" , "localhost");
    define("DBUSER" , "homestead");
    define("DBPASS" , "secret");
    define("DB" , "kingsize");

//    define("DBHOST" , "localhost");
//    define("DBUSER" , "o100644_dbuser");
//    define("DBPASS" , "cUfM=HJEQ~A_&kln");
//    define("DB" , "o100644_kingsize");

    $connection = @mysqli_connect( DBHOST, DBUSER, DBPASS, DB) or die("No connection to BD");
    mysqli_set_charset($connection , "utf8") or die("No charset");
?>


