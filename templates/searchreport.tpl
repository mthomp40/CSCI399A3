<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Thommo's Movie Database</title>
    </head>
    <body>
        <div id="content">
            <h1>Search movie library by category {$category}</h1>
            <table border="1">
                <tr><th>Movie</th></tr>
                        {foreach $movies as $movie}
                    <tr>
                        <td><a href='DisplayMovie.php?id={$movie->id}'>{$movie->movie}</a></td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </body>
</html>