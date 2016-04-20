<?php
session_name("session_example_cookie");
session_set_cookie_params(86400, 'labs/session_example');
session_start();
?>

<?php
//$result = preg_replace('/.*/e', "exec('uptime');", 'test');
//print_r($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/style/primer.css">
<title>RVWA</title>
</head>
<body>
<div class="container"><!-- BEGIN CONTAINER -->

<?php
    //open the database
    $db = new PDO('sqlite:xss03_Db_PDO.sqlite');

    //create the database
    $db->exec("CREATE TABLE IF NOT EXISTS Posts (Id INTEGER PRIMARY KEY, Comment TEXT)");    
    $r = $db->query('SELECT * FROM Posts');
    if ($r->fetchColumn() < 1){
        $db->exec("INSERT INTO Posts (Comment) VALUES ('Hello, World!');");
    }


if (isset($_GET['comment'])) {
    $comment = $_GET['comment'];

    $comment = preg_replace( "/[^a-zA-Z0-9_]/", "", $comment);

    $db->exec("INSERT INTO Posts (Comment) VALUES ('$comment');");
}

?>
<h1>XSS 04</h1>

<form class="form1" method="get" action="" id="form1">
<fieldset>
    <ul>
        <p>Leave A Comment!</p>

        <label for="comment">Post:</label>
        <span>
            <textarea name="comment"><?php if (isset($_GET['comment'])) {
                echo htmlentities($_GET['comment']);
            } ?></textarea>
        </span>

        <input  class="submit" value="Next" type="submit" name="Submit"/> 
    </ul>
    <br/>
    </fieldset>
</form>
<h2>Comments</h2>
<?php
$r = $db->query('SELECT * FROM Posts');
foreach($r as $row){
    print "<p>Comment #".$row['Id']."-- ".$row['Comment']."<p>";
}
$db = NULL;
?>
</div><!-- END CONTAINER -->
</body>
</html>

