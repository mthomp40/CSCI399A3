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
                {foreach item=supp from=$moviesupp}
                    <tr>
                        <td><img width="250" height="250" src='{$supp['photo']}'></td>
                        <td>{$supp['photocomment']}</td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </body>
</html>