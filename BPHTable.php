<?php header("Location: http://www.gearedwebdesigns.com/BPHCalcEnter.php");?>  
<!doctype html>

<html>
 <head>

 </head>
<body>

<?php
             

// Define MySQL connection and credentials
$pdo_dsn='mysql:dbname=gearedwe_ODFLtest;host=localhost';
$pdo_user='gearedwe_admin';     
$pdo_password='dbtest';  
                
// Check that user sent some data to begin with. 
if(!empty($_POST) && !empty($_REQUEST['yourfield'])&& isset($_REQUEST['hoursWorked']))   {          
//if (isset($_REQUEST['yourfield']) && isset($_REQUEST['hoursWorked'])) {
 // Establish connection to database
    $conn = new PDO($pdo_dsn, $pdo_user, $pdo_password);
    $con=mysqli_connect("localhost","gearedwe_admin","dbtest","gearedwe_ODFLtest");
     
    // Throw exceptions in case of error.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

     mysqli_close($con);

} 
    
 
    catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage() . " file: " . $e->getFile() . " line: " . $e->getLine();
    exit;
}
}

    
    else {
   die('User did not send any data to be saved!');

    }

/*

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
   // $qry=$conn->prepare("INSERT INTO `gearedwe_ODFLtest`.`yourtable` ( `billsEntered`, `dateEntered`, `hoursWorked`, `BPH`) VALUES ( :yourvalue, CURRENT_DATE(), $hoursWorked, `billsEntered`/$hoursWorked);");
  
  
   
    // Execute the prepared statement using user supplied data.
    //$qry->execute(Array(":yourvalue" => $yourfield));
    
   

    mysqli_close($con);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage() . " file: " . $e->getFile() . " line: " . $e->getLine();
    exit;
}
    }
    */

?>
          


   
</body>
</html>