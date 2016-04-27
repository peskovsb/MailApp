<?
require 'formArr.php';

//-- Params
$mistake = 0;

foreach ($formArr as $key => $Items) {
switch($key) {
case 'post_name':
	if(strlen($_POST[$Items['name']])==0){
		$rezArr[0][$key]['mistakeIU'] = 'mistake';
		$rezArr[0][$key]['msg'] = 'Ошибка в поле: "'.$Items['title'].' длина';
		$mistake = 1;
	}else{
		$rezArr[0][$key]['mistakeIU'] = 'nomistake';
	}
break;
case 'post_sort':
	if(strlen($_POST[$Items['name']])==0){
		$rezArr[0][$key]['mistakeIU'] = 'mistake';
		$rezArr[0][$key]['msg'] = 'Ошибка в поле: "'.$Items['title'].' длина';
		$mistake = 1;
	}else{
		if(preg_match("/[^0-9]+/", $_POST[$Items['name']])){
			$rezArr[0][$key]['mistakeIU'] = 'mistake';
			$rezArr[0][$key]['msg'] = 'Ошибка в поле: "'.$Items['title'];
			$mistake = 1;
		}else{
		   $rezArr[0][$key]['mistakeIU'] = 'nomistake';
		}
	}
break;
}
}
?>
