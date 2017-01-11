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
		$condition = "sensor_nr=".$sensor_nr." ORDER BY id DESC LIMIT 1";   
		$temp = db_query_display_item_1("ht_temp", $condition);
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
	<?php echo $temp;?>
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="parts/jquery/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="parts/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>