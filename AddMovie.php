<?php
require_once("adodb5/adodb.inc.php");
require_once("adodb5/adodb-active-record.inc.php");
require_once("smarty3/libs/Smarty.class.php");

class movie extends ADOdb_Active_Record {
    
}

// Global variables
$smarty = new Smarty();

function smartysetup() {
    global $smarty;

    $smarty->template_dir = './templates';
    $smarty->compile_dir = './templates_c';
    $smarty->cache_dir = './cache';
    $smarty->config_dir = './configs';
}

function connectToDatabase($dsn){
    global $db;
    $db = ADONewConnection($dsn);
    if (!$db){
        die("Failed to connect to database : " . $dsn);
    }
    ADOdb_Active_Record::SetDatabaseAdapter($db);
}

//$db = $_REQUEST['db'];

$mysqldsn = "mysqli://root@localhost/a3";
connectToDatabase($mysqldsn);



smartysetup();

$smarty->assign('categories', array(
    'FANTASY/SCI.FI',
    'CHICK',
    'DRAMA',
    'CRIME',
    'KIDS',
    'COMEDY',
    'ACTION'
));

$smarty->assign('selectedCategory', 'KIDS');
$smarty->display('movie.tpl');

?>