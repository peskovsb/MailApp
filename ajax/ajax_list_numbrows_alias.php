<?
session_start();
require 'db.php';
require 'secfile.php';
if($userLevel['oper_view_forw']==0){
	exit;
}

class mainpage_CountDB{
	public $arrC;
	public $db;
	function __construct(){
		$this->db = new Database();
	}
	function getSumm(){
		$sql = 'SELECT COUNT(alias_id) as DbSumm FROM aliases';
		$tb = $this->db->connection->prepare($sql);
		$tb->execute();
		$this->arrC = $tb->fetch(PDO::FETCH_ASSOC);
		return $this->arrC;
	}
}

//-- We count DB for DESC
$getSumm = new mainpage_CountDB();
$BDsumm = $getSumm -> getSumm();

echo json_encode($BDsumm)
?>