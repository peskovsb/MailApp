<?
session_start();

//--mail DB
require '../../../../../ajax/db.php';
require '../../../../../ajax/secfile.php';

//--itdept DB
//require '../../../db.php';
require 'arrFields.php';

if($userLevel['oper_correct_staff']=='1'){


$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();

$sql = 'UPDATE staff SET staff_active=1,staff_typedeactive="" WHERE staff_id=:staff_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':staff_id'=>$_POST['staff_id']));


$sql = 'UPDATE infoline_users SET staff_active=1,staff_typedeactive="" WHERE id=:inf_id';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':inf_id'=>$_POST['staff_inf_id']));

	$db_mail = new Database();
	$sql = 'SELECT * FROM users WHERE staff_id=:staff_id';
	$tb = $db_mail->connection->prepare($sql);
	$tb->execute([':staff_id'=>$_POST['staff_id']]);
	$arMails = $tb->fetch(PDO::FETCH_ASSOC);	
	
	$sql = 'SELECT * FROM staff WHERE staff_id=:staff_id';
	$tb = $db->connection->prepare($sql);
	$tb->execute([':staff_id'=>$_POST['staff_id']]);
	$arStff = $tb->fetch(PDO::FETCH_ASSOC);			
	
	

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
			<p style=" font-family:\'Segoe UI\';font-size: 14px;">Здравствуйте, '.$arStff['staff_name'].'!<br>
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
?>