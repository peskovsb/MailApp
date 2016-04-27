<?
session_start();

//--mail DB
//require '../../db.php';

//--itdept DB
require '../../db.php';
require 'arrFields.php';



$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();

$sql = 'INSERT INTO department (`company_id`,`department_name`) VALUES (:company_id,:department_name)';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':company_id'=>$_POST['comp_compn'],':department_name'=>$_POST['comp_depart']));


$sql = 'INSERT INTO itdeptdepartment (`company_id`,`department_name`,`staff_url_dept`,`staff_departmentsprting`,`dept_info`) VALUES (:company_id,:department_name,:staff_url_dept,:staff_departmentsprting,:dept_info)';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':company_id'=>$_POST['comp_compn'],':department_name'=>$_POST['comp_depart'],':staff_url_dept'=>$_POST['fld-create-url-dp-frm'],':staff_departmentsprting'=>$_POST['fld-create-sorting-dp-frm'],':dept_info'=>$_POST['fld-create-info-dp-frm']));


?>