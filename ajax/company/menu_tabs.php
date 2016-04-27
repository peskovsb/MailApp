<?session_start();?>
<ul class="tabls-company-adm">
	<?if($_SESSION['user_level']=='2'){?><li>
		<a class="top-tabs-comp IU-company-btn active-comp-menu" href="javascript:void(0);">Отделы</a>
	</li><?}?>
	<?if($_SESSION['user_level']=='2'){?><li>
		<a class="top-tabs-comp" id="actme_location" onclick="showTabs('location')" href="javascript:void(0);">Локации</a>
	</li><?}?>
	<?if($_SESSION['user_level']=='2'){?><li>
		<a class="top-tabs-comp IU-posts-btn" href="javascript:void(0);">Должности</a>
	</li><?}?>
	<?if($_SESSION['user_level']=='2'){?><li>
		<a class="top-tabs-comp" id="staff_createuser_from_it" style="border-right:0;" href="javascript:void(0);">Новый сотрудник (Staff)</a>
	</li><?}?>
</ul>
<div style="clear:both"></div>