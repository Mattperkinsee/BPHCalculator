
<html>

<head>
   <meta http-equiv="refresh" content="30">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
     <meta name="google-signin-scope" content="profile email">
      <script src="/js/jquery.min.js"></script>
      <script type="text/javascript" src="/js/googleJS.js" ></script>
    <script type="text/javascript" src="/js/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css?ver2.1">
    <script src="https://apis.google.com/js/platform.js" async defer></script>  
   
    <meta name="google-signin-client_id" content="361221640104-i8gqro3o49s7br12jgd96sbhas9mcrao.apps.googleusercontent.com">
</head>
           
            <div class="container">
            <div class="row text-center">
       <div class="col-xs-4"></div>
            <div class="col-xs-4">
             <h2 id="gName"></h2> 
             <img src="" id="gPic" name="gPic">
                </div>
                <div class="col-xs-4"></div>
                </div>
                <br>
    </div>
             
             
<div class="container">
       <div class="col-sm-4">
             </div>
             <div class="col-xs-12 col-sm-4">
           
        <div class="row text-center">
<?php

// Define MySQL connection and credentials
$pdo_dsn='mysql:dbname=gearedwe_ODFLtest;host=localhost';
$pdo_user='gearedwe_admin';     
$pdo_password='dbtesters99'; 
// Establish connection to database
    $conn = new PDO($pdo_dsn, $pdo_user, $pdo_password);
    $con=mysqli_connect("localhost","gearedwe_admin","dbtesters99","gearedwe_ODFLtest");
    
 
        //Display Table
   $result = mysqli_query($con,"SELECT * FROM yourtable");

    echo "<table border='1'>
    <tr>
    <th>Date</th>
    <th>Total Billed</th>
    
    <th>Hours Worked</th>
     <th>BPH</th>
    </tr>";

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
         echo "<td>" . $row['dateEntered'] . "</td>";
    echo "<td>" . $row['billsEntered'] . "</td>";
   
         echo "<td>" . $row['hoursWorked'] . "</td>";
          echo "<td>" . $row['BPH'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table>";

    
    mysqli_close($con);
    ?>
            </div>
    </div>
    <div class="col-sm-4">
             </div>
    </div>
<body>

    <div class="container">
        <form method="post" action="BPHTable.php">
        <div class="row text-center">
           
            <div class="col-xs-4">
             </div>
              
              
                <div class="col-xs-4">
                    <div class="form-group">
                      <br>
                       <label for="formGroupExampleInput">Bills Done Last Night</label>
                        
                        <input type="number" step="any" class="form-control"  id="formGroupExampleInput" placeholder="..." name="yourfield">    
                    </div>
                 </div>
                     <div class="col-xs-4">
             </div>
                   </div>
            
        
       
         <div class="row text-center">
             <div class="col-xs-4">
             </div>
            <div class="col-xs-4">
               
                    <div class="form-group">
                      <br>
                       <label for="formGroupExampleInput">Hours Worked</label>
                        
                        <input type="number" step="any" class="form-control"  placeholder="..." name="hoursWorked">
                        <br><br>
                        <input type="submit"  class="btn btn-success" name="youraction" value="Submit">
                    </div>
             </div>
                    <div class="col-xs-4">
             </div>               
        </div>
        </form>
                         
               
  <div class="row text-center">
            <div class="col-xs-12">           
             <div class="form-group">
             <form action='delete.php' method="post">
             <input type="hidden" name="name" value="">
            <input type="submit" class="btn btn-danger" name="delete" value="Delete Table">
            </form>   
                </div>
      </div>  
    </div>
    
    <div class="row text-center">
            <div class="col-xs-12">   
      <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>    
      
      <script>
   
          
          
          
    </script>
      <br>
       <a href="#" onclick="signOut();">Sign out</a>
       
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
        location.reload();
    });
  }
</script>
        </div>
    </div>
     
                  
</div>


</body>
<footer>


</footer>

</html>