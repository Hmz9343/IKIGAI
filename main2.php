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


if(isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])){
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $sql = "SELECT * FROM `Users` WHERE `username`='".$user."' AND `password`='".$pass."'";
    $result=mysqli_query($connect, $sql);
    if($result){
        $count = mysqli_num_rows($result);
        //echo $count;
        if($count == 0) {
            $sql1="INSERT INTO `Users` (username,password) VALUES ('".$user."','".$pass."')";
            //echo $sql1;
            $result1=mysqli_query($connect,$sql1);
            $_SESSION['username']=$user;
            $_SESSION['password']=$pass;
            echo '<script>alert("Welcome '.$user.' to IKigai.")</script>' ;
            
            }else {
            
            $_SESSION['username']=$user;
            $_SESSION['password']=$pass;
            echo '<script>alert("Welcome '.$user.' to IKigai.")</script>' ;
            
            }
            $f=1;
            $disabled="";
    }
    else{
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
}else if(!isset($_GET['login']) && !empty($_GET['username']) && empty($_GET['password'])){

    $user=$_GET['username'];
    $sql = "SELECT * FROM `Users` WHERE `username`='".$user."'";
    $result=mysqli_query($connect, $sql);
    if($result){
        $_SESSION['username']=$user;
        echo "This is profile of ".$user ;
        $f=0;
        $disabled="disabled";
    }
    else{
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
}

?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>IKIGAI</title>
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
</head>

<body>
    <header>
    <nav  style="margin: 10px">
    <div class="nav-wrapper teal lighten-2 ">
      <a href="#" class="brand-logo center">IKIGAI</a>
    <div style="text-align: right;margin-right: 10px">
        <button class="waves-effect teal darken-4 btn-small" id="predict">Predict</button>

        <?php if($f==1){ ?>
        <button class="waves-effect teal darken-4 btn-small" id="save">Save</button>
        <a class="waves-effect teal darken-4 btn-small" href="logout.php" id="logout">Logout</a>
        <?php }else{?>
        <a class="waves-effect teal darken-4 btn-small" href="logout.php" id="home">Home</a>
        <?php }?>
    </div>
    </div>
    
  </nav>
    </header>
    <section id="connected" >
    <div class="row" >
        <div class="col s3" style="background-color: #a7ffeb ;padding: 10px;border:1px solid white;
">
            
            <div class="row">
                <div class="col s9">
    <input placeholder="What you Love..." id="myInput1" type="text" class="input" <?php echo $disabled; ?> >
                </div>
                
                <div class="col s3">
                <button class="waves-effect cyan darken-4 btn-small" id="addBtn1">Add</button>
                </div>

            </div>
            
            <ul id="myUL1" class="connected list">
                <?php
                    if(isset($_SESSION['username'])){

                        $user=$_SESSION['username'];
                        $sql="SELECT * FROM `love` WHERE `username`='".$user."'";
                        $result=mysqli_query($connect,$sql);
                        if(mysqli_num_rows($result)>0){
                            while ($row=mysqli_fetch_assoc($result)) {
                                echo "<li>".$row['love']."</li>";


                            }
                        }   
                    }

                ?>
            </ul>
        </div>
    <div class="col s3" style="background-color: #a7ffeb ; padding: 10px;border:1px solid white;">
        
        <div class="row">
                <div class="col s9">
                <input placeholder="What you are Good at..." id="myInput2" type="text" class="input"  <?php echo $disabled; ?> >
                </div>
                
                <div class="col s3">
                <button class="waves-effect cyan darken-4 btn-small" id="addBtn2">Add</button>
                </div>

        </div>

        <ul id="myUL2" class="connected list no2">
            <?php
                    if(isset($_SESSION['username'])){

                        $user=$_SESSION['username'];
                        $sql = "SELECT * FROM `good` WHERE `username`='".$user."'";
                        $result=mysqli_query($connect,$sql);
                        if(mysqli_num_rows($result)>0){
                            while ($row=mysqli_fetch_assoc($result)) {
                                echo "<li>".$row['good']."</li>";
                            }
                        }   
                    }
                ?>
        </ul>
    </div>
    <div class="col s3" style="background-color: #a7ffeb ;padding: 10px;border:1px solid white;">
        
        <div class="row">
                
                <div class="col s9">
    <input placeholder="What you can be Paid for.." id="myInput3" type="text" class="input" <?php echo $disabled; ?> >
                </div>
                
                <div class="col s3">
                <button class="waves-effect cyan darken-4 btn-small" id="addBtn3">Add</button>
                </div>
        </div>

        <ul id="myUL3" class="connected list no3">
            <?php
                    if(isset($_SESSION['username'])){

                        $user=$_SESSION['username'];
                        $sql = "SELECT * FROM `paid` WHERE `username`='".$user."'";
                        $result=mysqli_query($connect,$sql);
                        if(mysqli_num_rows($result)>0){
                            while ($row=mysqli_fetch_assoc($result)) {
                                echo "<li>".$row['paid']."</li>";
                            }
                        }   
                    }
                ?>
        </ul>
    </div>
    <div class="col s3" style="background-color: #a7ffeb ;padding: 10px;border:1px solid white;">
        <div class="row">
                <div class="col s9">
    <input placeholder="What the World needs..." id="myInput4" type="text" class="input"  <?php echo $disabled; ?> >
                </div>
                
                <div class="col s3">
                <button class="waves-effect cyan darken-4 btn-small" id="addBtn4">Add</button>
                </div>

            </div>
        <ul id="myUL4" class="connected list no4">
            <?php
                    if(isset($_SESSION['username'])){

                        $user=$_SESSION['username'];
                        $sql = "SELECT * FROM `world` WHERE `username`='".$user."'";
                        $result=mysqli_query($connect,$sql);
                        if(mysqli_num_rows($result)>0){
                            while ($row=mysqli_fetch_assoc($result)) {
                                echo "<li>".$row['world']."</li>";
                            }
                        }   
                    }
                ?>
        </ul>
    </div>
</div>
    </section>
    <section>
      <div class="row">
        <div class="input-field col s3" style="background-color: #a7ffeb;border: 1px solid white;">
            <h6 style="text-align: center; border-bottom:2px solid black;padding: 10px;">Passion</h6>
          <ul id="passion"></ul>
        </div>
        <div class="input-field col s3" style="background-color: #a7ffeb;border: 1px solid white;">
          <h6 style="text-align: center; border-bottom:2px solid black;padding: 10px;">Profession</h6>
          <ul id="profession" ></ul>
        </div>
        <div class="input-field col s3" style="background-color: #a7ffeb;border: 1px solid white;">
          <h6 style="text-align: center; border-bottom:2px solid black;padding: 10px;">Vocation</h6>
          <ul  id="vocation" ></ul>
        </div>
        <div class="input-field col s3" style="background-color: #a7ffeb;border: 1px solid white;">
          <h6 style="text-align: center; border-bottom:2px solid black;padding: 10px;">Mission</h6>
          <ul id="mission"></ul>
        </div>
      </div>
    </section>

    <section>
      <div class="row">
        <div class="col s4"></div>
        <div class="col s4" style="background-color: #a7ffeb;border: 1px solid white;">
          <h6  style="text-align: center;border-bottom:2px solid black;padding: 10px;">Purpose</h6>
          <ul id="purpose"></ul>
        </div>
        <div class="col s4"></div>
      </div>
    </section>

    <section>
        <div class="col s12">
            
       </div>
        </section>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="jquery.sortable.js"></script>
    <script>
        $(function() {
            M.updateTextFields();
            
            $("#predict").click(function(){
            var ul1 = document.getElementById('myUL1');
            var li1=ul1.getElementsByTagName('li');
            var array1=new Array();
            for (var i = 0; i < li1.length; i++) {
                array1.push(li1[i].innerText);
            }


            var ul2 = document.getElementById('myUL2');
            var li2=ul2.getElementsByTagName('li');
            var array2=new Array();
            for (var i = 0; i < li2.length; i++) {
                array2.push(li2[i].innerText);
            }


            var ul3 = document.getElementById('myUL3');
            var li3=ul3.getElementsByTagName('li');
            var array3=new Array();
            for (var i = 0; i < li3.length; i++) {
                array3.push(li3[i].innerText);
            }


            var ul4 = document.getElementById('myUL4');
            var li4=ul4.getElementsByTagName('li');
            var array4=new Array();
            for (var i = 0; i < li4.length; i++) {
                array4.push(li4[i].innerText);
            }
            

            //alert(array1);
            //alert(array2);
            //alert(array3);
            //alert(array4);
            
            function check_common(list1, list2)
            {
                list3 = []
                for (var i=0; i<list1.length; i++)
                {
                    for (var j=0; j<list2.length; j++)
                    {   
                        if (list1[i] === list2[j])
                        {
                        list3.push(list1[i]);               
                        }       
                    }
                }
            return list3
            }

            array5=check_common(array1,array2);
            array6=check_common(array2,array3);
            array7=check_common(array3,array4);
            array8=check_common(array4,array1);

            var data = [array5, array6, array7, array8];
            var result = data.reduce((a, b) => a.filter(c => b.includes(c)));
            

            $('#passion').empty();

            var list1=document.getElementById('passion');

            for (var i = 0; i < array5.length; i++) {
                var item=document.createElement('li');
                item.appendChild(document.createTextNode(array5[i]));
                list1.appendChild(item);
                $('#passion').addClass("connected");
                //$("li").addClass("card-panel teal lighten-2");
            }

            $('#profession').empty();

            var list2=document.getElementById('profession');
            for (var i = 0; i < array6.length; i++) {
                var item=document.createElement('li');
                item.appendChild(document.createTextNode(array6[i]));
                list2.appendChild(item);
                $('#profession').addClass("connected");
                //$("li").addClass("card-panel teal lighten-2");
            }

            $('#vocation').empty();
            
            var list3=document.getElementById('vocation');
            for (var i = 0; i < array7.length; i++) {
                var item=document.createElement('li');
                item.appendChild(document.createTextNode(array7[i]));
                list3.appendChild(item);
                $('#vocation').addClass("connected");
                //$("li").addClass("card-panel teal lighten-2");

            }


            $('#mission').empty();

            var list4=document.getElementById('mission');
            for (var i = 0; i < array8.length; i++) {
                var item=document.createElement('li');
                item.appendChild(document.createTextNode(array8[i]));
                list4.appendChild(item);
                $('#mission').addClass("connected");
                //$("li").addClass("card-panel teal lighten-2");
            }

            $('#purpose').empty();

            var list5=document.getElementById('purpose');
            for (var i = 0; i < result.length; i++) {
                var item=document.createElement('li');
                item.appendChild(document.createTextNode(result[i]));
                list5.appendChild(item);
                $('#purpose').addClass("connected");
                //$("li").addClass("card-panel teal lighten-2");
            }


            //alert(array5);
            
            });

            $("#addBtn1").click(function(){
                var li = document.createElement("li");
                var inputValue = document.getElementById("myInput1").value;
                var t = document.createTextNode(inputValue);
                li.appendChild(t);
                if (inputValue === '') {
                    alert("You must write something!");
                } else {
                    document.getElementById("myUL1").appendChild(li);
                }
                document.getElementById("myInput1").value = "";
                $('.connected').sortable({
                connectWith: '.connected'
                });

                //$("li").addClass("card-panel teal lighten-2");
            });

            $("#addBtn2").click(function(){
                var li = document.createElement("li");
                var inputValue = document.getElementById("myInput2").value;
                var t = document.createTextNode(inputValue);
                li.appendChild(t);
                if (inputValue === '') {
                    alert("You must write something!");
                } else {
                    document.getElementById("myUL2").appendChild(li);
                }
                document.getElementById("myInput2").value = "";

                $('.connected').sortable({
                connectWith: '.connected'
                });
                //$("li").addClass("card-panel teal lighten-2");
            });

            $("#addBtn3").click(function(){
                var li = document.createElement("li");
                var inputValue = document.getElementById("myInput3").value;
                var t = document.createTextNode(inputValue);
                li.appendChild(t);
                if (inputValue === '') {
                    alert("You must write something!");
                } else {
                    document.getElementById("myUL3").appendChild(li);
                }
                document.getElementById("myInput3").value = "";

                $('.connected').sortable({
                connectWith: '.connected'
                });
                //$("li").addClass("card-panel teal lighten-2");
            });

            $("#addBtn4").click(function(){
                var li = document.createElement("li");
                var inputValue = document.getElementById("myInput4").value;
                var t = document.createTextNode(inputValue);
                li.appendChild(t);
                if (inputValue === '') {
                    alert("You must write something!");
                } else {
                    document.getElementById("myUL4").appendChild(li);
                }
                document.getElementById("myInput4").value = "";

                $('.connected').sortable({
                connectWith: '.connected'
                });
                //$("li").addClass("card-panel teal lighten-2");
            });


          $("#save").click(function(){
            
            var username= <?php echo json_encode($_SESSION['username']); ?>;
            var ul1 = document.getElementById('myUL1');
            var li1=ul1.getElementsByTagName('li');
            for (var i = 0; i < li1.length; i++) {
                var value=li1[i].innerText;
                
                var postForm = { 
                    'person': username,
                    'stack': 'love',
                    'val':value 
                };
                
                $.post("update.php",postForm,function(data,status){
                    alert("data: "+data);
                });
               
                        
                }


            var ul2 = document.getElementById('myUL2');
            var li2=ul2.getElementsByTagName('li');
            for (var i = 0; i < li2.length; i++) {
                var value=li2[i].innerText;
                
                var postForm = { 
                    'person': username,
                    'stack': 'good',
                    'val':value 
                };
                
                $.post("update.php",postForm,function(data,status){
                    alert("data: "+data);
                }); 
                        
            }

            var ul3 = document.getElementById('myUL3');
            var li3=ul3.getElementsByTagName('li');
            for (var i = 0; i < li3.length; i++) {
                var value=li3[i].innerText;
                
                var postForm = { 
                    'person': username,
                    'stack': 'paid',
                    'val':value 
                };
                
                $.post("update.php",postForm,function(data,status){
                    alert("data: "+data);
                });
                        
            }

            var ul4 = document.getElementById('myUL4');
            var li4=ul4.getElementsByTagName('li');
            for (var i = 0; i < li4.length; i++) {
                var value=li4[i].innerText;
                
                var postForm = { 
                    'person': username,
                    'stack': 'world',
                    'val':value 
                };
                
                $.post("update.php",postForm,function(data,status){
                    alert("data: "+data);
                });
                        
            }


         
          });

       



         


                $("li").addClass("card-panel teal lighten-2");
                $('.sortable').sortable();
                $('.handles').sortable({
                 handle: 'span'
                });
                $('.connected').sortable({
                 connectWith: '.connected'
                });
                $('.exclude').sortable({
                 items: ':not(.disabled)'
                });
        });
    </script>
</body>
</html>



