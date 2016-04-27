<script type="text/javascript">

function validFunction(fieldstatus,fieldname){
	
    if(fieldstatus == 'mistake') {
        $('#'+fieldname).parent().css({'border-color': '#c11'});
        return mistake = 1;		
    }
}


$('#wrapper-<?=$formBuild?>').on('submit','#<?=$formBuild?>-create',function(){
	//--MainParams
    dataForm = $(this).serialize();
    formType = $(this).attr('id');

    mistake = 0;

    $('.msg-error-cover').remove();

    //--Validation CHECK *SUBMIT
$.ajax({
    dataType: "json",
    data: dataForm,
    type: "POST",
    url : "<?=$jsScriptUrl?>/ajax_valid.php",
    success : function (data) {
        $.each( data, function( key, val ) {
<?foreach($formArr as $key => $Items){?>
<?switch($key){?>
<?case 'post_name':?>
<?case 'post_sort':?>
    validFunction(val.<?=$key?>.mistakeIU,'<?=$Items["name"]?>');
<?break;?>
<?}?>
<?}?>
        });
        if(mistake == 0 ){
                $('.msg-error-cover').remove();
                $('.msg-success-cover').remove();
                $.ajax({
                    dataType: "HTML",
                    data: dataForm,
                    type: "POST",
                    url: "<?=$jsScriptUrl?>/create/ajax_submit.php",
                    success: function (data) {
						$('.mistake-field-callback').remove();                        
						
						$('#wrapper-<?=$formBuild?> .btn.green').after('<div class="mistake-field-callback" style="font-size:14px;background: #090;color: #fff;padding: 15px;width: 312px;margin: 15px 0 0 0px;text-align: center;">Должность добавлена успешно</div>');
                        
						
						$.ajax({
						  url: "ajax/postusers/show.php",
						  success: function(data){
								$('#innerPostsIU').show();
								$('#innerPostsIU').html(data);					
							}
						});						
                    }
                });
        }else{
			$('.mistake-field-callback').remove();
			$('#wrapper-<?=$formBuild?> .btn.green').after('<div class="mistake-field-callback" style="font-size:14px;background: #c11;color: #fff;padding: 15px;width: 312px;margin: 15px 0 0 0px;text-align: center;">Ошибка! Нужно заполнить все поля</div>');
		}
    }
});
    return false;
});

<?foreach($formArr as $key => $Items){?>
<?switch($key){?>
<?case 'post_name':?>
<?case 'post_sort':?>
$('#wrapper-<?=$formBuild?>').on('keyup','#<?=$Items["name"]?>',function() {
    //$('.mistake-field-callback').remove();
    $(this).parent().css({'border-color':'#ccc'});
});
<?break;?>
<?}?>
<?}?>

</script>
