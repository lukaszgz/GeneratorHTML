<?php
session_start();

if(isset($_SESSION['signedIn']) && ($_SESSION['signedIn'] == true))
{
    header("location: edycja.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Generator Szablonów - Zaloguj się</title>
        <link rel="stylesheet" type="text/css" href="logowanie.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body class="modal-open">
    	<!-- <video id="bg" autoplay="autoplay" loop="loop">
            <source src="http://www.giez.pl/background.mp4" type="video/mp4" />
        </video> -->

        <div id="header">
            <h1>GENERATOR SZABLONÓW AUKCJI</h1>
            <h3>Aby kontynuować - <a href="" data-toggle="modal" data-target="#loginModal">zaloguj</a> się lub <a href="" data-toggle="modal" data-target="#rejestrationModal">zarejestruj</a></h3>
        </div>


		<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
		  Launch demo modal 
		</button> -->

		<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="loginModalTitle">Logowanie</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
			        <form method="post" action="login.php">
						<div class="form-group">
						    <label for="exampleInputEmail1">Wprowadź adres email</label>
							<p><small>DEMO: "marek@nowak.pl"</small></p>
						    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Adres email" name="email" required>
					  	</div>
					  	<div class="form-group">
					    	<label for="exampleInputPassword1">Wprowadź hasło</label>
							<p><small>DEMO: "haslo123"</small></p>
					    	<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Hasło" name="password" required>
						</div>
						
							<?php
				            if(isset($_SESSION['userNotExist']))
				            {
				            	echo '<script>$("#loginModal").modal("show");</script>';
				                echo '<div class="alert alert-warning" role="alert">
									 	 Wprowadzone dane są niepoprawne...
									  </div>';
				                unset($_SESSION['userNotExist']);
				            }
				       		if ( isset($_SESSION['rejestracjaOK']))
				            {
				            	echo '<script>$("#loginModal").modal("show");</script>';
				                echo  $_SESSION['rejestracjaOK'];
				                unset( $_SESSION['rejestracjaOK']);
				            }

				            ?>

		                <!-- <input type="text" name="login" placeholder = "LOGIN" />
		                <input type="password" name="password" placeholder = "HASŁO" />
		                <input type="submit" value="ZALOGUJ" name="loginBTN" /> -->
		             	<div class="modal-footer">
				      		<button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#rejestrationModal">Zarejestruj się</button>
				        	<button type="submit" class="btn btn-success" name="loginBTN">Zaloguj</button> 
				      	</div>       
				    </form> 
			  </div>
		      
		    </div>
		  </div>
		</div>


		
		<div class="modal fade" id="rejestrationModal" tabindex="-1" role="dialog" aria-labelledby="rejestrationModalTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="rejestrationModalTitle">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form method="post" action="rej.php">
					<div class="form-group">
					    <label for="exampleInputEmail1">Wprowadź swoje imie</label>
					    <input type="text" class="form-control" id="inputName1" aria-describedby="emailHelp" placeholder="Imie" name="name">
				  	</div>
				  	<div class="form-group">
					    <label for="exampleInputEmail1">Wprowadź swoje nazwisko</label>
					    <input type="text" class="form-control" id="inputSurame1" aria-describedby="emailHelp" placeholder="Nazwisko" name="surname">
				  	</div>
				  	<div class="form-group">
					    <label for="exampleInputEmail1">Wprowadź adres email</label>
					    <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="Adres email" name="email" required>
				  	</div>
				  	<div class="form-group">
				    	<label for="exampleInputPassword1">Wprowadź hasło</label>
				    	<input type="password" class="form-control" id="inputPassword1" placeholder="Hało" name="password" required>
					</div>
					<div class="form-group">
				    	<label for="exampleInputPassword1">Powtórz hasło</label>
				    	<input type="password" class="form-control" id="inputPassword2" placeholder="Hało" name="password2" required>
					</div>
		      	 
		      </div>

				<?php

	            if(isset($_SESSION['blad']))
	            {
	            	echo '<script>$("#rejestrationModal").modal("show");</script>';
	                echo $_SESSION["blad"];
	                unset($_SESSION['blad']);
	            }
           
				?>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Zaloguj się</button>
		        <button type="submit" class="btn btn-success" name="registerBTN">Rejestruj</button>
		      </div>
		      </form> 
		    </div>
		  </div>
		</div>


                <!-- <input type="text" name="name" placeholder = "IMIE" required="" />
                <input type="text" name="surname" placeholder = "NAZWISKO" />
                <input type="text" name="login" placeholder = "LOGIN" required=""/>
                <input type="text" name="email" placeholder = "E-MAIL" required=""/>
                <input type="password" name="password" placeholder = "HASŁO" required=""/>
                <input type="password" name="password2" placeholder = "POWTÓRZ HASŁO" required=""/>
                <input type="submit" value="REJESTRUJ" name="registerBTN" required=""/> -->
            
            


        
       <!--  <div id="loginBox" >
            <form method="post" action="login.php">
                <input type="text" name="login" placeholder = "LOGIN" />
                <input type="password" name="password" placeholder = "HASŁO" />
                <input type="submit" value="ZALOGUJ" name="loginBTN" />
            </form>  
            <?php
            //if(isset($_SESSION['userNotExist']))
            {
                //echo '<p class = "error">Uzytkownik nie istnieje</p>';
               // unset($_SESSION['userNotExist']);
            }
            //elseif ( isset($_SESSION['rejestracjaOK']))
            {
                //echo  $_SESSION['rejestracjaOK'];
                //unset( $_SESSION['rejestracjaOK']);
            }

            ?>
        </div>             -->
        
        
    </body>
</html>