<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Thommo's Movie Database</title>
    </head>
    <body>
        <div id="content">
            <h1>Details {$name}</h1>
            <h2>{$category}</h2>
            <h3>Info</h3>
            <p>{$info}</p>
            <h3>Supplementary Data</h3>
            <table>
                {foreach $suppdata as $suppdatarow}
                    <tr>
                        <td><img src="{$suppdatarow[2]}"></td>
                        <td>{$suppdatarow[3]}</td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </body>
</html>