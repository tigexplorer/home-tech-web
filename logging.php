<?php
/** 
* edit notes
*
* PHP version 5
*
* @category Site
* @package  Notes
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

# TODO else pa und pb
if ( $action_ok ) {
	if ( isset($_GET['pa']) ) {	
		$action = $_GET['pa'];
		$params += 1;
	}
	if ( isset($_GET['pb']) ) {	
		$field = $_GET['pb'];
		$params += 1;
	}
	if ( isset($_GET['pc']) ) {	
		$value1 = $_GET['pc'];
		$params += 1;
	}
	//echo $params;

} else {
	$message = "No Command. Nothing to do...";
	echo $message;
	exit;
}

if ( $params <> 3 ) {
	$message = "Not enough Params. Nothing to do...";
	echo $message;
	exit;
}

// switch action 
switch ( $action ):
	case "add":    
		$new_id = db_query_add_item("ht_temp", $field, $value1);
		$message = $new_id;
		break;

endswitch;
echo $message;
?>