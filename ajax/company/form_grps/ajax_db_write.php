<?
session_start();

//--mail DB
//require '../../db.php';

//--itdept DB
require '../../db.php';
require 'arrFields.php';


$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();

$sql = 'INSERT INTO groups (`department_id`,`group_name`) VALUES (:department_id,:group_name)';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['gr_department'],':group_name'=>$_POST['gr_grps']));

$sql = 'INSERT INTO itdeptgroups (`department_id`,`group_name`,`staff_groupssprting`) VALUES (:department_id,:group_name,:staff_groupssprting)';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['gr_department'],':group_name'=>$_POST['gr_grps'],':staff_groupssprting'=>$_POST['fld-sorting-inf-grp']));


?>