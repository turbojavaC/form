<?php
/*function isValid($val)
{
	return htmlspecialchars(stripcslashes(trim($val)));
}
*/
function isOk($val)
{
	$res=false;
	if (isset($val) && !empty($val)) {
		htmlspecialchars(stripslashes(trim($val)));
		$res=true;
	}
	return $res;
}

function passValid($parms1,$parms2)
{
	$value=false;
	if ($parms1!=$parms2) {
		die("Votre mot de passe n'est pas valide");
		exit();
	}else{
		$value=true;
	}
	return $value;
}
function redirect($url)
{
	header("Location:$url");
	exit();
}

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	extract($_POST);
	if (isOK($username) && isOk($firstname) && isOk($email) && isOk($date) && isOk($sexe) && isOk($password) && isOk($confirm)) {
		passValid($password,$confirm);
		$br=PHP_EOL;
		$contents=$br.$username.$br.$firstname.$br.$email.$br.$date.$br.$sexe.$br.$password.$br.$confirm.$br;
		$file="information.txt";
		if (!file_exists($file)) {
			file_put_contents($file, $contents);
			redirect("succes.php");
		}else{
			file_put_contents($file, $contents,FILE_APPEND);
			redirect("update.php");
		}
		redirect("index.php");
		exit();
	}
}else{
	echo("ERROR");
}
?>
