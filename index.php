<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

    $servername = "localhost";
    $admin = "id9890949_hamza";
    $password = "hammie@97";
    $dbname = "id9890949_admin";
    $connect=mysqli_connect($servername, $admin, $password, $dbname);
    if(!$connect)
    {
            die("Connection failed: " . mysqli_connect_error());
    }   

?>

<html lang = "en">
   <head>
      <title> IKIGAI Login Page </title>
      
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            
   </head>
	
   <body>
      
      <h3 style="text-align: center;margin-top: 70px">Login</h3> 
      <div class = "container"  style="margin-top: 50px;">
      
         <form class = "form-signin" role = "form" 
            action = "main2.php" method = "post">
            
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "Enter your username"></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "Password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>

         <div style="margin-top:  70px;">
            <h5 >List of Other Users:</h5>
         </div>
			<ul>
         <?php
            $sql = "SELECT * FROM `Users`";
            $result=mysqli_query($connect, $sql);
            if($result){
               $count = mysqli_num_rows($result);

               while($row=mysqli_fetch_assoc($result)){
                  echo "<li><a href='main2.php?username=".$row['username']."'>".$row['username']."</a></li>";
                  }
               }   
         ?>         
         </ul>
      </div> 
      
   </body>
</html>