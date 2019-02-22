<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Koneksi = "localhost";
$database_Koneksi = "inventaris";
$username_Koneksi = "root";
$password_Koneksi = "";
$Koneksi = mysql_pconnect($hostname_Koneksi, $username_Koneksi, $password_Koneksi) or trigger_error(mysql_error(),E_USER_ERROR); 
?>