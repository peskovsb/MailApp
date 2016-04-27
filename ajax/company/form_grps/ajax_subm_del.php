<?
require '../../db.php';
$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();
$sql = 'DELETE FROM groups WHERE gr_id = :gr_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':gr_id'=>$_POST['dep_id']));

$sql = 'DELETE FROM itdeptgroups WHERE gr_id = :gr_id';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':gr_id'=>$_POST['dep_id']));
?>