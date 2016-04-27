<?
//-- params
$formId = 'PosrUser';
$prefix = 'post';
$nameSender = 'Создать должность';
$nameCorrectSender = 'Редактировать должность';
$formBuild = $prefix.'_'.$formId;
$jsScriptUrl = 'ajax/postusers/form';

$formArr = [
	'post_name' =>
		[
			'name' => $prefix.'_name',
			'title' => 'Название должности'
		],
	'post_sort' =>
		[
			'name' => $prefix.'_sort',
			'title' => 'Сортировка'
		],
	];
?>