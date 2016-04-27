<?
//-- MAIN REQUIRE FILES
require '../../../db.php';   //-- DataBase
require '../formArr.php';       //-- Fields Array

$db = new DatabaseItDept();

	$sql =  'SELECT * FROM postusers WHERE post_id = :id';
	$tb = $db->connection->prepare($sql);
	$tb->execute([':id'=>$_GET['id']]);
	$arrAll = $tb->fetch(PDO::FETCH_ASSOC);


//-- View TPL
require 'view_tpl.php';
require 'script_js.php';
?>