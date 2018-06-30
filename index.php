
<?php
require_once 'config.php';
require dbpath.'DB_action.php';

$db = new DB_action();
$data = $db->add('sample', array('name' => 'karthik'));
print_r($data);
?>