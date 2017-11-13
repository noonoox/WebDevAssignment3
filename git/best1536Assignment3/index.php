<?php 
ob_start("ob_gzhandler"); 
session_start();

include("includes/htmlTemplate.php");

function logout() {
	session_destroy();
	session_start();
	header("Location: login.php");
	ob_clean();
	exit();
}
function newQuestion() {
	$addition = rand(0, 1);
	$val1 = rand(0, 50);
	$val2 = rand(0, 50);
	$answer = ($addition == 1) ? $val1 + $val2 : $val1 - $val2;
	$_SESSION['sign'] = $addition;
	$_SESSION['val1'] = $val1;
	$_SESSION['val2'] = $val2;
	$_SESSION['answer'] = $answer;
}

if (isset($_GET["logout"]) || !isset($_SESSION["username"]) || empty($_SESSION["username"])) { 
	logout();
}

if(!isset($_SESSION['answer'])) {
	$_SESSION["score"] = 0;
    $_SESSION["attempts"] = 0;
	newQuestion();
}

// valid input
if (isset($_POST["input"]) && !empty($_POST["input"]) && is_numeric($_POST["input"]) && $_SESSION["attempts"] == $_POST['attempts'] ) {

	// right/wrong answer
	if ($_POST["input"] == $_SESSION["answer"]) {
		$_SESSION["lastAnswer"] = true;
		$_SESSION["score"]++;
	} else {
		$_SESSION["lastAnswer"] = false;
	}
	$_SESSION["attempts"]++;

	newQuestion();
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php doHead() ?>
	<title>Math Game</title>

</head>

<body>
	<?php doHeader(); ?>
	<article id="game">
		<h2>Math!</h2>
		<section id="math">
			<?php 

			if(isset($_SESSION["lastAnswer"])) {
				if($_SESSION["lastAnswer"] == true){
					echo '<h3 class="right">Correct! ';
				}else if($_SESSION["lastAnswer"] == false){
					echo '<h3 class="wrong">Wrong! Correct answer was ' . $_SESSION["answer"];
				}
			}

			echo "<h3>Score: " . $_SESSION["score"] . "/" . $_SESSION["attempts"] . "</h3>";

			?>

			<form id="mathForm" method="post" action="index.php">
				<?php echo "<h3>What is " . $_SESSION['val1'] . (($_SESSION['sign'] == 1) ? " + " : " - ") . $_SESSION['val2'] . "</h3>"; ?>
				<input id="input" name="input" required autofocus />
				<?php echo '<input name="answer" value="' . $_SESSION['answer'] . '" hidden />';?>
				<input hidden type="text" name="attempts" value="<?php echo $_SESSION["attempts"]; ?>">
				<button type="submit">Submit</button>
			</form>
		</section>
	</article>
	<?php doFooter(); ?>
</body>
</html>

<?php 
ob_end_flush();
 ?>