<?php require_once('../../../Connections/connjxkh.php'); ?>
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

//$page=1;//$_GET['page'];
//$limit=5;//$_GET['limit'];
if(isset($_GET['menuid']))
	$menuid=$_GET['menuid'];
//echo $menuid;
$sql="SELECT * from MenuInfo  where MenuID=".$menuid;
//echo $sql;
mysql_query('SET NAMES UTF8');
mysql_select_db($database_connjxkh, $connjxkh);
$query_rsmenu =$sql;
$rsmenu = mysql_query($query_rsmenu, $connjxkh) or die(mysql_error());
// "SELECT * FROM MenuInfo";
//$q_sql=mysql_query($sql);
//while($res=mysql_fetch_assoc($q_sql)){
$sql2="SELECT * from MenuInfo  where MenuID=".$menuid;
$q_sql2=mysql_query($sql2);
$count=mysql_num_rows($q_sql2);
//echo $count;
$arr=array();
while($res=mysql_fetch_assoc($rsmenu)){	
	$arr[]=$res;
}
$data=array(
		'code'=>0,
		'msg'=>'',
		'count'=>$count,
		'data'=>$arr
	);
echo json_encode($data);
?>

<?php
mysql_free_result($rsmenu);
?>
