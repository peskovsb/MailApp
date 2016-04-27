<?
require '../../db.php';
$db = new DatabaseItDept();
$db_infoline = new DatabaseInfoline();

$sql = 'UPDATE location SET location_name=:location_name WHERE location_id = :location_id';
$tb = $db->connection->prepare($sql);
$tb->execute(array(':location_id'=>$_POST['dep_id'],':location_name'=>$_POST['fld-name-location-cor']));

$sql = 'UPDATE itdeptlocation SET location_name=:location_name, location_url=:location_url, staff_locationssprting=:staff_locationssprting, alternate_name=:alternate_name,location_info=:location_info WHERE location_id = :location_id';
$tb = $db_infoline->connection->prepare($sql);
$tb->execute(array(':location_id'=>$_POST['dep_id'], ':location_url'=>$_POST['fld-url-location-cor'],':location_name'=>$_POST['fld-name-location-cor'],':staff_locationssprting'=>$_POST['fld-sorting-location-cor'], ':alternate_name'=>$_POST['fld-altname-location-cor'],':location_info'=>$_POST['fld-infotext-location-cor']));
//echo $_POST['fld-url-location-cor'];
?>