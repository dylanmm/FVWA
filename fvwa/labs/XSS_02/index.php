<?php
session_name("session_example_cookie");
session_set_cookie_params(86400, 'labs/session_example');
session_start();
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
    $db = new PDO('sqlite:xss02_Db_PDO.sqlite');

    //create the database
    $db->exec("CREATE TABLE IF NOT EXISTS Posts (Id INTEGER PRIMARY KEY, Comment TEXT)");    
    $r = $db->query('SELECT * FROM Posts');
    if ($r->fetchColumn() < 1){
        $db->exec("INSERT INTO Posts (Comment) VALUES ('Hello, World!');");
    }

$blacklist = array("<script>", 
                   "</script>"
                   );

if (isset($_GET['comment'])) {
    $comment = $_GET['comment'];
    foreach ($blacklist as $key) {
        $comment = str_replace($key, '', $comment);
    }
    $db->exec("INSERT INTO Posts (Comment) VALUES ('$comment');");
    //hi'); INSERT INTO Posts (Comment) VALUES ('ATTACK
}

?>
<h1>XSS 02</h1>

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
