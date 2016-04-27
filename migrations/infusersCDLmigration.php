<?session_start();
require_once '../ajax/db.php';

// -- Infoline Users Company, Department, Location migration


$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();
$sql = 'SELECT * FROM staff WHERE staff_profile_infoline != 0';
		$tb = $db->connection->prepare($sql);
		$tb->execute();
		$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($arrAll as $Items){
			
			/*echo 'ID: '.$Items['staff_id'].'<br>';
			echo 'loc: '.$Items['staff_location'].'<br>';
			echo 'company: '.$Items['staff_company_id'].'<br>';
			echo 'depart: '.$Items['staff_depart_id'].'<br>';
			echo 'group: '.$Items['staff_group_id'].'<br>';
			echo 'active: '.$Items['staff_active'].'<br>';*/
			
			
			
			
			/*$sql = 'SELECT * FROM infoline_users WHERE `lastname` = :lastname AND `firstname` = :firstname AND `middlename` = :middlename AND `cb_localphone`= :cb_localphone';
			$tb = $db_infoline->connection->prepare($sql);
			$tb->execute(array(':lastname'=>$Items['staff_lastname'],':firstname'=>$Items['staff_name'],':middlename'=>$Items['staff_secondname'],':cb_localphone'=>$Items['staff_ats']));
			$arrInf = $tb->fetch(PDO::FETCH_ASSOC);*/
			
			//echo $arrInf['id'].'<br>';
			
			//--Writing DB
			$sql = 'UPDATE infoline_users SET `staff_company_id`=:staff_company_id, `staff_location`=:staff_location, `staff_depart_id`=:staff_depart_id, `staff_group_id`=:staff_group_id, `staff_active`=:staff_active WHERE id = :id';
			$tb = $db_infoline->connection->prepare($sql);
			$tb->execute(array(':staff_company_id'=>$Items['staff_company_id'],':id'=>$Items['staff_profile_infoline'],':staff_location'=>$Items['staff_location'],':staff_depart_id'=>$Items['staff_depart_id'],':staff_group_id'=>$Items['staff_group_id'],':staff_active'=>$Items['staff_active']));
			
		}

?>