<?
//-- MAIN REQUIRE FILES
require '../../../db.php';   //-- DataBase
require '../formArr.php';       //-- Fields Array

$db = new Database();

	/*$sql =  'SELECT * FROM models WHERE main_link = :main_link';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':main_link'=>$_GET['model_link']));
	$arrBest = $tb->fetch(PDO::FETCH_ASSOC);*/


//-- View TPL
require 'view_tpl.php';
require '../script_js.php';
?>