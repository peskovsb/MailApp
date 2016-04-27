<script type="text/javascript">

function validFunction(fieldstatus,fieldname){
	
    if(fieldstatus == 'mistake') {
        $('#'+fieldname).parent().css({'border-color': '#c11'});
        return mistake = 1;		
    }
}


$('#wrapper-<?=$formBuild?>').on('submit','#<?=$formBuild?>-delete',function(){
	//--MainParams
    dataForm = $(this).serialize();
    formType = $(this).attr('id');
   $.ajax({
			dataType: "HTML",
			data: dataForm,
			type: "POST",
			url: "<?=$jsScriptUrl?>/delete/ajax_submit.php",
			success: function (data) {
				$('.mistake-field-callback').remove();                        
				
				$('#wrapper-<?=$formBuild?> .btn.red').next().after('<div class="mistake-field-callback" style="font-size:14px;background: #090;color: #fff;padding: 15px;width: 312px;margin: 15px 0 0 0px;text-align: center;width: 132px;">Должность удалена успешно</div>');
				
				
				$.ajax({
				  url: "ajax/postusers/show.php",
				  success: function(data){
						$('#innerPostsIU').show();
						$('#innerPostsIU').html(data);					
					}
				});						
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
