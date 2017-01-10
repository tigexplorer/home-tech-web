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
require "../../scripts_home-tech/lib_common.inc.php";

echo "a";
// check action	
if ( isset($_GET['action']) ) {	
    $action = $_GET['action'];		
    $action_ok = "yes";
}
# TODO else pa und pb
if ( $action_ok == "yes" ) {		
    if ( isset($_GET['pa']) ) {	
        $field = $_GET['pa'];
    }
    if ( isset($_GET['pb']) ) {	
        $value1 = $_GET['pb'];
    }

} else {
	$message = "No Command. Nothing to do...";
	return $message;
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