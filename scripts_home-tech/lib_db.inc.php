<?php

/** 
* library for db functions 
*
* PHP from version 5
*
* @category Site
* @package  Home-Tech
* @author   Joerg Sorge <joergsorge@googel.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://joergsorge.de
*/

require "db_conf.inc.php";

function db_query_list_items_1( $table, $fields, $condition ){
    $db = db_connect_pdo();
    if ( substr($condition, 0, 7) == "NOWHERE" ) {
        // condition enthaelt z.B. ORDER BY
        $stmt = $db->query('SELECT '.$fields.' FROM '.$table.' '.substr($condition,7));
    }else{
        $stmt = $db->query('SELECT '.$fields.' FROM '.$table.' WHERE '.$condition);
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function db_query_display_item_1( $table, $condition ){
    $db = db_connect_pdo();
    $stmt = $db->query('SELECT * FROM '.$table.' WHERE '.$condition);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function db_query_update_item_1( $table, $fields, $value1, $value2, $value3, $value4, $id ){
    // item aktualisieren
    $db = db_connect_pdo();
    $stmt = $db->prepare("UPDATE ".$table." SET ".$fields." WHERE id=?");
    $stmt->execute(array($value1, $value2, $value3, $value4, $id));

}

function db_query_add_item( $table, $fields, $sensor_nr, $value ) {
    // add row
    $db = db_connect_pdo();
    $stmt = $db->prepare("INSERT INTO ".$table."(".$fields.") VALUES(:sensor_nr,:value)");
    $stmt->execute(array(':sensor_nr' => $sensor_nr, ':value' => $value));
    $insertId = $db->lastInsertId();
    return $insertId;
}

function db_query_add_item_1( $table, $fields, $value1, $value2, $value3, $value4 ) {
    // add row
    $db = db_connect_pdo();
    $stmt = $db->prepare("INSERT INTO ".$table."(".$fields.") VALUES(:value1,:value2,:value3,:value4)");
    $stmt->execute(array(':value1' => $value1, ':value2' => $value2, ':value3' => $value3, ':value4' => $value4));
    $insertId = $db->lastInsertId();
    return $insertId;
}

function db_query_delete_items( $table, $condition ) {
    $db = db_connect_pdo();
    $stmt = $db->query("DELETE FROM ".$table." WHERE ".$condition);
    $result = $stmt->execute();
    return $result;
}

function db_query_delete_item_1( $table, $id ){
    $db = db_connect_pdo();
    $stmt = $db->prepare("DELETE FROM ".$table." WHERE id=:id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
?>

