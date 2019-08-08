<?php include 'dbconnect.php' ?>
<?php
if(isset($_POST['uname']))
{
  $id=$_POST['uname'];
  $pswd=$_POST['pswd'];
  $sql="SELECT * from  user where id='$id' and pswd='$pswd'";
  $result=mysqli_query($conn,$sql);
  $cscon = mysqli_num_rows($result);
  if($cscon == 1)
  {
    $urow = mysqli_fetch_assoc($result);
    $role = $urow["role"];
    session_start();
    $_SESSION['id']=$id;
    $_SESSION['role']=$role;
    if($role=="a"){
      header('location: a_account_info.php');
    }
    else{
      header('location: e_account_info.php');
    }
  }
  else
  {
    echo "INVALID DETAILS";
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payroll Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url('PayrollManagement.jpg'); background-repeat:no-repeat; background-size: 100% 100%;min-height:100vh;">

<div class="jumbotron row m-0">
  <h1 class="container col-sm-12 text-center">PAYROLL MANAGEMENT SYSTEM</h1>
</div>

<div class="container p-5 mt-3" style="width:30%;border:1px solid #ddd;background:white;">
  <h4 class="text-center pb-3">Login Form</h4>
  <form action="" method="post">
    <div class="form-group">
      <label for="uname">Username:</label>
      <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname">
    </div>
    <div class="form-group">
      <label for="pswd">Password:</label>
      <input type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd">
    </div>
    <div class="text-center">
      <input type="submit" class="btn btn-primary" value="Login">
    </div>
  </form>
</div>

</body>
</html>
