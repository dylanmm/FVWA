<?php
session_name("med_auth_attack");
session_set_cookie_params(86400, 'med_auth_attack/');
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
$logged_in = false;

if (isset($_GET['user']) && isset($_GET['password'])) {
    $_SESSION['login_attempts'] += 1;
    if ($_GET['user'] == "admin" && $_GET['password'] == "password") {
        $logged_in = true;
    }
}

if (!$logged_in && $_SESSION['login_attempts'] <= 3) {
    // NOT LOGGED IN
?>

<h1>Login...</h1>

<form class="form1" method="get" action="" id="form1">
<fieldset>
    <ul>
        <p>Enter a varible / value pair.</p>

        <label for="user">Username:</label>
        <span>
        	<input type="text" name="user" placeholder="user name" class="required" role="input" aria-required="true"/>
        </span>

        <label for="password">Password:</label>
        <span>
        	<input type="password" name="password" placeholder="value" class="required" role="input" aria-required="true"/>
        </span>

        <input class="submit" type="submit" name="Submit" /> 
    </ul>
    <br/>
    </fieldset>
</form>

<?php
} elseif ($logged_in) {
?>
    <h1>Hello, <?php echo $_GET['user'];?></h1>
    
<?php
} elseif ($_SESSION['login_attempts'] > 3) {
?>

    <h1>Wait like 30 seconds! Geesh..</h1>

<?php
}
?>
</div><!-- END CONTAINER -->
</body>
</html>