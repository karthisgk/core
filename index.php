
<?php
require_once 'config.php';
require dbpath.'DB_action.php';

$db = new DB_action();
$data = $db->remove('sample', array('id' => 1));
?>