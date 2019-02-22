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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE perangkat SET nama=%s, jumlah=%s WHERE id=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['jumlah'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Koneksi, $Koneksi);
  $Result1 = mysql_query($updateSQL, $Koneksi) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: index.php"));
}

$colname_RsEdit = "-1";
if (isset($_GET['id'])) {
  $colname_RsEdit = $_GET['id'];
}
mysql_select_db($database_Koneksi, $Koneksi);
$query_RsEdit = sprintf("SELECT * FROM perangkat WHERE id = %s", GetSQLValueString($colname_RsEdit, "int"));
$RsEdit = mysql_query($query_RsEdit, $Koneksi) or die(mysql_error());
$row_RsEdit = mysql_fetch_assoc($RsEdit);
$totalRows_RsEdit = mysql_num_rows($RsEdit);

mysql_free_result($RsEdit);
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Id</td>
      <td><?php echo $row_RsEdit['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nama</td>
      <td><input type="text" name="nama" value="<?php echo htmlentities($row_RsEdit['nama'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Jumlah</td>
      <td><input type="text" name="jumlah" value="<?php echo htmlentities($row_RsEdit['jumlah'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_RsEdit['id']; ?>">
</form>
<p>&nbsp;</p>
