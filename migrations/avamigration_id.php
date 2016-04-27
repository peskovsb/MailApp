<?require_once '../ajax/db.php';


$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();
$sql = 'SELECT * FROM infoline_users';
		$tb = $db_infoline->connection->prepare($sql);
		$tb->execute();
		$arrAll = $tb->fetchAll(PDO::FETCH_ASSOC);

		//echo '<pre>';print_r($arrAll);echo '</pre>';	
?>
<?foreach($arrAll as $Items){
	$sql = 'SELECT * FROM staff WHERE staff_profile_infoline = :id';
		$tb = $db->connection->prepare($sql);
		$tb->execute([':id'=>$Items['id']]);
		$arrUser = $tb->fetch(PDO::FETCH_ASSOC);
		if($arrUser['staff_id']){
			$sql = 'UPDATE staff SET `staff_avatar`=:staff_avatar WHERE staff_profile_infoline = :id';
			$tb = $db->connection->prepare($sql);
			$tb->execute(array(':staff_avatar'=>$Items['avatar'],':id'=>$Items['id']));
		}
		
	?>

<?}?>