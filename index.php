<?php ob_start("ob_gzhandler"); session_start();

/*if(!isset($_SESSION["username"] && empty($_SESSION("username")))){
	header("Location: login.php");
}*/

if(!isset($_SESSION["score"])){
	$_SESSION["score"] = 0;
	$_SESSION["attempts"] = 0;
}

if(isset($_POST["answer"])){
	if($_POST["input"] == $_POST["answer"]){
		score++;
	}
	
	$_SESSION["attempts"]++;
	
	echo "<h1><h1>";
}

$addition = rand(0, 1);
$val1 = rand(0, 50);
$val2 = rand(0, 50);
$answer = ($addition == 1) ? $val1 + $val2 : $val1 - $val2;

echo "<h2>What is " . $val1 . (($addition == 1) ? " + " : " - ") . $val2 . "</h2>"; ?>

<form method="post" action="index.php">
	<input name="input" required />
	<input name="answer" value=" <?php $answer ?> " hidden />
	<button type="submit">Submit</button>
</form>

<?php ob_end_flush(); ?>