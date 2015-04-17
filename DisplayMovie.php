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

function doGet() {
    global $smarty;
    smartysetup();
    connectToDatabase("mysqli://root@localhost/a3");

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $movie = new Moviemain();
    $movie->Load("id=?", $id);
    $suppdata = array();
    foreach ($movie->Moviesupps as $c) {
        $moviesupp = array();
        $moviesupp['photo'] = $c->photo;
        $moviesupp['photocomment'] = $c->photocomment;
        array_push($suppdata, $moviesupp);
    }
    $smarty->assign('name', $movie->movie);
    $smarty->assign('category', $movie->mgroup);
    $smarty->assign('info', $movie->info);
    $smarty->assign('moviesupp', $suppdata);
    $smarty->display('movie.tpl');
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET')
    doGet();
else
    doPost();
?>