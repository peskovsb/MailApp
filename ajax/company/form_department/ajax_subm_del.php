<?
require '../../db.php';
$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();
$sql = 'DELETE FROM department WHERE department_id = :department_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['dep_id']));

$sql = 'DELETE FROM itdeptdepartment WHERE department_id = :department_id';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['dep_id']));
?>