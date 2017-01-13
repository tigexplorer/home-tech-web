<?php
/** 
* edit notes
*
* PHP version 5
*
* @category Site
* @package  Home-Tech
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.joergsorge.de
*/

require "../../scripts_home-tech/lib_db.inc.php";

$action = "";
$action_ok = false;
$params = 0;

// check action	
if ( isset($_GET['action']) ) {	
    $action = $_GET['action'];		
    $action_ok = true;
}

if ( $action_ok ) {
	if ( isset($_GET['pa']) ) {	
		$sensor_nr = $_GET['pa'];
		$params += 1;
	}
	if ( isset($_GET['pb']) ) {	
		$value1 = $_GET['pb'];
		$params += 1;
	}
	//echo $params;

} else {
	$message = "No Command. Nothing to do...";
	echo $message;
	exit;
}

if ( $params <> 2 ) {
	$message = "Not enough Params. Nothing to do...";
	echo $message;
	exit;
}

// switch action 
switch ( $action ):
	case "add_temp":    
		$new_id = db_query_add_item("ht_temp", "sensor_nr, temp", $sensor_nr, $value1);
		$message = $new_id;
		break;
	default:
		$message = "No valid action";
		break;
endswitch;
echo $message;
?>