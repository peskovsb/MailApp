<!-- js mask -->
<div id="wrapper-<?=$formBuild?>" style="padding:20px">
<h1 class="form-header">Редактировать должность</h1>
    <form id="<?=$formBuild?>-correct">
		<input type="hidden" name="id" value="<?=$_GET['id']?>">
        <div class="form-wrapper-main">
           <table>
                <?foreach($formArr as $key => $Items){?>
					<tr>
						<td><?=$Items['title']?></td>
						<td style="margin-bottom:8px;">
							<div style="margin-left:15px;">
								<input id="<?=$Items["name"]?>" class="field-tpl" type="text" name="<?=$Items["name"]?>" value="<?=$arrAll[$key]?>">
							</div>	
						</td>
					</tr>
				<?}?>
					<tr>
						<td colspan="2">						
							<input style="margin-top:30px" class="btn green" type="submit" name="<?=$prefix?>_sendform" value="<?=$nameCorrectSender?>">
						</td>
					</tr>				
			
				</table>
            
        </div>
		<div style="clear:both"></div>
    </form>
</div>

<style>
.form-header {
    height: 30px;
    line-height: 30px;
    font-size: 18px;
    color: #000;
    padding: 0;
    border-bottom: 2px solid #000;
    margin-bottom: 20px;
	margin:0;
}
</style>

<script>
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

$(document).on('keypress','#<?=$formArr['post_sort']['name']?>',function(e){
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