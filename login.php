<?php
session_start();


if(!isset($_POST['email']) && !isset($_POST['password']))
{
    header("location: index.php");
    exit();
}


require_once 'connect.php';
require_once 'config.php';

mysqli_report(MYSQLI_REPORT_STRICT);

try
{
	$connect = new mysqli($host, $db_user, $db_password, $db_name);
	if ($connect->connect_errno != 0)
	{
		throw new Exception(mysqli_connct_errno());
	}
	else 
	{
	    $email = $_POST['email'];
	    $password = $_POST['password'];
	    
	    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	    
	    if($answer = $connect->query($sql))
	    {
	        $countUsers = $answer->num_rows;
	        if($countUsers>0)
	        {
	            $row = $answer->fetch_assoc();
	            $_SESSION['folder'] = $row['id'];
	            $_SESSION['user'] = $row['email'];
	            $_SESSION['signedIn'] = true;
	            
	            header("location: edycja.php");
	            //czyszczenie pobranych danych pamieci podrecznej serwera
	            $answer->free();
	        }
	        else
	        {
	            $_SESSION['userNotExist'] = true;
	            header("location: index.php");
	        }
	    } 
		else
		{
			echo "Błąd wykoania zapytania";
		}
	    $connect->close();
	}
}
catch (Exception $e)
{
	echo '<h1>Nie można połączyć z bazą danych!</h1>';
	if(SHOW_ERRORS)
		echo 'Błąd: '. $e .'<br>'. "\n";
}

?>