<?
session_start();
require '../../../../../ajax/db.php';

$db = new DatabaseItDept();
$sql = 'SELECT * FROM postusers WHERE post_name=:post_name';
$tb = $db->connection->prepare($sql);
$tb->execute([':post_name'=>$_POST['postuser']]);
$arPosts = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM postusers ORDER by post_sort DESC';
$tb = $db->connection->prepare($sql);
$tb->execute([':post_name'=>$_POST['postuser']]);
$arAllPosts = $tb->fetchAll(PDO::FETCH_ASSOC);

if($arPosts['post_id']){
	echo '';
}else{
	echo '';
}?>