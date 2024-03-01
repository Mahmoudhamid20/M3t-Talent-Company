<?php
try {
    $db_handler = new PDO("mysql:host=mysql;dbname=login_db;charset=utf8", "root", "qwerty");
} catch (Exception $ex) {
    printError($ex);
}

function printError($err){
    echo "The following error occured
            <p>$err<?p>";
}


?>