<?
session_start();

//--mail DB
require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';

if($userLevel['oper_correct_staff']=='1'){

//--itdept DB
//require '../../../db.php';
require 'arrFields.php';

/*$_POST['staff_id_trasher']
$_POST['staff_type_trasher']
$_POST['staff_date_trasher']*/

$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();

$sql = 'UPDATE staff SET staff_active=1, staff_datedeactive=:staff_datedeactive, staff_typedeactive=:staff_typedeactive WHERE staff_id=:staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_id'=>$_POST['staff_id_trasher'],':staff_typedeactive'=>$_POST['staff_type_trasher'],':staff_datedeactive'=>date('Y-m-d',strtotime($_POST['staff_date_trasher']))));

$sql = 'UPDATE infoline_users SET staff_active=1, staff_typedeactive=:staff_typedeactive WHERE id=:id';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':id'=>$_POST['staff_profile_infoline'],':staff_typedeactive'=>$_POST['staff_type_trasher']));
}
?>