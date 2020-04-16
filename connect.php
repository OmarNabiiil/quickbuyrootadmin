<?php

define('DB_SERVER', 'sql261.main-hosting.eu');
   define('DB_USERNAME', 'u574835608_admin');
   define('DB_PASSWORD', 'quickbuy');
   define('DB_DATABASE', 'u574835608_quick_buy');
   $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Connection failed!");
?>
