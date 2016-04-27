<?
require '../../../db.php';

//-- MAIN validation CORE
require '../ajax_valid_body.php';

if($mistake == 0){
    //--Algorithm FIND free Field--
	$db = new DatabaseItDept();
	$db_infoline = new DatabaseInfoline();
	$sql =  'INSERT INTO postusers (post_name,post_sort) VALUES (:post_name,:post_sort)';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':post_name'=>trim($_POST['post_name']),':post_sort'=>$_POST['post_sort']));
	
	$sql =  'INSERT INTO itdeptpostusers (post_name,post_sort) VALUES (:post_name,:post_sort)';
	$tb = $db_infoline->connection->prepare($sql);
	$tb->execute(array(':post_name'=>trim($_POST['post_name']),':post_sort'=>$_POST['post_sort']));

}
?>
