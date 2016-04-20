<?php
session_name("session_example_cookie");
session_set_cookie_params(86400, 'labs/session_example');
session_start();
?>

<?php
if (isset($_GET['Submit'])){
    $_SESSION[$_GET['varname']] = $_GET['varvalue'];
}
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

<h1>Session Example</h1>

<form class="form1" method="get" action="" id="form1">
<fieldset>
    <ul>
        <p>Enter a varible / value pair.</p>

        <label for="name">Var Name:</label>
        <span>
        	<input type="text" name="varname" placeholder="name" class="required" role="input" aria-required="true"/>
        </span>

        <label for="name">Value:</label>
        <span>
        	<input type="text" name="varvalue" placeholder="value" class="required" role="input" aria-required="true"/>
        </span>

        <input  class="submit" value="Next" type="submit" name="Submit"/> 
    </ul>
    <br/>
    </fieldset>
</form>

<h2>Session Data:</h2>
<p>
<?php
if(empty($_SESSION)){
    print "No session data.";
}else{
    foreach ($_SESSION as $key => $value) {
        print "[".$key."] => ".$value."<br/>";
    } 
}?>
</p>
</div><!-- END CONTAINER -->
</body>
</html>

