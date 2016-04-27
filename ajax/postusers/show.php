<?
	require '../../ajax/db.php';
	$db = new DatabaseItdept();
	$sql = 'SELECT * from postusers ORDER by post_sort DESC;';
	$tb = $db->connection->prepare($sql);
	$tb->execute();
	$allData = $tb->fetchAll(PDO::FETCH_ASSOC);
	
	require '../company/menu_tabs.php';
?>



<h2 class="inUheader" style="float:none;">Должности</h2>

<a class="btn green" id="post_createpost" style="margin:10px 0 20px 0;" href="javascript:void(0);">Создать должность</a>

<?
$SummArr = count($allData);

if($SummArr>0){
	
	echo '
		<table class="table-tpl" border="1" bordercolor="#ccc" style="width:650px;">
			<thead>
			<tr>
				<th>id</th>
				<th>Название</th>
				<th>Сортировка</th>
				<th style="text-align:center;width: 128px;">Действие</th>
			</tr>
			</thead>
			<tbody>';  
				foreach($allData as $items){
					echo "
					<tr>
						<td>{$items['post_id']}</td>
						<td>{$items['post_name']}</td>
						<td>{$items['post_sort']}</td>
						<td style=\"text-align: center;width: 128px;\">
							<a data-db-id=\"{$items['post_id']}\" class=\"corr-btn-tbl\" id=\"cor-postusers-field\" href=\"javascript:void(0)\" style=\"margin-right:7px;\"><i class=\"fa fa-wrench\"></i></a>
							<a data-db-id=\"{$items['post_id']}\" class=\"del-btn-tbl redbtn\" id=\"del-postusers-field\" href=\"javascript:void(0)\"><i class=\"fa fa-trash-o\"></i></a>
						</td>
					</tr>";
				}
	echo '</table>';
	
}else{
	echo '<p>Должностей нет</p>';
}
?>

