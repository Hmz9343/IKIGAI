<?php
	
	$servername = "localhost";
	$admin = "id9890949_hamza";
	$password = "hammie@97";
	$dbname = "id9890949_admin";
	$connect=mysqli_connect($servername, $admin, $password, $dbname);
	if(!$connect)
	{
        die("Connection failed: " . mysqli_connect_error());
	}   
	
	$username=$_POST['person'];
	$stack=$_POST['stack'];
	$value=$_POST['val'];

	//$username='hamza';
	//$stack='Love';
	//$value='helloelloe';

	$sql="SELECT * FROM `".$stack."` WHERE `username`='".$username."' AND `".$stack."`='".$value."'";
    $result=mysqli_query($connect,$sql);
    
    if(mysqli_num_rows($result)==0){
    $sql1="INSERT INTO `".$stack."` (username,".$stack.") VALUES ('".$username."','".$value."')";
    $result1=mysqli_query($connect,$sql1);
    	if($result1){
    	    echo $value." succesfully inserted in ".$username." in ".$stack;;
    	}else{
    		echo $value." not inserted in ".$username." in ".$stack;
    	}

    }else{
    	echo $value." already present in ".$username." in ".$stack;;	
    }
?>