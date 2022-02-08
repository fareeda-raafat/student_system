<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student system</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<!-- start php and connection to db & query -->
<?php

//  connection with db and get the input fields 

    $id = $name = $adress ='';
  if($_SERVER["REQUEST_METHOD"] == "POST" ){
      include 'config.php';

      $id = $_POST["id"];
      $name = $_POST["name"];
      $adress = $_POST["adress"];
      
  }

//   insert query

  if(isset($_POST["add"])){

    $stmt = "INSERT INTO student ( id,name,adress ) VALUES ( ?, ?, ?) ";
    $stmt = $conn->prepare($stmt);
    $stmt->execute(array( $id , $name , $adress) ) ;

  }

//   delete query

  if(isset($_POST["delete"])){
    $stmt = " DELETE FROM student WHERE name = '$name' ";
    $stmt = $conn->prepare($stmt);
    $stmt->execute();

  }

?>

<!-- close php  -->

  <div class="admin">
    <aside>
        
            <img src="https://www.pngitem.com/pimgs/m/81-813934_transparent-student-uniform-clipart-school-student-vector-png.png"   alt="img of admin">
            <h3>info of student</h3>

         <form method="POST">
            <label for="id">ID : </label><br>
            <input type="text" name="id"><br>

            <label for="name">NAME : </label><br>
            <input type="text" name="name"><br>

            <label for="adress">ADRESS : </label><br>
            <input type="text" name="adress"><br>

            <button name="add"> ADD </button>
            <button name="delete"> DELETE </button>
          </form> 

    </aside>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>ADREESS</th>
            </tr>

       <?php

             include 'config.php';
            //   view by select query
           
           $stmt = " SELECT * FROM student ";
           $stmt = $conn->query($stmt);
           $students = $stmt->fetchAll();

           if($students){
              foreach($students as $student){
     ?>
        <!-- view data of student in table  -->
          <tr>
              <td> <?= $student['id'] ?> </td>
              <td> <?= $student['name'] ?> </td>
              <td> <?= $student['adress'] ?> </td>
          </tr>
        <!-- end of table rows -->
          <?php
      }
  }

?>
        </table>
    </main>
    <div class="clr"></div>
  </div>
  
</body>
</html>
