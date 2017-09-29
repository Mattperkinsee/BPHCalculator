<!doctype html>
<html>
 <head>
  <title>Delete</title>
 </head>
<body>
<?php

// Check that user sent some data to begin with. 

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
   // $qry=$conn->prepare('INSERT INTO yourtable (yourcolumn) VALUES (:yourvalue)');
      $sql = "DELETE FROM yourtable";
    if(mysqli_query($con, $sql)){
        echo "Records were deleted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
  
    // Execute the prepared statement using user supplied data.
      
    
    //Display Table
   $result = mysqli_query($con,"SELECT * FROM yourtable");

    echo "<table border='1'>
    <tr>
    <th>Total I Billed</th>
    <th>Date</th>
     <th>Test</th>
    </tr>";

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['yourcolumn'] . "</td>";
    echo "<td>" . $row['dateEntered'] . "</td>";
         echo "<td>" . $row['test'] . "</td>";
    
    echo "</tr>";
    }
    echo "</table>";

    mysqli_close($con);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage() . " file: " . $e->getFile() . " line: " . $e->getLine();
    exit;
}
  

   header( 'Location: http://www.gearedwebdesigns.com/testdb.php' ) ;


?>
<form action='testDB.php' method="post">

 <!-- Please note that the quotes around next block are important
      to avoid XSS issues with poorly escaped user input. For more details:
      https://stackoverflow.com/a/2894530
  -->
 <input type="text" name="yourfield" value="<?php print $yourfield; ?>">
 <input type="submit" name="youraction" value="Add">
 <br>
 
 
 

</form>
 <form action='delete.php' method="post">
 <input type="hidden" name="name" value="">
<input type="submit" name="submit" value="Delete Table">
</form>  

</body>
</html>