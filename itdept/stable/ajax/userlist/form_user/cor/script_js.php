<script>
$(function() {
	 
	$( "#staff_enterdate" ).datepicker({
		//minDate: 0, //work since
		dateFormat: "dd-mm-yy",      changeMonth: true,
      changeYear: true
	});
	 
	$( "#data-deact-staff" ).datepicker({
		//minDate: 0, //work since
		dateFormat: "dd-mm-yy",      changeMonth: true,
      changeYear: true
	});
	$( "#staff_user_dr" ).datepicker({ dateFormat: "dd-mm",      changeMonth: true});


 $('#staff_mobnumber').inputmask("mask", {"mask": "+9(999) 999-99-99"});
 $('#ats-staff').inputmask("mask", {"mask": "999"});

});
	$('#staff_correct_user').on('submit','#staff_corusers',function(){
		mistake = 0;
		valChange = $('.'+prefix+'sel-page-wrap-opt').val();
		valStatus = $('#stats-staff').val();
		valSearchType = $('#staff_paramsearch').val();
		valSearchData = $('#staff_searchinp').val();
		valComp_filt = $('#'+prefix+'comp-list').val();
		valDep_filt = $('#'+prefix+'dep-list').val();
		valLoca_filt = $('#'+prefix+'loca-list').val();		
		dataForm = $(this).serialize();
		//alert(dataForm);
		
		
			//alert(123);
				$.ajax({
				  dataType: "json",
				  url: 'itdept/stable/ajax/userlist/form_user/cor/ajax_valid.php',
				  data: $('#staff_corusers').serialize(),
				  type: 'POST',
				  success: function(data){
					$.each( data, function( keying, valing ) {
						<?foreach($arrayForm as $keyScript => $arItems){?>
							if(valing.<?=$keyScript?>.mistakeIU == 'mistake'){
								$('#<?=$arItems['name']?>').css({'border-color':'#c11'});
								$('#mistakeIUform').remove();
								$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.<?=$keyScript?>.msg+'</div></td></tr>');
									mistake=1;
							}
						<?}?>	
					});
					if(mistake!=1){
						$.ajax({
							dataType: "HTML",
							url: 'itdept/stable/ajax/userlist/form_user/cor/form_cor_db.php',
							data: dataForm,
							type: 'POST',
							success: function(){		
								$.fancybox({ closeClick  : true});
								OutBlocks(1,valChange,valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
								staffBuildPagi(valStatus,valSearchType,valSearchData,valComp_filt,valDep_filt,valLoca_filt);
							}
						});
					}
				  }
				});	
		return false;
	});
	
	$('#staff_correct_user').on('change','#staff-cor-status',function(){	
		dataStatus = $(this).val();
		//alert(dataStatus);
		if(dataStatus == '2' || dataStatus == '3'){
			$('#datedeact-staff').show();
		}else{
			$('#datedeact-staff').hide()
			$('#data-deact-staff').val('');
		}
	});
	
	<?foreach($arrayForm as $keyScript => $arItems){?>
		$('#staff_correct_user').on('blur','#<?=$arItems['name']?>',function(){
		//alert(123);
			$.ajax({
			  dataType: "json",
			  url: 'itdept/stable/ajax/userlist/form_user/cor/ajax_valid.php',
			  data: $('#staff_corusers').serialize(),
			  type: 'POST',
			  success: function(data){
				$.each( data, function( keying, valing ) {
					if(valing.<?=$keyScript?>.mistakeIU == 'mistake'){
						$('#<?=$arItems['name']?>').css({'border-color':'#c11'});
						$('#mistakeIUform').remove();
						$('.btnarea').before('<tr id="mistakeIUform"><td colspan="2"><div style="background: #c11;color: #fff;padding: 5px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;margin: 5px 0 0 0;margin-top: 7px;width:311px;">'+valing.<?=$keyScript?>.msg+'</div></td></tr>');
					}
				});
			  }
			});	
		});
	<?}?>
	
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
$('#staff_correct_user').on('keypress','#staff_sortinginfuser',function(e){
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
</script>