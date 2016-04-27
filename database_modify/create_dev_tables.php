<?php
/**
 * Created by PhpStorm.
 * User: Peskov
 * Date: 04.08.2015
 * Time: 14:20
 */
require '../ajax/db.php';
$db = new DatabaseItDept();
$sql = 'CREATE TABLE IF NOT EXISTS `devtypes` ( `devtype_id` int(11) NOT NULL AUTO_INCREMENT, `devtype_name` varchar(255) NOT NULL, `devtype_pref` varchar(155) NOT NULL, PRIMARY KEY (`devtype_id`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
$tb = $db->connection->prepare($sql);
$tb->execute();

$sql = 'CREATE TABLE IF NOT EXISTS `devices` ( `device_id` int(15) NOT NULL AUTO_INCREMENT, `devtype_id` int(15) NOT NULL, `company_id` int(15) NOT NULL, `device_num` int(6) ZEROFILL NOT NULL, `device_komment` text NOT NULL, `device_status` int(15) NOT NULL, PRIMARY KEY (`device_id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
$tb = $db->connection->prepare($sql);
$tb->execute();

$sql = 'ALTER TABLE company ADD company_pref varchar(155) NOT NULL AFTER company_name;';
$tb = $db->connection->prepare($sql);
$tb->execute();
