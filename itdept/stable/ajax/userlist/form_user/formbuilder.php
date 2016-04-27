<?
session_start();
//--itdept DB
//require '../../../db.php';
require 'arrFields.php';
require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';

if(!empty($_POST['arrayPost'])){
	$arrayGoes = array_unique($_POST['arrayPost']);
}


$dbMail = new Database();

	$sql = 'SELECT * FROM users';
	$tb = $dbMail->connection->prepare($sql);
	$tb->execute();
	$getData = $tb->fetchAll(PDO::FETCH_ASSOC);	
	//echo '<pre>';print_r($getData);echo '</pre>';

foreach($getData as $items){
	$arrData[] = $items['email'];
}

//echo '<pre>'; print_r($arrayGoes); echo '</pre>';
?>
	<form id="formGet">
			  <select data-placeholder="Your Favorite Types of Bear" style="width:350px;" multiple class="chosen-select" tabindex="8">			  
					<?
					if(isset($arrayGoes)){
						foreach($arrayGoes as $Items){?>	
							<option selected><?=$Items?></option>
						<?}?>	  
						<?foreach($arrData as $Items){?>	
							<?if(in_array($Items, $arrayGoes)){?><?}else{?><option><?=$Items?></option><?}?>
						<?}
					}else{?>
						<?foreach($arrData as $Items){?>	
							<?if(in_array($Items, $arrayGoes)){?><?}else{?><option><?=$Items?></option><?}?>
						<?}?>
					<?}?>
			  </select>
	</form>
<script type="text/javascript">
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
</script>	