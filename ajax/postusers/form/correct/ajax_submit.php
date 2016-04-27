<?
require '../../../db.php';

//-- MAIN validation CORE
require '../ajax_valid_body.php';

if($mistake == 0){
    //--Algorithm FIND free Field--
	$db = new DatabaseItDept();
	$db_infoline = new DatabaseInfoline();
	$sql =  'UPDATE postusers SET post_name=:post_name, post_sort=:post_sort WHERE post_id=:id';
	$tb = $db->connection->prepare($sql);
	$tb->execute([':post_name'=>trim($_POST['post_name']),':post_sort'=>$_POST['post_sort'],':id'=>$_POST['id']]);
	
	$sql =  'UPDATE itdeptpostusers SET post_name=:post_name, post_sort=:post_sort WHERE post_id=:id';
	$tb = $db_infoline->connection->prepare($sql);
	$tb->execute([':post_name'=>trim($_POST['post_name']),':post_sort'=>$_POST['post_sort'],':id'=>$_POST['id']]);
}
?>
