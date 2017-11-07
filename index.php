<?php 
ob_start("ob_gzhandler"); 
session_start();

include("includes/htmlTemplate.php");

if (isset($_GET["logout"])) { 
	session_destroy();
	session_start();
}

if(isset($_SESSION["username"]) || !empty($_SESSION["username"])) {
	
} else {
	header("Location: login.php");
	ob_clean();
	exit();
}

if(!isset($_SESSION["score"])){
	$_SESSION["score"] = 0;
	$_SESSION["attempts"] = 0;
}

$addition = rand(0, 1);
$val1 = rand(0, 50);
$val2 = rand(0, 50);
$answer = ($addition == 1) ? $val1 + $val2 : $val1 - $val2;?>

<html>
	<head>
		<?php doHead() ?>
	</head>
	
	<body>
		<?php doHeader(); ?>
		<article id="game">
			<section>
				<?php 
				
				if(isset($_POST["answer"]) && !empty($_POST["answer"])){
					if($_POST["input"] == $_POST["answer"]){
						$_SESSION["score"]++;
						$_SESSION["attempts"]++;
						
						echo '<h3 class="right">Correct! ';
					}else{
						echo '<h3 class="wrong">Wrong! Correct answer was ' . $_POST["answer"];
					}
				}
				
				echo "<h3>Score:" . $_SESSION["score"] . "/" . $_SESSION["attempts"] . "</h3>";
				
				echo "<h3>What is " . $val1 . (($addition == 1) ? " + " : " - ") . $val2 . "</h3>"; ?>
				
				<form method="post" action="index.php">
					<input name="input" required />
					<?php echo '<input name="answer" value="' . $answer . '" hidden autofocus />';?>
					<button type="submit">Submit</button>
				</form>
			</section>
		</article>
		<?php doFooter(); ?>
	</body>
</html>

<?php ob_end_flush(); ?>