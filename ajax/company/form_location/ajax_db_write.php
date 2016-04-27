<?
session_start();

//--mail DB
//require '../../db.php';

//--itdept DB
require '../../db.php';
require 'arrFields.php';

$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();

$sql = 'INSERT INTO location (`location_name`) VALUES (:location)';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location'=>$_POST['loca_location']));

$sql = 'INSERT INTO itdeptlocation (`location_name`,`location_url`,`staff_locationssprting`,`location_info`) VALUES (:location,:location_url,:staff_locationssprting,:location_info)';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':location'=>$_POST['loca_location'],':location_url'=>$_POST['cr-loc-url'],':staff_locationssprting'=>$_POST['cr-loc-sorting'],':location_info'=>$_POST['cr-loc-inform']));
?>