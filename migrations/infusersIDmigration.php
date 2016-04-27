<?session_start();
require_once '../ajax/db.php';

$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();
$sql = 'SELECT * FROM staff';
		$tb = $db->connection->prepare($sql);
		$tb->execute();
		$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($arrAll as $Items){
			
			if($Items['staff_ats'] == 0) {$Items['staff_ats'] = '';}
			
			$sql = 'SELECT * FROM infoline_users WHERE `lastname` = :lastname AND `firstname` = :firstname AND `middlename` = :middlename';
			$tb = $db_infoline->connection->prepare($sql);
			$tb->execute(array(':lastname'=>$Items['staff_lastname'],':firstname'=>$Items['staff_name'],':middlename'=>$Items['staff_secondname']));
			$arrInf = $tb->fetch(PDO::FETCH_ASSOC);
			
			//echo $arrInf['id'].'<br>';
			
			//--Writing DB
			$sql = 'UPDATE staff SET `staff_profile_infoline`=:staff_profile_infoline WHERE staff_id = :staff_id';
			$tb = $db->connection->prepare($sql);
			$tb->execute(array(':staff_profile_infoline'=>$arrInf['id'],':staff_id'=>$Items['staff_id']));
			
		}
	// -- Путанница возникнет только с Дмитриевамми Аннами!!!!
?>