<?
require '../../db.php';
$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();

$sql = 'UPDATE department SET department_name=:department_name, company_id=:company_id WHERE department_id = :department_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['dep_id'],':company_id'=>$_POST['fld-comp-department-cor'],':department_name'=>$_POST['fld-dep-department-cor']));

$sql = 'UPDATE itdeptdepartment SET department_name=:department_name, company_id=:company_id, staff_url_dept=:staff_url_dept, staff_departmentsprting=:staff_departmentsprting, dept_info=:dept_info WHERE department_id = :department_id';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':department_id'=>$_POST['dep_id'],':company_id'=>$_POST['fld-comp-department-cor'],':department_name'=>$_POST['fld-dep-department-cor'],':staff_url_dept'=>$_POST['fld-dep-url-department-cor'],':staff_departmentsprting'=>$_POST['fld-dep-sorting-department-cor'],':dept_info'=>$_POST['fld-dep-info-department-cor']));
?>