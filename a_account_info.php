<?php include 'dbconnect.php'?>
<?php
session_start();
$id=$_SESSION['id'];
$result1=mysqli_query($conn,"SELECT * FROM administrator WHERE aid='$id';");
$row1=mysqli_fetch_assoc($result1);
$bid=$row1['bid'];
$result2=mysqli_query($conn,"SELECT * FROM branch WHERE bid='$bid';");
$row2=mysqli_fetch_assoc($result2);
$cid=$row2['cid'];
$result3=mysqli_query($conn,"SELECT * FROM company WHERE cid='$cid';");
$row3=mysqli_fetch_assoc($result3);
$result4=mysqli_query($conn,"SELECT * FROM user WHERE id='$id';");
$row4=mysqli_fetch_assoc($result4);
if(isset($_POST['opswd']))
{
  $opswd=$_POST['opswd'];
  $npswd=$_POST['npswd'];
  $cpswd=$_POST['cpswd'];
  if($npswd!=$cpswd){
    echo "Password didn't match";
  }
  else{
    if($opswd==$row4["pswd"]){
      $result5=mysqli_query($conn,"UPDATE user SET pswd='$npswd' WHERE id='$id';");
    }else{
      echo "Incorrect Password";
    }
  }
}
if(isset($_POST['Logout'])){
  session_unset();
  session_destroy();
  header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payroll Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="administrator.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="administrator.js"></script>
</head>
<body>

<div class="jumbotron row m-0">
  <h1 class="container col-sm-12 text-center">ADMINISTRATOR</h1>
  <form class="container col-sm-10 text-right" action="" method="POST">
    <input type="submit" name="Logout" value="Logout"/>
  </form>
  <nav class="container">
    <ul class="nav nav-pills justify-content-center">
      <li class="nav-item">
        <a class="nav-link pl-4 pr-4" href="manage_employee.php">Manage Employee</a>
      </li>
      <li class="nav-item">
        <a class="nav-link pl-4 pr-4" href="manage_salary.php">Manage Salary</a>
      </li>
      <li class="nav-item">
        <a class="nav-link pl-4 pr-4" href="a_account_info.php">Account Information</a>
      </li>
    </ul>
  </nav>
</div>

<div class="container">
  <table class="table">
      <tr class="row m-0">
        <th class="col-sm-2">Administrator ID</th>
        <td class="col-sm-10"><?php echo $row1["aid"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Name</th>
        <td class="col-sm-10"><?php echo $row1["name"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Company Name</th>
        <td class="col-sm-10"><?php echo $row3["cname"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Department</th>
        <td class="col-sm-10"><?php echo $row1["department"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Designation</th>
        <td class="col-sm-10"><?php echo $row1["designation"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Password</th>
        <td class="col-sm-9"><?php echo $row4["pswd"];?></td>
        <td class="col-sm-1"><input id="edit" type="button" class="btn" value="Edit"/></td>
      </tr>
  </table>
</div>

<div id="overlayform" class="container-fluid" style="display:none;">
  <form id="form" action="" class="p-5 mt-3" method="POST">
    <div class="form-group">
      <label for="opswd">Old Password:</label>
      <input type="password" class="form-control" id="opswd" placeholder="Enter old password" name="opswd">
    </div>
    <div class="form-group">
      <label for="npswd">New Password:</label>
      <input type="password" class="form-control" id="npswd" placeholder="Enter new password" name="npswd">
    </div>
    <div class="form-group">
      <label for="cpswd">Confirm Password:</label>
      <input type="password" class="form-control" id="cpswd" placeholder="Confirm password" name="cpswd">
    </div>
    <div class="text-center">
      <input type="submit" class="btn btn-primary" value="Done">
      <button type="button" class="btn btn-primary cancel">Cancel</button>
    </div>
  </form>
</div>

</body>
</html>
