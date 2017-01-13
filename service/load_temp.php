<?php
/** 
* load temp 2
*
* PHP version 5
*
* @category Ajax
* @package  Home-Tech
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.joergsorge.de
*/

require "../../../scripts_home-tech/lib_db.inc.php";

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
	if ( !is_numeric($_GET['pa']) ) {
		echo "Error - No valid value!";
		exit;		
	}	
} else {
	$message = "Error 0 - No Command. Nothing to do...";
	echo $message;
	exit;
}

if ( $params <> 1 ) {
	$message = "Error 1 - Not enough Params. Nothing to do...";
	echo $message;
	exit;
}

// switch action 
switch ( $action ):
	case "load_temp":
		$sensor_nr = $_GET['pa'];
		// load last value
		$condition = "sensor_nr=".$sensor_nr." ORDER BY id DESC LIMIT 1";   
		$tbl_row = db_query_display_item_1("ht_temp", $condition);
		$message = substr( $tbl_row["temp"] / 1000, 0, 2);
		break;
	default:
		$message = "No valid action";
		break;
endswitch;
echo $message;

?>
