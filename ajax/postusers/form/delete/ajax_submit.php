<?
require '../../../db.php';

if($_POST['id']){
    //--Algorithm FIND free Field--
	$db = new DatabaseItDept();
	$db_infoline = new DatabaseInfoline();
	$sql =  'DELETE FROM postusers WHERE post_id=:id';
	$tb = $db->connection->prepare($sql);
	$tb->execute([':id'=>$_POST['id']]);
	
	$sql =  'DELETE FROM itdeptpostusers WHERE post_id=:id';
	$tb = $db_infoline->connection->prepare($sql);
	$tb->execute([':id'=>$_POST['id']]);
}
?>
