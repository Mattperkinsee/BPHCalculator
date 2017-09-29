<!doctype html>
<html>
 <head>
  <title>Process and store</title>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

 </head>
<body>
<div class="container">
        <div class="row text-center">
            <div class="table col-xs-12">
<?php

// Check that user sent some data to begin with. 
if (isset($_REQUEST['yourfield']) && isset($_REQUEST['hoursWorked'])) {

    /* Sanitize input. Trust *nothing* sent by the client.
     * When possible use whitelisting, only allow characters that you know
     * are needed. If username must contain only alphanumeric characters,
     * without puntation, then you should not accept anything else.
     * For more details, see: https://stackoverflow.com/a/10094315
     */
    $yourfield=preg_replace('/[^a-zA-Z0-9\ ]/','',$_REQUEST['yourfield']);
    $hoursWorked=$_REQUEST['hoursWorked'];

    /* Escape your input: use htmlspecialchars to avoid most obvious XSS attacks.
     * Note: Your application may still be vulnerable to XSS if you use $yourfield
     *       in an attribute without proper quoting.
     * For more details, see: https://stackoverflow.com/a/130323
     */
    $yourfield=htmlspecialchars($yourfield);
    $hoursWorked=htmlspecialchars($hoursWorked);


} else {
    die('User did not send any data to be saved!');
}


// Define MySQL connection and credentials
$pdo_dsn='mysql:dbname=gearedwe_ODFLtest;host=localhost';
$pdo_user='gearedwe_admin';     
$pdo_password='dbtest';  

try {
    // Establish connection to database
    $conn = new PDO($pdo_dsn, $pdo_user, $pdo_password);
    $con=mysqli_connect("localhost","gearedwe_admin","dbtest","gearedwe_ODFLtest");
     
    // Throw exceptions in case of error.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Use prepared statements to mitigate SQL injection attacks.
    // See https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php for more details
    //$qry=$conn->prepare('INSERT INTO yourtable (yourcolumn) VALUES (:yourvalue)');
    //  $qry=$conn->prepare("UPDATE yourtable SET BPH=billsEntered/hoursWorked");
    $qry=$conn->prepare("INSERT INTO `gearedwe_ODFLtest`.`yourtable` ( `billsEntered`, `dateEntered`, `hoursWorked`, `BPH`) VALUES ( :yourvalue, CURRENT_DATE(), $hoursWorked, `billsEntered`/$hoursWorked);");
  
  
   
    // Execute the prepared statement using user supplied data.
    $qry->execute(Array(":yourvalue" => $yourfield));
    
    //Display Table
   $result = mysqli_query($con,"SELECT * FROM yourtable");

    echo "<table border='1'>
    <tr>
    <th>Date</th>
    <th>Total I Billed</th>
    
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

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage() . " file: " . $e->getFile() . " line: " . $e->getLine();
    exit;
}
?>
            </div>
    </div>
    </div>


   <div class="container">
        <div class="row text-center">
            <div class="col-xs-12">
<form method="post">


  Bills Entered
 <input type="number" step="any" name="yourfield" >

    
        
 <br>
 Hours Worked
 <input type="number" step="any" name="hoursWorked" >
 
 <br>
  <input type="submit" class="btn btn-success" name="youraction" value="Submit">
 
 

</form>
            </div>
       </div>
    </div>
 <div class="container">
        <div class="row text-center">
            <div class="col-xs-12">
            <form action='testDB.html' method="post">

 <input type="submit" class="btn btn-primary" name="youraction" value="Back">
 <br>
 
 
 

</form>
 <form action='delete.php' method="post">
 <input type="hidden" name="name" value="">
<input type="submit" class="btn btn-danger" name="submit" value="Delete Table">
</form>  
            </div>
     </div>
    </div>
</body>
</html>