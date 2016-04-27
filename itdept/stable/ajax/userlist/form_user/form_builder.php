<?
session_start();
require '../../../../../ajax/db.php';
require 'arrFields.php';
//require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';
require '../../../../../config.php';


$db = new DatabaseItDept();
$dbMail = new Database();
$sql = 'SELECT * FROM postusers';
$tb = $db->connection->prepare($sql);
$tb->execute();
$arPosts = $tb->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM staff ORDER BY staff_lastname ASC';
$tb = $db->connection->prepare($sql);
$tb->execute();
$getDataExec = $tb->fetchAll(PDO::FETCH_ASSOC);
?>

<form class="formpadding" id="<?=$formName?>">
	<h1 class="form-header">Новый сотрудник</h1>
	<table>
		<?foreach($arrayForm as $f_Items){?>
			<?switch($f_Items['name']){
				case $prefix.'already_work':
					break;
				case $prefix.'postsorting':
					break;
				case $prefix.'umail':
					break;
				case $prefix.'dop_comp1':
					break;
				case $prefix.'dop_comp2':
					break;
				case $prefix.'groupdep':
					break;
				case $prefix.'mob_phone':
					break;
				case $prefix.'ats':
					break;
				case $prefix.'itletter':
					break;
				case $prefix.'department':
					break;
				case $prefix.'upass':
					break;
				case $prefix.'dateenter':?>
					<tr>
						<td class="field-cover">
							<label for="<?=$f_Items['name']?>"><?=$f_Items['title']?></label>
						</td>
						<td style="position:relative;">
							<input style="width:150px" class="field-tpl" type="text" name="<?=$f_Items['name']?>" id="<?=$f_Items['name']?>" value="">
							  <i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
						</td>
					</tr>
					<?break;
				case $prefix.'user_dr':?>
					<tr>
						<td class="field-cover">
							<label for="<?=$f_Items['name']?>"><?=$f_Items['title']?></label>
						</td>
						<td style="position:relative;">
							<input style="width:150px" class="field-tpl" type="text" name="<?=$f_Items['name']?>" id="<?=$f_Items['name']?>" value="">
							  <i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
						</td>
					</tr>
					<?break;?>
				<?case $prefix.'company':?>
					<tr>
						<td class="field-cover">
							<label for="<?=$f_Items['name']?>"><?=$f_Items['title']?></label>
						</td>
						<td style="position:relative;width:358px">
							<select class="field-tpl" name="<?=$f_Items['name']?>" id="<?=$f_Items['name']?>">
								<option value="0">-- Выберите компанию --</option>
								<?$db = new DatabaseItDept();
									$sql = 'SELECT * FROM company';
									$tb = $db->connection->prepare($sql);
									$tb->execute();
									$getData = $tb->fetchAll(PDO::FETCH_ASSOC);
								foreach($getData as $f_item){	
								?>
								<option value="<?=$f_item['company_id']?>"><?=$f_item['company_name']?></option>
								<?}?>								
							</select>
							<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
						</td>
					</tr>
					<tr class="hiddencompanies_1" style="display:none;">
						<td class="field-cover">
							<label for="<?=$prefix?>dop_comp1">Дополнительная компания 1</label>
						</td>
						<td style="position:relative;width:358px">
							<select class="field-tpl" name="<?=$prefix?>dop_comp1" id="<?=$prefix?>dop_comp1" style="border-color: rgb(204, 204, 204);">
								<option value="0">-- Выберите компанию --</option>
																<option value="1">БиоЛайн</option>
																<option value="2">БиоСистемы</option>
																<option value="8">ИнфоЛаб</option>
																<option value="9">Медилайн</option>
																<option value="10">Биомебель</option>
																
							</select>
							<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
						</td>
					</tr>

					<tr class="hiddencompanies_2" style="display:none;">
						<td class="field-cover">
							<label for="<?=$prefix?>dop_comp2">Дополнительная компания 2</label>
						</td>
						<td style="position:relative;width:358px">
							<select class="field-tpl" name="<?=$prefix?>dop_comp2" id="<?=$prefix?>dop_comp2" style="border-color: rgb(204, 204, 204);">
								<option value="0">-- Выберите компанию --</option>
																<option value="1">БиоЛайн</option>
																<option value="2">БиоСистемы</option>
																<option value="8">ИнфоЛаб</option>
																<option value="9">Медилайн</option>
																<option value="10">Биомебель</option>
																
							</select>
							<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
						</td>
					</tr>
					<tr id="pluszone">
						<td class="field-cover">
							
						</td>
						<td style="position:relative;width:358px">
							<div style="margin-top:-10px;"><a class="btn green" onclick="$('.hiddencompanies_1').show();$(this).parent().hide();$('#second_plus').show();" href="javascript:void(0);" style="padding: 3px 10px;  margin-right: 10px;">+</a> Добавить компанию еще...</div>
							<div id="second_plus" style="margin-top:-10px;display:none;"><a class="btn green" onclick="$('.hiddencompanies_2').show();$('#pluszone').hide();" href="javascript:void(0);" style="padding: 3px 10px;  margin-right: 10px;">+</a> Добавить компанию еще...</div>
						</td>
					</tr>
					<?break;?>
				<?case $prefix.'location':?>
					<tr id="build-depart-fields">
						<td class="field-cover">
							<label for="<?=$f_Items['name']?>"><?=$f_Items['title']?></label>
						</td>
						<td style="position:relative;width:358px">
							<select class="field-tpl" name="<?=$f_Items['name']?>" id="<?=$f_Items['name']?>">
								<option value="0">-- Выберите расположение --</option>
								<?
									$sql = 'SELECT * FROM location';
									$tb = $db->connection->prepare($sql);
									$tb->execute();
									$getData = $tb->fetchAll(PDO::FETCH_ASSOC);
								foreach($getData as $f_item){	
								?>
								<option value="<?=$f_item['location_id']?>"><?=$f_item['location_name']?></option>
								<?}?>								
							</select>
							<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
						</td>
					</tr>
					<?break;?>
				<?case $prefix.'mail':?>
					<?if($userLevel['oper_create_post']!=0){?>
						<tr id="test-mail-build">
							<td class="field-cover" style="vertical-align:top;">
								<label for="staff_mail">Почта</label>
							</td>
							<td style="position:relative;width:358px">
								<a id="stf-mail-btn" class="btn-createpost" href="javascript:void(0);" style="display: none;">Создать почту</a>
								<div class="create-mail">
									<div class="cm-mailbox">
										<input placeholder="Логин" class="field-tpl halffield" type="text" name="staff_umail" id="staff_umail" value="" style="border-color: rgb(204, 204, 204);"> @
									</div>
									<div class="cm-mailbox">
										<select class="field-tpl half-select" name="" disabled="" id="">
											<option selected="selected" value="1">bioline.ru</option>
											<option value="2">biomebel.ru</option> <option value="3">mail.ru</option>
											<option value="4">yandex.ru</option>
										</select> <i id="log-mail-flag" style="margin-left: 10px; color: rgb(0, 153, 0); display: none;" class="fa fa-check-circle exelfiledIU"></i>
									</div>
									<div style="clear:both"></div>
									<div class="cm-mailbox">
										<input style="width: 155px;" class="field-tpl" type="hidden" name="staff_upass" id="staff_upass" value="W8rozm7u" placeholder="Пароль"> </div>
									<div style="clear:both"></div>
									<div class="test-letter-cmb">
									<div style="width: 170px;float: left;font-size: 11px;">
										<input checked name="showornotinfuser" type="checkbox" style=" vertical-align: middle;">
										<div style="margin-left: 6px; font-size: 10px; display: inline;"> Показывать на Infoline?</div>
									</div> 										
									<a style="  float: right;  margin-right: 60px;  width: 119px;  text-align: center;padding: 5px 0;background: #d9534f;" class="btn-createpost" id="cancel-create-mail" href="javascript:void(0);">Не создавать ящик</a>
									</div>
								</div>
								<input style="width: auto;display:none;" class="field-tpl" type="checkbox" name="staff_mail" id="staff_mail" value="">
							</td>
						</tr>
					<?}?>
					<?break;?>
				<?case $prefix.'executive':?>
					<tr>
						<td class="field-cover">
							<label for="<?=$f_Items['name']?>"><?=$f_Items['title']?></label>
						</td>
						<td style="position:relative;width:358px">
							<div id="the-basics2">
								<input name="<?=$f_Items['name']?>" id="<?=$f_Items['name']?>" class="typeahead2 field-tpl" type="text" placeholder="Укажите руководителя" value="">
							</div>
							<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
						</td>
					</tr>
					<?break;?>
				<?case $prefix.'st_comp':?>
					<?break;?>
				<?case $prefix.'st_phone':?>
					<?break;?>
				<?case $prefix.'motiv':?>
					<?break;?>
				<?case $prefix.'one_c':?>
					<?break;?>
				<?case $prefix.'notebook':?>
					<?break;?>
				<?case $prefix.'mobphone':?>
					<?break;?>
				<?case $prefix.'limit':?>
					<tr>
						<td class="field-cover">
							<label>Добавить</label>
						</td>
						<td style="position:relative;width:358px">
							<div class="accs-block" style="margin-right: -1px;">								
								<label for="<?=$arrayForm['st_comp']['name']?>"><?=$arrayForm['st_comp']['title']?></label>
								<input type="checkbox" name="<?=$arrayForm['st_comp']['name']?>" id="<?=$arrayForm['st_comp']['name']?>" value="1">
							</div>
							<div class="accs-block">								
								<label for="<?=$arrayForm['st_phone']['name']?>"><?=$arrayForm['st_phone']['title']?></label>
								<input type="checkbox" name="<?=$arrayForm['st_phone']['name']?>" id="<?=$arrayForm['st_phone']['name']?>" value="1">
							</div>
							<div class="accs-block" style="margin-right: -1px;margin-top: -1px;">								
								<label for="<?=$arrayForm['motiv']['name']?>"><?=$arrayForm['motiv']['title']?></label>
								<input type="checkbox" name="<?=$arrayForm['motiv']['name']?>" id="<?=$arrayForm['motiv']['name']?>" value="1">
							</div>
							<div class="accs-block" style="margin-top: -1px;">								
								<label for="<?=$arrayForm['one_c']['name']?>"><?=$arrayForm['one_c']['title']?></label>
								<input type="checkbox" name="<?=$arrayForm['one_c']['name']?>" id="<?=$arrayForm['one_c']['name']?>" value="1">
							</div>
								<div style="clear:both;height:0px;"></div>
							<div class="accs-block" style="margin-top: -1px;">								
								<label for="<?=$arrayForm['notebook']['name']?>"><?=$arrayForm['notebook']['title']?></label>
								<input type="checkbox" name="<?=$arrayForm['notebook']['name']?>" id="<?=$arrayForm['notebook']['name']?>" value="1">
							</div>
							<div class="accs-block" style="margin-top: -1px;margin-left:-1px;">								
								<label for="<?=$arrayForm['mobphone']['name']?>"><?=$arrayForm['mobphone']['title']?></label>
								<input type="checkbox" name="<?=$arrayForm['mobphone']['name']?>" id="<?=$arrayForm['mobphone']['name']?>" value="1">
							</div>
							<div class="accs-block" style="margin-right: -1px;margin-top: -1px;">
								<label for="staff_chair">Стул</label>
								<input type="checkbox" name="staff_chair" id="staff_chair" value="1">
							</div>
							<div class="accs-block" style="margin-right: -1px;margin-top: -1px;">
								<label for="staff_table_for">Стол</label>
								<input type="checkbox" name="staff_table_for" id="staff_table_for" value="1">
							</div>
							<div class="accs-block" style="margin-right: -1px;margin-top: -1px;">
								<label for="staff_concelar">Канцелярия</label>
								<input type="checkbox" name="staff_concelar" id="staff_concelar" value="1">
							</div>
							<div style="clear:both;height:15px;"></div>
						</td>
					</tr>				
					<?break;?>
				
				<?case $prefix.'post':?>
					<tr class="post-user-enterblock">
						<td class="field-cover">
							<label for="<?=$f_Items['name']?>"><?=$f_Items['title']?></label>
						</td>
						<td style="position:relative;">							
							<div id="the-basics">
							  <input name="<?=$f_Items['name']?>" id="<?=$f_Items['name']?>" class="typeahead field-tpl" type="text" placeholder="Укажите должность" value="">
							</div>							
							
							<i style="  margin-left: 10px;color: rgb(0, 153, 0);    position: absolute;right: 32px;top: 14px;" class="fa fa-check-circle exelfiledIU"></i>
						</td>
					</tr>					
					<?break;?>
				<?default:?>
				<tr>
					<td class="field-cover">
						<label for="<?=$f_Items['name']?>"><?=$f_Items['title']?></label>
					</td>
					<td style="position:relative;">
						<input class="field-tpl" type="text" name="<?=$f_Items['name']?>" id="<?=$f_Items['name']?>" value="">
						<i style="  margin-left: 10px;color: rgb(0, 153, 0);" class="fa fa-check-circle exelfiledIU"></i>
					</td>
				</tr>
			<?}?>
		<?}?>
		<tr>
			<td class="field-cover" style="vertical-align:top">
				<label for="dop_info_form">Дополнительная информация</label>
			</td>
			<td style="position:relative;vertical-align: top;">
				<a id="stf-dopshow-btn" onclick="$('#dop-info-container-stf').show();$(this).hide();" href="javascript:void(0);" style="font-size: 12px; text-decoration: none; border-bottom: 1px dotted #bbb; color: #275393;">Указать дополнительную информацию?</a>
				<div id="dop-info-container-stf" style="display:none;">
					<textarea style="resize: none;margin-bottom:0;" class="field-tpl" id="dop_info_form" name="dop_info_form" rows="10"></textarea>
					<a style="display:inline-block; margin-bottom: 10px;font-size: 12px; text-decoration: none; border-bottom: 1px dotted #bbb; color: #275393;" href="javascript:void(0);" onclick="$('#dop-info-container-stf').hide();$('#stf-dopshow-btn').show();$('#dop_info_form').val('')">Не указывать дополнительную информацию</a>
				</div>
			</td>
		</tr>

		<tr>
			<td class="field-cover">
				<label for="other_mail">Получатели</label>
			</td>
			<td style="position:relative;">
			<?
				$sql = 'SELECT * FROM users';
				$tb = $dbMail->connection->prepare($sql);
				$tb->execute();
				$getData = $tb->fetchAll(PDO::FETCH_ASSOC);	
				foreach($getData as $items){
					$arrData[] = $items['email'];
				}					
			?>			
				<div id="multibuild">
					<form id="formGet">
							  <select data-placeholder="Введите E-mail'ы получателей" style="width:350px;" multiple class="chosen-select" tabindex="8">
								<?foreach($arrData as $items){?>
									<option <?if(in_array($items, $adressesMail['startUp'])){?>selected="selected"<?}?>><?=$items?></option>
								<?}?>
							  </select>
					</form>
				</div>
			</td>
		</tr>
		<!--<tr id="show-other-mails-stf" style="display:none;"> <td class="field-cover" style="vertical-align:top"> <label for="dop_info_form">В рассылку уже добавлены</label> </td> <td id="place-for-new-adres-stf" style="position:relative;vertical-align: top;">  </td> </tr>-->
		<tr class="btnarea">
			<td style="vertical-align: bottom;" colspan="2">
				<div style="margin: 20px auto 0;">
					<a id="<?=$prefix?>clearform" class="btn red" style="float:right">Очистить Форму</a>
					<input class="btn green" type="submit" name="<?=$prefix?>sendform" value="Создать сотрудника">
						<div style="clear:both"></div>
				</div>
			</td>
		</tr>		
	</table>
</form>
<script>
/*$(function () {
	$('#<?=$prefix?>city').kladr({
		type: $.kladr.type.city
	});
});*/

</script>
<script>

$(function() {
	 
	$( "#staff_dateenter" ).datepicker({
		//minDate: 0, //work since
		dateFormat: "dd-mm-yy", changeMonth: true,
      changeYear: true,
		onClose: function( selectedDate ) {
		from = selectedDate.split("-");
		f = new Date(from[2], from[1] - 1, from[0]);
		var d = new Date(f);
		var mm = d.getMonth() + 1;
		if(mm<10){
			mm='0'+mm;
		}
		var dd = d.getDate() + 1;
		var yy = d.getFullYear();
		var myDateString = dd + '-' + mm + '-' + yy; //(US)
		//alert(myDateString);
		$("#staff_dateenter").focus();
		$("#chk-still-work").focus();
		}
	});
	$( "#staff_user_dr" ).datepicker({ dateFormat: "dd-mm",      changeMonth: true});

     function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#other_mail" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "ajax/search.php", {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 2 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
	$('#other_mail').blur(function(){
		valu = $(this).val();
		if (/[@]/.exec(valu)) {

		}else{
			$('#mistakerow').remove();
			$('#mainFormSender').parent().parent().before('<tr id="mistakerow"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td</tr>');
			$('#other_mail').css({'border-color': '#c11'});
		}
			if (/[^a-zA-Z,\s0-9@.\-_]/.exec(valu)){
				$('#mistakerow').remove();
				$('#mainFormSender').parent().parent().before('<tr id="mistakerow"><td colspan="2"><div class="mistakeform">Ошибка! Чтобы успешно отправить результат нужно заполнить все поля формы! Красным цветом выделены те поля, которые нужно заполнить.</div></td</tr>');
				$('#other_mail').css({'border-color': '#c11'});

			} else {
				valid_mname = 1;
			}
	});

});

$('#staff_FormCreateInnerUser').on('change','#staff_chair,#staff_table_for',function(){
		arrayMulti = [];
		count = 0;
			$( ".chosen-choices li" ).each(function() {
			
				getIndex = $(this).children('a').attr('data-option-array-index');
				getData = $(this).children('span').text();
				if(typeof getIndex !=="undefined"){
					arrayMulti[count] = getData;
				}
				count++;
			});		
		if($("#staff_chair").is(':checked') || $('#staff_table_for').is(':checked')){
			$(this).attr("disabled", true);
				setTimeout(function(){
					$('#staff_chair').prop("disabled", false);
					$('#staff_table_for').prop("disabled", false);
				},300);
			var size = arrayMulti.filter(function(value) { return value !== undefined }).length;
			//alert(size);
			arrayMulti[size] = '<?=$adressesMail['administrative']?>';
				$.ajax({
					dataType: "HTML",
					url: 'itdept/stable/ajax/userlist/form_user/formbuilder.php',
					data: {arrayPost : arrayMulti},
					type: 'POST',
					success: function(data){
						$('#multibuild').html(data);
					}
				});
		}else{		
			
				$getIndexArr = $.inArray("<?=$adressesMail['administrative']?>", arrayMulti);	
				if($getIndexArr!='-1'){
					arrayMulti.splice($getIndexArr,1);
				}
					$.ajax({
						dataType: "HTML",
						url: 'itdept/stable/ajax/userlist/form_user/formbuilder.php',
						data: {arrayPost : arrayMulti},
						type: 'POST',
						success: function(data){
							$('#multibuild').html(data);
						}
					});
		}
});

$('#staff_FormCreateInnerUser').on('change','#staff_one_c',function(){
		arrayMulti = [];
		count = 0;
			$( ".chosen-choices li" ).each(function() {
			
				getIndex = $(this).children('a').attr('data-option-array-index');
				getData = $(this).children('span').text();
				if(typeof getIndex !=="undefined"){
					arrayMulti[count] = getData;
				}
				count++;
			});		
		if($("#staff_one_c").is(':checked')){
			$(this).attr("disabled", true);
				setTimeout(function(){
					$('#staff_one_c').prop("disabled", false);
				},300);
			var size = arrayMulti.filter(function(value) { return value !== undefined }).length;
			//alert(size);
			arrayMulti[size] = '<?=$adressesMail['1C']?>';
				$.ajax({
					dataType: "HTML",
					url: 'itdept/stable/ajax/userlist/form_user/formbuilder.php',
					data: {arrayPost : arrayMulti},
					type: 'POST',
					success: function(data){
						$('#multibuild').html(data);
					}
				});
		}else{		
			
				$getIndexArr = $.inArray("<?=$adressesMail['1C']?>", arrayMulti);	
				if($getIndexArr!='-1'){
					arrayMulti.splice($getIndexArr,1);
				}
					$.ajax({
						dataType: "HTML",
						url: 'itdept/stable/ajax/userlist/form_user/formbuilder.php',
						data: {arrayPost : arrayMulti},
						type: 'POST',
						success: function(data){
							$('#multibuild').html(data);
						}
					});
		}
});

$('#staff_FormCreateInnerUser').on('change','#staff_concelar',function(){
		arrayMulti = [];
		count = 0;
			$( ".chosen-choices li" ).each(function() {
			
				getIndex = $(this).children('a').attr('data-option-array-index');
				getData = $(this).children('span').text();
				if(typeof getIndex !=="undefined"){
					arrayMulti[count] = getData;
				}
				count++;
			});		
		if($("#staff_concelar").is(':checked')){
			$(this).attr("disabled", true);
				setTimeout(function(){
					$('#staff_concelar').prop("disabled", false);
				},300);
			var size = arrayMulti.filter(function(value) { return value !== undefined }).length;
			//alert(size);
			<?foreach($adressesMail['koncelar'] as $Items){?>
				arrayMulti[size++] = '<?=$Items?>';
			<?}?>
			
				$.ajax({
					dataType: "HTML",
					url: 'itdept/stable/ajax/userlist/form_user/formbuilder.php',
					data: {arrayPost : arrayMulti},
					type: 'POST',
					success: function(data){
						$('#multibuild').html(data);
					}
				});
		}else{		
			<?foreach($adressesMail['koncelar'] as $Items){?>
				$getIndexArr = $.inArray("<?=$Items?>", arrayMulti);
				if($getIndexArr!='-1'){
					arrayMulti.splice($getIndexArr,1);
				}
			<?}?>

					$.ajax({
						dataType: "HTML",
						url: 'itdept/stable/ajax/userlist/form_user/formbuilder.php',
						data: {arrayPost : arrayMulti},
						type: 'POST',
						success: function(data){
							$('#multibuild').html(data);
						}
					});
		}
});
/*LimInp.onkeypress = function(e) {
  e = e || event;

  if (e.ctrlKey || e.altKey || e.metaKey) return;

  var chr = getChar(e);

  // с null надо осторожно в неравенствах,
  // т.к. например null >= '0' => true
  // на всякий случай лучше вынести проверку chr == null отдельно
  if (chr == null) return;

  if (chr < '0' || chr > '9') {
    return false;
  }
}*/

// event.type должен быть keypress
function getChar(event) {
  if (event.which == null) { // IE
    if (event.keyCode < 32) return null; // спец. символ
    return String.fromCharCode(event.keyCode)
  }

  if (event.which != 0 && event.charCode != 0) { // все кроме IE
    if (event.which < 32) return null; // спец. символ
    return String.fromCharCode(event.which); // остальные
  }

  return null; // спец. символ
}

$(document).on('keypress','#staff_limit',function(e){
//console.log(hello);
  e = e || event;

  if (e.ctrlKey || e.altKey || e.metaKey) return;

  var chr = getChar(e);

  // с null надо осторожно в неравенствах,
  // т.к. например null >= '0' => true
  // на всякий случай лучше вынести проверку chr == null отдельно
  if (chr == null) return;

  if (chr < '0' || chr > '9') {
    return false;
  }
});

//--Chosen part
var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : {allow_single_deselect:true},
  '.chosen-select-no-single' : {disable_search_threshold:10},
  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
  '.chosen-select-width'     : {width:"95%"}
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}
$(document).ready(function(){

	$('#clicker').click(function(){
	arrayMulti = [];
		$( ".chosen-choices li" ).each(function() {
			getIndex = $(this).children('a').attr('data-option-array-index');
			getData = $(this).children('span').text();
			if(typeof getIndex !=="undefined"){
				arrayMulti[getIndex] = getData;
			}
		});
		//console.log(arrayMulti);
	});
	$('#addClicker').click(function(){
	arrayMulti = [];
	count = 0;
		$( ".chosen-choices li" ).each(function() {
		
			getIndex = $(this).children('a').attr('data-option-array-index');
			getData = $(this).children('span').text();
			if(typeof getIndex !=="undefined"){
				arrayMulti[count] = getData;
			}
			count++;
		});	
	var size = arrayMulti.filter(function(value) { return value !== undefined }).length;
	//alert(size);
	arrayMulti[size] = 'kodenuk@bioline.ru';
		$.ajax({
			dataType: "HTML",
			url: 'formbuilder.php',
			data: {arrayPost : arrayMulti},
			type: 'POST',
			success: function(data){
				$('#multibuild').html(data);
			}
		});
	});
	$('#addClicker1c').click(function(){
	arrayMulti = [];
	count = 0;
		$( ".chosen-choices li" ).each(function() {
		
			getIndex = $(this).children('a').attr('data-option-array-index');
			getData = $(this).children('span').text();
			if(typeof getIndex !=="undefined"){
				arrayMulti[count] = getData;
			}
			count++;
		});	
	var size = arrayMulti.filter(function(value) { return value !== undefined }).length;
	//alert(size);
	arrayMulti[size] = '1c@bioline.ru';
		$.ajax({
			dataType: "HTML",
			url: 'formbuilder.php',
			data: {arrayPost : arrayMulti},
			type: 'POST',
			success: function(data){
				$('#multibuild').html(data);
			}
		});
	});
});
</script>
<style>
*{font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 14px;}

.field-cover label{min-width:150px;}
.field-tpl{
	background-color: #ffffff;
	border: 1px solid #cccccc;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	-webkit-transition: border linear 0.2s,box-shadow linear 0.2s;
	-moz-transition: border linear 0.2s,box-shadow linear 0.2s;
	-o-transition: border linear 0.2s,box-shadow linear 0.2s;
	transition: border linear 0.2s,box-shadow linear 0.2s;
	padding: 6px 9px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	box-sizing: border-box;
	margin-bottom: 10px;
	width:300px;
}

.field-tpl:focus{ border-color: #66afe9!important; outline: 0; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6); box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6); }
.field-cover label {  margin-right: 20px; display: block; text-align: right;  margin-bottom: 10px;} 
.formpadding{  padding: 10px 30px 30px 30px;float:left;}

.form-header{
  height: 30px;
  line-height: 30px;
  font-size: 18px;
  color: #000;
  padding: 0;
  border-bottom:2px solid #000;
  margin-bottom:20px;
}
.ui-widget-content{z-index:999999999999;}

.btn {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: 400;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
}

.green { color: #fff; background-color: #5cb85c; border-color: #4cae4c; }
.green:hover{color: #fff; background-color: #449d44; border-color: #398439;}
.red{  color: #fff; background-color: #d9534f; border-color: #d43f3a;}
.red:hover{  color: #fff; background-color: #c9302c; border-color: #ac2925;}
.exelfiledIU{display:none;}
.btn-createpost{ color: #fff; display: inline-block; font-size: 12px; text-decoration: none; background: #3a87ad; padding: 5px 15px; border-radius: 5px;margin-bottom:10px;}
.accs-block{width:148px;float:left;border:1px solid #ccc;/* padding: 10px 0; */ }
.accs-block input{  vertical-align: middle;cursor:pointer;  margin: 12px 0;  margin-left: -20px;}
.accs-block label{  width: 133px; display: block; float: left; padding-left: 15px;cursor:pointer;  padding-top: 10px;  padding-bottom: 10px;} 
#limit-phone label{width:auto;padding-top: 1px;}
#limit-phone input{  width: 60px; padding: 0 5px; vertical-align: middle; margin-left:10px; margin-bottom:0;} 

.cm-mailbox{  float: left; width: 50%;}
.halffield{  width: 155px;}
.half-select{width:121px;}
.genpass-btn{width: 119px; color: #fff; display: inline-block; font-size: 12px; text-align: center; height: 30px; line-height: 30px; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; text-decoration: none;background: #3a87ad;} 
#sendtestletter{  margin-bottom: 20px;}
.fa.exelfiledIU{position:relative;top: 0;  right: 0;}
</style>
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

var states = [<?foreach($arPosts as $PostItems){?>'<?=$PostItems['post_name']?>',<?}?>];
var states2 = [<?foreach($getDataExec as $f_item){?>'<?=$f_item[$prefix.'lastname']?> <?=$f_item[$prefix.'name']?> <?=$f_item[$prefix.'secondname']?>',<?}?>];

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

$('#the-basics2 .typeahead2').typeahead({
  hint: true,
  highlight: true,
  minLength: 1,
  
},
{
  name: 'states2',
  source: substringMatcher(states2),
  limit: 45,
});
</script>