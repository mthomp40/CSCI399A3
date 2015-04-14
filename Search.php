<?php

require_once("adodb5/adodb.inc.php");
require_once("adodb5/adodb-active-record.inc.php");
require_once("smarty3/libs/Smarty.class.php");

class Moviemain extends ADOdb_Active_Record {
    
}

class Moviesupp extends ADOdb_Active_Record {
    
}

// Global variables
$smarty = new Smarty();
$db = null;

function smartysetup() {
    global $smarty;

    $smarty->template_dir = './templates';
    $smarty->compile_dir = './templates_c';
    $smarty->cache_dir = './cache';
    $smarty->config_dir = './configs';
}

function connectToDatabase($dsn) {
    global $db;
    $db = ADONewConnection($dsn);
    if (!$db) {
        die("Failed to connect to database : " . $dsn);
    }
    ADOdb_Active_Record::SetDatabaseAdapter($db);
    ADOdb_Active_Record::ClassHasMany('Moviemain', 'Moviesupps', 'fk_movie');
}

smartysetup();
connectToDatabase("mysqli://root@localhost/a3");
$sqlstr = "select id, movie from Moviemains";
$stmt = $db->Prepare($sqlstr);
$rs1 = $db->Execute($stmt);

$data = array();

while (!$rs1->EOF) {
    $mid = $rs1->fields[0];
    $mname = $rs1->fields[1];

    $item = array($mid, $mname);
    $data[] = $item;
    $rs1->MoveNext();
}
$rs1->close();

$sqlstr = "select column_type from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = 'Moviemains' and COLUMN_NAME = 'mgroup'";
$stmt = $db->Prepare($sqlstr);
$rs1 = $db->Execute($stmt);

if (!$rs1->EOF) {
    preg_match('/enum\((.*)\)$/', str_replace("'", "", $rs1->fields[0]), $matches);
    $vals = explode(',', $matches[1]);
}

$db->close();
$smarty->assign("movies", $data);
$smarty->assign("category", $vals[0]);
$smarty->display("searchreport.tpl");

smartysetup();

$smarty->assign('categories', $vals);
/*
  $smarty->assign('categories', array(
  'FANTASY/SCI.FI',
  'CHICK',
  'DRAMA',
  'CRIME',
  'KIDS',
  'COMEDY',
  'ACTION'
  ));
 */
$smarty->assign('selectedCategory', 'KIDS');
$smarty->display('movie.tpl');
?>