<?
require '../../db.php';
$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();
$sql = 'DELETE FROM location WHERE location_id = :location_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location_id'=>$_POST['dep_id']));

$sql = 'DELETE FROM itdeptlocation WHERE location_id = :location_id';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':location_id'=>$_POST['dep_id']));
?>