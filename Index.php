<?php require_once('Koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_Koneksi, $Koneksi);
$query_RsPerangkat = "SELECT * FROM perangkat";
$RsPerangkat = mysql_query($query_RsPerangkat, $Koneksi) or die(mysql_error());
$row_RsPerangkat = mysql_fetch_assoc($RsPerangkat);
$totalRows_RsPerangkat = mysql_num_rows($RsPerangkat);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align='center'>

<table>
  <tr>
  	<td>
    <a href="tambah.php">Create</a>
    </td>
  </tr>
  
  <tr>
    <td>
    
    <table border="1" >
  <tr>
    <td>id</td>
    <td>nama</td>
    <td>jumlah</td>
    <td>aksi</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_RsPerangkat['id']; ?></td>
      <td><?php echo $row_RsPerangkat['nama']; ?></td>
      <td><?php echo $row_RsPerangkat['jumlah']; ?></td>
      <td>
      <a href="edit.php?id=<?php echo $row_RsPerangkat['id']; ?>">edit</a> &nbsp; &nbsp; 
      <a href="hapus.php?id=<?php echo $row_RsPerangkat['id']; ?>" onclick="return confirm('Apakah Data Ini Akan Dihapus?')">hapus</a></td>
    </tr>
    <?php } while ($row_RsPerangkat = mysql_fetch_assoc($RsPerangkat)); ?>
</table>
    
    </td>
  </tr>
</table>


</body>
</html>
</div>
<?php
mysql_free_result($RsPerangkat);
?>
