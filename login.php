<?php
ob_start("ob_gzhandler");
session_start();

$credentialsFile = "./credentials.cfg";
$credentialsRegEx = '/^(\S*@\S*[.]\S*) (\S*)\s*$/m';

function redirectToIndex() {
    header("Location: index.php");
}

function login($username) {
    $_SESSION['username'] = $username;
    $_SESSION['score'] = 0;
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
        var_dump($credentialsArr);
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
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>
<body>
    <?php include("./includes/nav.html") ?>
<article id="login">
    <form method="post">
    <?php 
    if(isset($loginMsg)) { ?>
    <h3><?php echo $loginMsg; ?></h3>
    <?php } ?>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>
    <input type="submit">
</form>
</article>
</body>
</html>
<?
ob_end_flush();
?>