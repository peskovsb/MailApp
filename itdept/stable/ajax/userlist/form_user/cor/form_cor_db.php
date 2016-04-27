<?session_start();
//--itdept DB
//require '../../../../db.php';
//require 'arrFields.php';
require '../../../../../../ajax/db.php';
require 'ajax_valid_body.php';
require '../../../../../../ajax/secfile.php';

if($userLevel['oper_correct_staff']=='1'){
if($mistake!=1){
$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();

$db_mail = new Database();
$sql = 'SELECT * FROM users WHERE staff_id=:staff_id';
$tb = $db_mail->connection->prepare($sql);
$tb->execute([':staff_id'=>$_POST['staff_id']]);
$arMails = $tb->fetch(PDO::FETCH_ASSOC);	

if($_POST['prev_status']!='1' && $_POST['staff_status']=='1'){
	
	if(!empty($arMails)){
		$tob  = $arMails['email'].', infoline@bioline.ru'; 
		//$tob  = 'peskov@bioline.ru'; 

		// тема письма
		$subjectb = 'Вы успешно зарегистрированы на корпоративном портале Infoline!';

		// текст письма
		$messageb = '
		<html>
		<head>
		  <title>'.$subjectb.'</title>
		</head>
		<body>
			<span style=" font-family:\'courier new\'; font-size: 9pt; color: #ffffff;background-color: #008080;">ИНФОЛАЙН</span><br>
			<span style="font-family:\'courier new\'; font-size: 9pt; color: #008080;">корпоративный портал</span>
			<p style=" font-family:\'Segoe UI\';font-size: 14px;">Здравствуйте, '.$_POST['staff_name'].'!<br>
			В нашей компании существует Интернет-портал, предназначенный для сотрудников компании - "ИнфоЛайн".<br>
			Он расположен по адресу <a href="http://infoline.bioline.ru">http://infoline.bioline.ru</a><br>
			Это электронное издание, которое поможет Вам познакомится с коллегами,
			узнать последние новости и посмотреть фотографии с наших мероприятий.</p>

			<p style=" font-family:\'Segoe UI\';font-size: 14px;">ссылка: <a href="http://infoline.bioline.ru">http://infoline.bioline.ru</a><br>
			Ваш логин: <b>'.$arMails['login'].'</b><br>
			Пароль: <b>7777</b></p>
			<p style=" font-family:\'Segoe UI\';font-size: 14px;">* При авторизации вы можете использовать, как логин, так и свой email. Если вы хотите сменить пароль, пришлите новый, ответом на это письмо. Если вы забудите свой пароль, вы сможете запросить его на сайте в окне авторизации.</p>
			<p style=" font-family:\'Segoe UI\';font-size: 14px;"><b style="color:#c11">Обязательно пришлите свое фото ответом на этот e-mail, чтобы мы могли разместить его на сайте! Либо вы можете прикрепить фото на сайте в вашей карточке, кликнув по аватарке и загрузив новый файл</b></p>
			<p style=" font-family:\'Segoe UI\';font-size: 14px;">Добро пожаловать в команду!!!</p>
			<p style="font-family:\'Courier New\';font-size: 12px;color:#009999;font-style:italic;">
			------------------------------<br>
			С уважением,<br>
			Песков Сергей (IT отдел)<br>
			Администратор сайтов:<br>
			http://bioline.ru<br>
			http://preanalytica.ru<br>
			http://infoline.bioline.ru<br>
			http://borcad.pro<br>
	<br>
			Телефон для связи: 233<br>
			Почта: peskov@bioline.ru
			</p>
		</body>
		</html>
		';

		// Для отправки HTML-письма должен быть установлен заголовок Content-type
		$headersb  = 'MIME-Version: 1.0' . "\r\n";
		$headersb .= 'Content-type: text/html; charset=utf-8' . "\r\n";

		// Дополнительные заголовки
		$headersb .= 'From: infoline@bioline.ru';

		// Отправляем
		mail($tob, $subjectb, $messageb, $headersb);
	}
}



/*
$_POST['staff_id']
$_POST['staff_lastname']
$_POST['staff_name']
$_POST['staff_secondname']
$_POST['staff_post']
$_POST['staff_company_id']
$_POST['staff_dopcomp1']
$_POST['staff_dopcomp2']
$_POST['staff_department']
$_POST['staff_group_id']
$_POST['staff_location']
$_POST['staff_ats']
$_POST['staff_mobnumber']
$_POST['staff_enterdate']
$_POST['staff_status']
$_POST['staff_datedeactive']
*/


	$sql = 'SELECT * FROM postusers WHERE post_name = :post_name';
	$tb = $db->connection->prepare($sql);
	$tb->execute(array(':post_name'=>trim($_POST['staff_post'])));
	$getPostUser = $tb->fetch(PDO::FETCH_ASSOC);

	/*$date_month = date('d-m',strtotime($_POST['staff_user_dr']));
	$date = DateTime::createFromFormat('!d-m', $_POST['staff_user_dr']);
	$userbdate = date_format($date, 'U');*/
	
	$dt_stt = explode('-', $_POST['staff_user_dr']);
		if($dt_stt){
			$userbdate = mktime(0, 0, 0, $dt_stt[1], $dt_stt[0], 0); 
		}else{
			$userbdate = '';
		}	
	

	if($getPostUser['post_id']){
		$post_user = $getPostUser['post_id'];
	}else{
		$userMe = 'peskov@bioline.ru';
		//trim($_POST['staff_postsorting']);
		$sql = 'INSERT INTO postusers (`post_name`,`post_sort`) VALUES (:post_name,:post_sort);';
		$tb = $db->connection->prepare($sql);
		$tb->execute(array(':post_name'=>trim($_POST['staff_post']),':post_sort'=>'100'));
		$post_user = $db->connection->lastInsertId('post_id');
		
		$sql = 'INSERT INTO itdeptpostusers (`post_name`,`post_sort`) VALUES (:post_name,:post_sort);';
		$tb = $db_infoline->connection->prepare($sql);
		$tb->execute(array(':post_name'=>trim($_POST['staff_post']),':post_sort'=>'100'));
		
		$subjPost = 'Должность в системе ITDEPT';
		
		$messageMe = 'Была задана новая должность в системе ITDEPT: '.trim($_POST['staff_post']).' (ID: '.$post_user.')<br>Нужно настроить сортировку';
		
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";

		$headers .= "From: itDept@bioline.ru>\r\n";

		mail($userMe, $subjPost, $messageMe, $headers);
	}	
	
	
	
switch($_POST['staff_status']){
	case '0': $status_staff = '0';$status_type = '';
		break;
	case '1': $status_staff = '1';$status_type = '';
		break;
	case '2': $status_staff = '1';$status_type = '0';
		break;
	case '3': $status_staff = '1';$status_type = '1';
		break;
}



if($_POST['staff_showornotinfol']){
	$showornot = 1;
}else{
	$showornot = 0;
}

$sql = 'SELECT * FROM postusers WHERE post_name=:post_name';
$tb = $db->connection->prepare($sql);
$tb->execute([':post_name'=>$_POST['staff_post']]);
$arPost = $tb->fetch(PDO::FETCH_ASSOC);




//echo date('Y-m-d',strtotime($_POST['staff_datedeactive'])).' 00:00:00';

$sql = 'UPDATE staff SET staff_dr=:staff_dr, staff_lastname=:staff_lastname, staff_name=:staff_name, staff_secondname=:staff_secondname, staff_company_id=:staff_company_id, staff_depart_id=:staff_depart_id, staff_group_id=:staff_group_id, staff_post=:staff_post, staff_dopcomp1=:staff_dopcomp1, staff_dopcomp2=:staff_dopcomp2, staff_location=:staff_location, staff_ats=:staff_ats, staff_mobnumber=:staff_mobnumber, staff_enterdate=:staff_enterdate, staff_datedeactive=:staff_datedeactive, staff_active=:staff_active, staff_typedeactive=:staff_typedeactive, staff_dop_otdel=:staff_dop_otdel WHERE staff_id =:staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_lastname'=>$_POST['staff_cor_lastname'], ':staff_name'=>$_POST['staff_name'], ':staff_secondname'=>$_POST['staff_secondname'], ':staff_company_id'=>$_POST['staff_company_id'],':staff_depart_id'=>$_POST['staff_department'],':staff_id'=>$_POST['staff_id'],':staff_group_id'=>$_POST['staff_group_id'],':staff_post'=>$post_user,':staff_dopcomp1'=>$_POST['staff_dopcomp1'],':staff_dopcomp2'=>$_POST['staff_dopcomp2'],':staff_location'=>$_POST['staff_location'],':staff_ats'=>$_POST['staff_ats'],':staff_mobnumber'=>$_POST['staff_mobnumber'],':staff_enterdate'=>date('Y-m-d',strtotime($_POST['staff_enterdate'])).' 00:00:00', ':staff_datedeactive'=>date('Y-m-d',strtotime($_POST['staff_datedeactive'])).' 00:00:00', ':staff_active'=>$status_staff, ':staff_typedeactive'=>$status_type, ':staff_dr'=>$userbdate, ':staff_dop_otdel'=>$_POST['staff_department_adition']));

$sql = 'UPDATE infoline_users SET login=:login,email=:email,lastname=:lastname, firstname=:firstname, middlename=:middlename, staff_group_id=:staff_group_id, cb_localphone=:cb_localphone, cb_post=:cb_post, cb_mobile=:cb_mobile, cb_birthday1=:staff_dr,staff_company_id=:staff_company_id, staff_depart_id=:staff_depart_id, staff_location=:staff_location, staff_active=:staff_active, staff_typedeactive=:staff_typedeactive, staff_dop_otdel=:staff_dop_otdel, staff_notshow=:staff_notshow, staff_dopcomp1=:staff_dopcomp1, staff_dopcomp2=:staff_dopcomp2 WHERE id =:id';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':login'=>$arMails['login'],':email'=>$arMails['email'],':lastname'=>$_POST['staff_cor_lastname'],':id'=>$_POST['staff_profile_infoline'],':firstname'=>$_POST['staff_name'],':middlename'=>$_POST['staff_secondname'],':staff_group_id'=>$_POST['staff_group_id'],':cb_localphone'=>$_POST['staff_ats'],':cb_post'=>$post_user,':cb_mobile'=>$_POST['staff_mobnumber'],':staff_dr'=>$userbdate,':staff_company_id'=>$_POST['staff_company_id'],':staff_depart_id'=>$_POST['staff_department'],':staff_location'=>$_POST['staff_location'],':staff_active'=>$status_staff,':staff_typedeactive'=>$status_type, ':staff_dop_otdel'=>$_POST['staff_department_adition'],':staff_notshow'=>$showornot,':staff_dopcomp1'=>$_POST['staff_dopcomp1'],':staff_dopcomp2'=>$_POST['staff_dopcomp2']));
}


}