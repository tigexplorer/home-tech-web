<?php
/** 
* load temp
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

$option = "";

if ( isset($_GET['pb']) ) {	
	$option = $_GET['pb'];
}

$arrow = ' <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>';
$color = '<span>';
$sensor_nr = $_GET['pa'];

// load last 2 for comparing
$condition = "sensor_nr=".$sensor_nr." ORDER BY id DESC LIMIT 2";
$tbl_rows = db_query_list_items_1( "ht_temp", "temp", $condition );

// load last value
$condition = "sensor_nr=".$sensor_nr." ORDER BY id DESC LIMIT 1";   
$tbl_row = db_query_display_item_1("ht_temp", $condition);

// outdoor temprature will display with decimals
if ( $sensor_nr == "1" ) {
	$temp = substr( $tbl_row["temp"] / 1000, 0, 5);
} else {
	if ( strlen($tbl_row["temp"] ) > 5 ) {
		$temp = substr( $tbl_row["temp"] / 1000, 0, 3);
	} else {
		$temp = substr( $tbl_row["temp"] / 1000, 0, 2);
	}
}

if ( $sensor_nr == "1" ) {
	$temp_old = substr( $tbl_rows[1]["temp"] / 1000, 0, 5);
} else {
	if ( strlen($tbl_row["temp"] ) > 5 ) {
		$temp = substr( $tbl_row[1]["temp"] / 1000, 0, 3);
	} else {
		$temp = substr( $tbl_row[1]["temp"] / 1000, 0, 2);
	}
}

// select arrow
if ( $tbl_rows[1]["temp"] > $tbl_rows[0]["temp"] ){
	$arrow = ' <span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"></span>';		
}
if ( $tbl_rows[1]["temp"] == $tbl_rows[0]["temp"] ){
	$arrow = ' <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>';
}
if ( $tbl_rows[1]["temp"] < $tbl_rows[0]["temp"] ){
	$arrow = ' <span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span>';		
}

// select color
if ( $temp < 40 ) {
	$color = '<span class="counter-cold">';
}
if ( $temp >= 50 and $temp < 80 ) {
	$color = '<span class="counter-warm">';
}
if ( $temp >= 80 ) {
	$color = '<span class="counter-hot">';
}

if ( $option == "value_only" ) {
	echo $temp;
} else {
	// return html-formatted value
	echo '<span id="temp_'.$sensor_nr.'a">'.$temp."</span>".$color.$arrow."</span>";
}
?>
