<?php
/** 
* view temp
*
* PHP version 5
*
* @category Ajax
* @package  Home-Tech
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://www.joergsorge.de
*/

require "../../../../scripts_home-tech/lib_db.inc.php";

if ( !isset($_GET['pa']) ) {	
	echo "Error - No param!";
	exit;
}

if ( !is_numeric($_GET['pa']) ) {
	echo "Error - No valid value!";
	exit;		
}

$sensor_nr = $_GET['pa'];
// load last 2 for comparing
$condition = "sensor_nr=".$sensor_nr." ORDER BY id DESC LIMIT 2";
$tbl_rows = db_query_list_items_1( "ht_temp", "temp", $condition );

// load last value
$condition = "sensor_nr=".$sensor_nr." ORDER BY id DESC LIMIT 1";   
$tbl_row = db_query_display_item_1("ht_temp", $condition);
$temp = $tbl_row["temp"] / 1000;

if ($tbl_rows[0]["temp"] > $tbl_rows[1]["temp"]){
	echo $temp.' <span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"></span>';		
}
if ($tbl_rows[0]["temp"] == $tbl_rows[1]["temp"]){
	echo $temp.' <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>';
}
if ($tbl_rows[0]["temp"] < $tbl_rows[1]["temp"]){
	echo $temp.' <span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span>';		
}

?>
