<?php
ob_start("ob_gzhandler");
session_start();

include("includes/htmlTemplate.php");

$credentialsFile = "./credentials.config";
$credentialsRegEx = '/^(\S*@\S*[.]\S*) (\S*)\s*$/m';

function redirectToIndex() {
    header("Location: index.php");
}

function login($username) {
    $_SESSION['username'] = $username;
    ob_clean();
    redirectToIndex();
    exit();
}

if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    redirectToIndex();
}

if(isset($_POST['username']) && !empty($_POST['username'])) {
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $credentials = file_get_contents($credentialsFile);
        //$credentials = explode(" ", $credentials);
        preg_match_all($credentialsRegEx, $credentials, $credentialsArr, PREG_SET_ORDER, 0);
        foreach ($credentialsArr as $key => $value) {
            if($_POST['username'] == $value[1] 
                && $_POST['password'] == $value[2]) {
                login($_POST['username']);
            }
        }
        $loginMsg = "Invalid login credentials";
    } else {
        $loginMsg = "Invalid login credentials";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <?php doHead(); ?>
</head>
<body>
    <?php doHeader(); ?>
<article id="login">
    <h2>Math!</h2>
    <section>
        <h3>Login</h3>
        <form method="post">
    <?php 
    if(isset($loginMsg)) { ?>
    <h3><?php echo $loginMsg; ?></h3>
    <?php } ?>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" autofocus>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>
    <input type="submit" value="Login">
</form>
    </section>
</article>
<?php doFooter(); ?>
</body>
</html>
<?
ob_end_flush();
?>