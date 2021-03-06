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
    ?>
    <!DOCTYPE html >
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Thommo's Movie Database</title>
        </head>
        <body>
            <div id="content">
                <h1>Search the movie records</h1>
                <form method="POST">
                    <fieldset>
                        Category:
                        <select id="category" name="category">
                            <option value="FANTASY/SCI.FI">FANTASY/SCI.FI</option>
                            <option value="CHICK">CHICK</option>
                            <option value="DRAMA">DRAMA</option>
                            <option value="CRIME">CRIME</option>
                            <option value="KIDS">KIDS</option>
                            <option value="COMEDY">COMEDY</option>
                            <option value="ACTION">ACTION</option>
                        </select>
                    </fieldset>
                    <fieldset>
                        <legend>Action</legend>
                        <input type="submit" name="submit" value="Search Records"> 
                    </fieldset>
                </form>
            </div>
        </body>
    </html>
    <?php
}

function doPost() {
    global $smarty;
    smartysetup();
    connectToDatabase("mysqli://root@localhost/a3");

    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
    $movie = new Moviemain();
    $movies = $movie->Find("mgroup=?", $category);
    $smarty->assign("movies", $movies);
    $smarty->assign("category", $category);
    $smarty->display("searchreport.tpl");
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET')
    doGet();
else
    doPost();
?>