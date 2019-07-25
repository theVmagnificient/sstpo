<?php
if (isset($_GET['mode']) && isset($_GET['email']) && isset($_GET['password'])){
	$email = str_replace(array("'",'"','<','>'),'',$_GET['email']);
	$pass = str_replace(array("'",'"','<','>'),'',$_GET['password']);
	$dbconn = pg_connect(include($_SERVER['DOCUMENT_ROOT'].'/config/db.php'));
	if ($_GET['mode'] == 0) {
        $query = "SELECT pass,token FROM users WHERE email = '$email';";
        $result = pg_query($query);
        $line = pg_fetch_array($result, null, PGSQL_ASSOC);
        if ($line['pass'] == $pass) {			
            echo json_encode($line['token']);
        } else {
            echo json_encode(false);
        }
	} elseif ($_GET['mode'] == 1) {
		if (isset($_GET['firstname']) && isset($_GET['surname'])) {
			$firstname = str_replace(array("'",'"','<','>'),'',$_GET['firstname']);
			$surname = str_replace(array("'",'"','<','>'),'',$_GET['surname']);
			$query = "SELECT id FROM users WHERE email = '$email';";
			$result = pg_query($query);
			$line = pg_fetch_array($result, null, PGSQL_ASSOC);
			if (!$line) {
				$token = hash('sha256',$email.$pass);
				$query = "INSERT INTO users (email,pass,token,firstname,surname) VALUES ('$email','$pass','$token','$firstname','$surname')";
				$result = pg_query($query);
				echo json_encode($token);
			} else {
				echo json_encode(false);
			}
		}
	}
} else {
	echo json_encode(false);
}
?>
