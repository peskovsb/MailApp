<?session_start();
//--itdept DB
//require '../../../../db.php';
//require 'arrFields.php';
require '../../../../../../ajax/db.php';
require '../../../../../../ajax/secfile.php';
require '../pref_comp.php';
require '../../../../../../config.php';


$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();
$dbMail = new Database();
//$db_infoline = new DatabaseInfoline();

//--Params
$staff_id = $_GET['id'];


$sql = 'SELECT * FROM staff LEFT JOIN postusers ON postusers.post_id=staff.staff_post WHERE staff_id = :staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_id'=>$staff_id));
$arRezlt = $tb->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM postusers';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arPosts = $tb->fetchAll(PDO::FETCH_ASSOC);

if($arRezlt['staff_profile_infoline']!=0){
	$sql = 'SELECT * FROM infoline_users WHERE id = :staff_id';
	$tb = $db_infoline->connection->prepare($sql);
	$tb->execute(array(':staff_id'=>$arRezlt['staff_profile_infoline']));
	$arInf = $tb->fetch(PDO::FETCH_ASSOC);
}

	$sql = 'SELECT * FROM company WHERE company_id = :company_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>$arRezlt['staff_company_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_company_id'] = $detaStep['company_name'];
	$arRezlt['staff_comp_real_id'] = $detaStep['company_id'];
	unset($detaStep);

	$sql = 'SELECT * FROM department WHERE department_id = :department_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':department_id'=>$arRezlt['staff_depart_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_depart_id'] = $detaStep['department_name'];
	$arRezlt['staff_comp_dep_id'] = $detaStep['department_id'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);

	$sql = 'SELECT * FROM groups WHERE gr_id = :gr_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':gr_id'=>$arRezlt['staff_group_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_group_id'] = $detaStep['group_name'];
	$arRezlt['staff_group_real_id'] = $detaStep['gr_id'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);

	$sql = 'SELECT * FROM company WHERE company_id = :company_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>$arRezlt['staff_dopcomp1']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_dopcomp1'] = $detaStep['company_name'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);

	$sql = 'SELECT * FROM company WHERE company_id = :company_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':company_id'=>$arRezlt['staff_dopcomp2']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_dopcomp2'] = $detaStep['company_name'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);

	$sql = 'SELECT * FROM location WHERE location_id = :location_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':location_id'=>$arRezlt['staff_location']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_location'] = $detaStep['location_name'];
//echo '<pre>'; print_r($detaStep);echo '</pre>';	
	unset($detaStep);
	
	$sql = 'SELECT * FROM users WHERE staff_id = :staff_id';
	$tb = $dbMail->connection->prepare($sql);
	$tb->execute(array(':staff_id'=>$arRezlt['staff_id']));
	$detaStep = $tb->fetch(PDO::FETCH_ASSOC);
	$arRezlt['staff_email_id'] = $detaStep['user_id'];
	$arRezlt['staff_email'] = $detaStep['email'];
	unset($detaStep);	
	
	//print_r($arRezlt);
	
	/*$sql = 'SELECT * FROM infoline_users WHERE lastname = :lastname AND firstname = :firstname AND middlename =:middlename';
	$tb = $db_infoline->connection->prepare($sql);
	$tb->execute(array(':lastname'=>$arRezlt['staff_lastname'],':firstname'=>$arRezlt['staff_name'],':middlename'=>$arRezlt['staff_secondname']));
	$avatar = $tb->fetch(PDO::FETCH_ASSOC);
	if($avatar['avatar']){$arRezlt['staff_avatar'] = $avatar['avatar'];}else{$arRezlt['staff_avatar']='no-image.jpg';}*/


	
	//echo $arRezlt['staff_datedeactive'];
	if($arRezlt['staff_active'] == '0' AND $arRezlt['staff_datedeactive'] == '0000-00-00 00:00:00' AND $arRezlt['staff_typedeactive']==''){
		$arRezlt['status'] = 'В ожидании';
		$colorStaff = '#C09700';
	}
	if($arRezlt['staff_active'] == '1' AND $arRezlt['staff_datedeactive'] == '0000-00-00 00:00:00' AND $arRezlt['staff_typedeactive']==''){
		$arRezlt['status'] = 'Активный';
		$colorStaff = '#090';
	}
	if($arRezlt['staff_active'] == '1' AND $arRezlt['staff_typedeactive'] == '0'){
		$arRezlt['status'] = 'Уволенный';
		$colorStaff = '#c11';
	}
	if($arRezlt['staff_active'] == '1' AND $arRezlt['staff_typedeactive'] == '1'){
		$arRezlt['status'] = 'Декрет';		
		$colorStaff = '#F960D4';
	}

$statusArr = array(
	'0' => 'В ожидании',
	'1' => 'Активный',
	'2' => 'Уволенный',
	'3' => 'Декрет'
);	

if($arRezlt['status'] == 'Активный'){
	$prev_stats = '1';
}else{
	$prev_stats = '0';
}
 

//echo '<pre>';print_r($arRezlt);echo '</pre>';
?>

<style>
.widthfix{width:455px;}
</style>
<div id="staff_correct_user">
	<div class="left-part-img">
		<div class="outer-staff-pic">
			<div class="border-staff-pic"><?if($arRezlt['staff_avatar']){?><img src="<?=$pathSite?>/images/comprofiler/<?=$arRezlt['staff_avatar']?>"><?}else{?><img src="<?=$pathSite?>/images/comprofiler/no-image.jpg"><?}?></div>
		</div>
		<a class="avastate-btn" href="<?=$pathSite?>/yii/cropjs-itdept/demo/crop.php?id=<?=$arRezlt['staff_profile_infoline']?>" target="_blank">Задать аватарку</a>
		<span style="width: 150px; display: block; font-size: 10px; text-align: center;">Если вы загрузили аватарку, но не видите ее здесь. Не переживайте! На сайте Инфолайн, она уже появилась, можете посмотреть ее там: <a style="    display: block;
    font-size: 10px;
    color: #7491FF;"		href="<?=$pathSite?>/">ссылка на инфолайн</a></span>
		<!--<div class="dates-img-low">
			<div class="staff-fontf staff-first-row">Дата выхода: </div></td>
			<div class="staff-fontf staff-second-row"><?=date('d-m-Y',strtotime($arRezlt['staff_enterdate']))?></div>
		</div>
		<div class="img-under-cr">
			<div style="  color: #BEBEBE;  font-style: italic;  font-size: 10px;" class="staff-fontf staff-first-row">Дата создания: </div>
			<div style="  color: #BEBEBE;  font-style: italic;  font-size: 10px;" class="staff-fontf staff-second-row"><?=date('d-m-Y',strtotime($arRezlt['staff_formsignd']))?></div>
		</div>-->
	</div>
	<div class="right-staff-part">
		<form id="staff_corusers">
			<input type="hidden" name="staff_id" value="<?=$arRezlt['staff_id']?>">
			<input type="hidden" name="staff_profile_infoline" value="<?=$arRezlt['staff_profile_infoline']?>">
			<div style="margin:5px 0;"><input placeholder="Фамилия" id="staff_cor_lastname" class="field-tpl" type="text" name="staff_cor_lastname" value="<?=$arRezlt['staff_lastname']?>" style="padding: 6px 14px;"> <input id="staff_cor_name" class="field-tpl" type="text" name="staff_name" value="<?=$arRezlt['staff_name']?>" placeholder="Имя" style="padding: 6px 14px;"> <input placeholder="Отчество" id="staff_cor_secondname" class="field-tpl" type="text" name="staff_secondname" value="<?=$arRezlt['staff_secondname']?>" style="padding: 6px 14px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;" class="tbl-staff-cor">
				<tr>
					<td><div class="staff-fontf staff-first-row">Должность: </div></td>
					<td>
						<div class="staff-fontf staff-second-row font-wght">
						
							<div id="the-basics">
							  <input id="staff_cor_post" class="typeahead field-tpl" name="staff_post" type="text" placeholder="Укажите должность" value="<?=$arRezlt['post_name']?>">
							</div>

							<script>
							var substringMatcher = function(strs) {
							  return function findMatches(q, cb) {
								var matches, substringRegex;

								// an array that will be populated with substring matches
								matches = [];

								// regex used to determine if a string contains the substring `q`
								substrRegex = new RegExp(q, 'i');

								// iterate through the pool of strings and for any string that
								// contains the substring `q`, add it to the `matches` array
								$.each(strs, function(i, str) {
								  if (substrRegex.test(str)) {
									matches.push(str);
								  }
								});

								cb(matches);
							  };
							};

							var states = [<?foreach($arPosts as $PostItems){?>'<?=$PostItems['post_name']?>',<?}?>
							];

							$('#the-basics .typeahead').typeahead({
							  hint: true,
							  highlight: true,
							  minLength: 1,
							},
							{
							  name: 'states',
							  source: substringMatcher(states),
							  limit: 45,
							});
							</script>							
						</div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:middle;"><div class="staff-fontf staff-first-row">Компания: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select id="comp_corr-list" class="list-trasher widthfix" name="staff_company_id">
							<?
								$sql = 'SELECT * FROM company';
								$tb = $db->connection->prepare($sql);
								$tb->execute();
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_comp_real_id'] == $items['company_id']){?>selected="selected"<?}?> value="<?=$items['company_id']?>"><?=$items['company_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Компания 1: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select class="list-trasher widthfix" name="staff_dopcomp1">
							<option value="0">-- Дополнительная компания 1 --</option>
							<?
								$sql = 'SELECT * FROM company';
								$tb = $db->connection->prepare($sql);
								$tb->execute();
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_dopcomp1'] == $items['company_name']){?>selected="selected"<?}?> value="<?=$items['company_id']?>"><?=$items['company_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Компания 2: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select class="list-trasher widthfix" name="staff_dopcomp2">
							<option value="0">-- Дополнительная компания 2 --</option>
							<?
								$sql = 'SELECT * FROM company';
								$tb = $db->connection->prepare($sql);
								$tb->execute();
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_dopcomp2'] == $items['company_name']){?>selected="selected"<?}?> value="<?=$items['company_id']?>"><?=$items['company_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Отдел: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select id="cor-dep-list" class="list-trasher widthfix" name="staff_department">
							<option value="0">-- Отдел --</option>
							<?
								$sql = 'SELECT * FROM department WHERE company_id = :company_id ORDER by department_name ASC';
								$tb = $db->connection->prepare($sql);
								$tb->execute(array(':company_id'=>$arRezlt['staff_comp_real_id']));
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_comp_dep_id'] == $items['department_id']){?>selected="selected"<?}?> value="<?=$items['department_id']?>"><?=$items['department_name']?> (<?=$pref_comp[$items['company_id']]?>)</option>
							<?}?>
							</select>
						</div>					
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Доп. отдел: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select id="cor-dep-adition-list" class="list-trasher widthfix" name="staff_department_adition">
							<option value="0">-- Доп. отдел --</option>
							<?
								$sql = 'SELECT * FROM department WHERE company_id = :company_id ORDER by department_name ASC';
								$tb = $db->connection->prepare($sql);
								$tb->execute(array(':company_id'=>$arRezlt['staff_comp_real_id']));
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_dop_otdel'] == $items['department_id']){?>selected="selected"<?}?> value="<?=$items['department_id']?>"><?=$items['department_name']?> (<?=$pref_comp[$items['company_id']]?>)</option>
							<?}?>
							</select>
						</div>					
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Группа: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select id="cor-grp-list" class="list-trasher widthfix" name="staff_group_id">
								<option value="0">-- Группа --</option>
							<?
								$sql = 'SELECT * FROM groups WHERE department_id = :department_id';
								$tb = $db->connection->prepare($sql);
								$tb->execute(array(':department_id'=>$arRezlt['staff_comp_dep_id']));
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_group_real_id'] == $items['gr_id']){?>selected="selected"<?}?> value="<?=$items['gr_id']?>"><?=$items['group_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Локация: </div></td>
					<td>
						<div class="staff-fontf staff-second-row">
							<select class="list-trasher widthfix" name="staff_location">
							<?
								$sql = 'SELECT * FROM location';
								$tb = $db->connection->prepare($sql);
								$tb->execute();
								$dataDB = $tb->fetchAll(PDO::FETCH_ASSOC);
							foreach($dataDB as $items){?>
								<option <?if($arRezlt['staff_location'] == $items['location_name']){?>selected="selected"<?}?> value="<?=$items['location_id']?>"><?=$items['location_name']?></option>
							<?}?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:middle;"><div class="staff-fontf staff-first-row">Телефон: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<input class="field-tpl widthfix" id="ats-staff" type="text" name="staff_ats" value="<?if($arRezlt['staff_ats'] != '0'){echo $arRezlt['staff_ats'];}?>"></div></td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Мобильный: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<input id="staff_mobnumber" class="field-tpl widthfix" type="text" name="staff_mobnumber" value="<?=$arRezlt['staff_mobnumber']?>"></div></td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">Дата выхода: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<input class="field-tpl widthfix" type="text" id="staff_enterdate" name="staff_enterdate" value="<?=date('d-m-Y',strtotime($arRezlt['staff_enterdate']))?>">
					</div></td>
				</tr>
				<tr>
					<td><div class="staff-fontf staff-first-row">День рождения: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<input class="field-tpl widthfix" type="text" id="staff_user_dr" name="staff_user_dr" value="<?if($arRezlt['staff_dr']!=0){echo date('d-m',$arRezlt['staff_dr']);}?>">
					</div></td>
				</tr>
				<?if($arRezlt['staff_email']){?>
				<tr>
					<td><div class="staff-fontf staff-first-row">Email: </div></td>
					<td><div class="staff-fontf staff-second-row">
					<?if($userLevel['oper_correct_post']!=0){?><a data-corr="<?=$arRezlt['staff_email_id']?>" class="m_link_from_log_corr" href="javascript:void(0);" style="color:#444;font-weight:bold;text-decoration:none;"><?=$arRezlt['staff_email']?></a><?}else{?><?=$arRezlt['staff_email']?><?}?>
					</div></td>
					<style>.m_link_from_log_corr:hover{color:#3a87ad!important}</style>
				</tr>
				<?}?>

				<tr id="last-staff-field">
					<td><div class="staff-fontf staff-first-row">Статус: </div></td>
					<td><div class="staff-fontf staff-second-row status-staff-rzl" style="color:<?=$colorStaff?>">
						<select id="staff-cor-status" class="list-trasher widthfix" name="staff_status">
							<?foreach($statusArr as $key => $items){?>
								<option <?if($arRezlt['status'] == $items){?>selected="selected"<?}?> value="<?=$key?>"><?=$items?></option>
							<?}?>
						</select>
						<input type="hidden" name="prev_status" value="<?=$prev_stats?>">
						</div></td>
				</tr>
				
				<tr id="datedeact-staff" style="display:<?if($arRezlt['status'] == 'Уволенный' || $arRezlt['status'] == 'Декрет'){?><?}else{?>none<?}?>"> 
					<td style="vertical-align:middle;">
						<div class="staff-fontf staff-first-row">Дата ухода: </div>
					</td> 
					<td>
						<div class="staff-fontf staff-second-row"> <input id="data-deact-staff" class="field-tpl widthfix" type="text" name="staff_datedeactive" value="<?if($arRezlt['staff_datedeactive'] != '0000-00-00 00:00:00'){echo date('d-m-Y',strtotime($arRezlt['staff_datedeactive']));}?>"></div>
					</td> 
				</tr>
				
				<tr>
					<td></td>
					<td><!--<div style="border-radius:50%;margin-left:15px;width:15px;height:15px;background:<?if($arRezlt['staff_profile_infoline']){?>#090<?}else{?>#c11<?}?>;float: left; margin-right: 12px;"></div>--> <?if($arRezlt['staff_profile_infoline']==0){?><a style="font-size: 11px; background: #3a87ad; color: #fff; border-radius: 3px; padding: 3px 10px; text-decoration: none;" class="connectInUserNow" data-idstaff="<?=$arRezlt['staff_id']?>" href="javascript:void(0);">Привязать пользователя к Инфолайну</a> <span id="rezultcontainerinf"></span><?}?></td>
				</tr>
				<?if($arRezlt['staff_profile_infoline']!=0){?>				
					<tr>
						<td><div class="staff-fontf staff-first-row"></div></td>
						<td style="padding-left:12px;"><input id="staff_showornotinfol" type="checkbox" <?if($arInf['staff_notshow']=='1'){?>checked<?}?> name="staff_showornotinfol"> <label for="staff_showornotinfol">Показывать пользователя на Инфолайн</label></td>
					</tr>
				<?}?>
				<tr>
					<td><input class="bluebtn" type="submit" value="Сохранить"></td>
					<td>
						
					</td>
				</tr>
			</table>
		</form>
	</div>
		<div style="clear:both"></div>
</div>
<?require 'arFields.php';?>
<?require 'script_js.php';?>