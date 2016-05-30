<?require 'ajax/db.php';

$db_infoline = new DatabaseInfoline();
$db_dept = new DatabaseItDept();
$sql = 'SELECT * FROM infoline_users';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute();
$data = $tb->fetchAll(PDO::FETCH_ASSOC);


//----
//**** AVATAR Migration
//----
//echo '<pre>';print_r($data);echo '<pre>';
foreach($data as $items){
$param1 = $items['lastname'];
$param2 = $items['firstname'];
$param3 = $items['middlename'];
$param4 = $items['cb_localphone'];
	$sql = 'UPDATE staff SET staff_avatar=:staff_avatar WHERE staff_lastname = :lastname AND staff_name = :firstname AND staff_secondname =:middlename AND staff_ats=:cb_localphone';
	$tb = $db_dept->connection->prepare($sql);
	$tb->execute(array(':lastname'=>$param1,':firstname'=>$param2,':middlename'=>$param3, ':cb_localphone'=>$param4, ':staff_avatar'=>$items['avatar']));
}

//----
//**** Happy Birthday Migration
//----

/*foreach($data as $items){
$param1 = $items['lastname'];
$param2 = $items['firstname'];
$param3 = $items['middlename'];
$param4 = $items['cb_localphone'];
	$sql = 'UPDATE staff SET staff_dr=:staff_dr WHERE staff_lastname = :lastname AND staff_name = :firstname AND staff_secondname =:middlename AND staff_ats=:cb_localphone';	
	$tb = $db_dept->connection->prepare($sql);
	$tb->execute(array(':lastname'=>$param1,':firstname'=>$param2,':middlename'=>$param3, ':cb_localphone'=>$param4, ':staff_dr'=>$items['cb_birthday1']));
}*/
?>
