<?php
                session_start();
               
                require_once 'connect.php';

                $connect = @new mysqli($host, $db_user, $db_password, $db_name);

                if ($connect->connect_errno != 0) 
                {
                    echo "error: " . $connect->connect_errno;
                } 
                else 
                {
                    $imie = $_POST['name'];
                    $nazwisko = $_POST['surname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $password2 = $_POST['password2'];
                    
                    if($password == $password2)
                    {
                        //$sql = "INSERT INTO `$db_name`.`users` (`id`, `name`, `surname`, `password`, `email`, 'date_add') VALUES (NULL, '$imie', '$nazwisko', '$password', $email , NULL);";
                        $sql = "INSERT INTO `users` (`id`, `name`, `surname`, `password`, `email`, `date_add`) VALUES (NULL, '$imie', '$nazwisko', '$password', '$email', CURRENT_TIMESTAMP);";

                        if($connect->query($sql))
                        {
                            header("location: index.php");
                            $_SESSION['rejestracjaOK'] = '<div class="success">Rejestracja przebiegła pomyślnie! Możesz się zalogować...</div>';
                        }
                            
                        else
                        {
                            $_SESSION['blad'] = '<div class="error">Wystąpił błąd przy próbie rejestracji! Spróbuj jeszcze raz...</div>';
                            header("location: index.php");
                        }         
                    
                    }
                    else
                    {
                        $_SESSION['blad'] = '<div class="error">Hasła nie są identyczne!</div>';
                        header("location: index.php");
                    }

                    
                    
                 
                 $connect->close();
                
                }   
            ?>