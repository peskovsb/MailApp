<?
require_once '../../../../../../ajax/db.php';
$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();?>

<?
$sql = 'SELECT * FROM infoline_users WHERE `lastname` = :lastname AND `firstname` = :firstname AND `middlename` = :middlename';
			$tb = $db_infoline->connection->prepare($sql);
			$tb->execute(array(':lastname'=>$_POST['staff_lastname'],':firstname'=>$_POST['staff_name'],':middlename'=>$_POST['staff_middlename']));
			$arrInf = $tb->fetch(PDO::FETCH_ASSOC);
?>
<?if($arrInf['id']){?>
1
<?
$sql = 'UPDATE staff SET `staff_profile_infoline`=:staff_profile_infoline WHERE staff_id = :staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_profile_infoline'=>$arrInf['id'],':staff_id'=>$_POST['staff_id']));
?>

<?}else{?>
0
<?}?>

