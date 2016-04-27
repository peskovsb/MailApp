<?
require '../../db.php';
$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();

$sql = 'UPDATE groups SET group_name=:group_name, department_id=:department_id WHERE gr_id = :gr_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':gr_id'=>$_POST['dep_id'],':group_name'=>$_POST['fld-name-grps-cor'], ':department_id'=>$_POST['fld-comp-grps-cor']));

$sql = 'UPDATE itdeptgroups SET group_name=:group_name, department_id=:department_id, staff_groupssprting=:staff_groupssprting WHERE gr_id = :gr_id';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':gr_id'=>$_POST['dep_id'],':group_name'=>$_POST['fld-name-grps-cor'], ':department_id'=>$_POST['fld-comp-grps-cor'],':staff_groupssprting'=>$_POST['fld-sort-grps-cor']));
?>