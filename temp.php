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
		$action = $_GET['pa'];
		$params += 1;
	}
	if ( isset($_GET['pb']) ) {	
		$sensor_nr = $_GET['pb'];
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
	case "view_temp":
		$condition0 = "sensor_nr=".$sensor_nr." ORDER BY id DESC LIMIT 2";
		$tbl_rows = db_query_list_items_1( "ht_temp", "temp", $condition0 );
		
		$condition = "sensor_nr=".$sensor_nr." ORDER BY id DESC LIMIT 1";   
		$tbl_row = db_query_display_item_1("ht_temp", $condition);
		//$message = $new_id;
		break;
	default:
		$message = "No valid action";
		break;
endswitch;
//echo $message;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Home-Tech</title>
    <!-- Bootstrap -->
    <link href="parts/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <h1>Home-Tech at Alpha-Lab</h1>
		<?php 
		print_r ($tbl_rows);
		print_r ($tbl_rows[0]);
		echo "x".$tbl_rows[0]["temp"]."x";
		if ($tbl_rows[0]["temp"] > $tbl_rows[1]["temp"]){
			echo "gr";		
		}
		if ($tbl_rows[0]["temp"] == $tbl_rows[1]["temp"]){
			echo "gl";		
		}
		if ($tbl_rows[0]["temp"] < $tbl_rows[1]["temp"]){
			echo "kl";		
		}
		foreach ( $tbl_rows as $tbl_row) {
			$i++;
			echo $i."<br>";
			echo $tbl_row["temp"]."<br>";
			$temp = $tbl_row["temp"];
			if($i==2) {
				echo ">1<br>";
				echo $temp."<br>";
				echo $tbl_row["temp"]."<br>";
				if($tbl_row["temp"] > $temp) {
					echo ">";
				} else {
					echo "gggs";
					}
		}
		}		
		echo $tbl_row["temp"] / 1000;
		?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="parts/jquery/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="parts/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>