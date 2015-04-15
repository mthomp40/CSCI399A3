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
    
}

function doPost() {
    global $smarty;
    smartysetup();
    connectToDatabase("mysqli://root@localhost/a3");
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
    $summary = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_SPECIAL_CHARS);
    $movie = new Moviemain();
    $movie->movie = $name;
    $movie->mgroup = $category;
    $movie->info = $summary;
    /*
      $i = 1;
      while (1) {
      echo 'in ' . $i;
      $img = "img" . $i;
      if (isset($_POST[$img])) {
      echo 'adding row ' . $i;
      $newsupp = new Moviesupp();
      $movie->Moviesupps[0] = $newsupp;
      $i++;
      } else {
      echo 'break';
      break;
      }
      }
     * 
     */
    $movie->save();

    $i = 1;
    while (1) {
        echo 'in ' . $i;
        $img = "img" . $i;
        $info = "info" . $i;
        if (isset($_POST[$img])) {
            $newsupp = new Moviesupp();
            $newsupp->photo = filter_input(INPUT_POST, $img, FILTER_SANITIZE_SPECIAL_CHARS);
            $newsupp->photocomment = filter_input(INPUT_POST, $info, FILTER_SANITIZE_SPECIAL_CHARS);
            $newsupp->save();
            $i++;
        } else {
            break;
        }
    }


    $i = 1;
    foreach ($movie->Moviesupps as $c) {
        $c->photo = filter_input(INPUT_POST, 'img' + $i, FILTER_SANITIZE_SPECIAL_CHARS);
        $c->photocomment = filter_input(INPUT_POST, 'info' + $i, FILTER_SANITIZE_SPECIAL_CHARS);
        $c->save();
    }
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET')
    doGet();
else
    doPost();
?>

<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Thommo's Movie Database</title>
        <style>
            .filedrag {
                display: block;
                color: #555;
                border: 2px dashed #555;
                border-radius: 7px;
                cursor: default;
            }
            .filedrag.hover {
                color: #f00;
                border-color: #f00;
                border-style: solid;
                box-shadow: inset 0 3px 4px #888;
                cursor: pointer;
            }
        </style>
        <script src="js/createmovie.js"></script>
    </head>
    <body>
        <div id="content">
            <div id="addMovieContainer">
                <h1>Create movie record</h1>
                <form method="POST">
                    <fieldset>
                        <legend>Main record</legend>
                        <br>Movie name: <input type="text" id="name" name="name"><br><br>
                        Category: <select id="category" name="category">
                            <option value="FANTASY/SCI.FI">FANTASY/SCI.FI</option>
                            <option value="CHICK">CHICK</option>
                            <option value="DRAMA">DRAMA</option>
                            <option value="CRIME">CRIME</option>
                            <option value="KIDS">KIDS</option>
                            <option value="COMEDY">COMEDY</option>
                            <option value="ACTION">ACTION</option>
                        </select><br><br>
                        Summary: <textarea rows="5" cols="50" id="summary" name="summary"></textarea><br><br>
                    </fieldset><br>
                    <fieldset>
                        <legend>Supplementary Data</legend>
                        <br><input type="button" value="Add Data" onclick="addData()"><br><br>
                        <table id="droppertable" border="1">
                            <tr><th>Picture</th><th>Comment</th></tr>
                        </table><br>
                    </fieldset><br>
                    <fieldset>
                        <legend>Action</legend>
                        <input type="submit" name="submit" value="Create Record">
                    </fieldset>
                </form>            
            </div>
            <div id="movieAddedContainer" style="display: none">
                <h1>Movie Records</h1>
                Created a record for   (it is record # ) with   photo
                <a href="Addmovie.php">Create Another</a>
            </div>
        </div>
    </body>
</html>