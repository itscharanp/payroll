<?php include 'dbconnect.php'?>
<?php
session_start();
$id=$_SESSION['id'];
$result=mysqli_query($conn,"SELECT * FROM employee WHERE eid='$id';");
$row=mysqli_fetch_assoc($result);
$aid=$row['aid'];
$result1=mysqli_query($conn,"SELECT * FROM administrator WHERE aid='$aid';");
$row1=mysqli_fetch_assoc($result1);
$bid=$row1['bid'];
$result2=mysqli_query($conn,"SELECT * FROM branch WHERE bid='$bid';");
$row2=mysqli_fetch_assoc($result2);
$cid=$row2['cid'];
$result3=mysqli_query($conn,"SELECT * FROM company WHERE cid='$cid';");
$row3=mysqli_fetch_assoc($result3);
$result4=mysqli_query($conn,"SELECT * FROM user WHERE id='$id';");
$row4=mysqli_fetch_assoc($result4);
$basic=$row["basic"];
$result5=mysqli_query($conn,"SELECT * FROM salary WHERE basic='$basic';");
$row5=mysqli_fetch_assoc($result5);
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
  <link rel="stylesheet" href="employee.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="employee.js"></script>
</head>
<body>

<div class="jumbotron row m-0">
  <h1 class="container col-sm-12 text-center">EMPLOYEE</h1>
  <form class="container col-sm-10 text-right" action="e_account_info.php" method="POST">
    <input type="submit" name="Logout" value="Logout"/>
  </form>
</div>

<div class="container">
  <table class="table">
      <tr class="row m-0">
        <th class="col-sm-2">Employee ID</th>
        <td class="col-sm-10"><?php echo $row["eid"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Employee Name</th>
        <td class="col-sm-10"><?php echo $row["ename"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Date Of Birth</th>
        <td class="col-sm-10"><?php echo $row["dob"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Phone Number</th>
        <td class="col-sm-10"><?php echo $row["phone_no"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Company Name</th>
        <td class="col-sm-10"><?php echo $row3["cname"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Department</th>
        <td class="col-sm-10"><?php echo $row2["bname"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Designation</th>
        <td class="col-sm-10"><?php echo $row["designation"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Basic</th>
        <td class="col-sm-10"><?php echo $row["basic"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Medical Allowance</th>
        <td class="col-sm-10"><?php echo $row5["medical_allowance"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">HRA</th>
        <td class="col-sm-10"><?php echo $row5["hra"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">TA</th>
        <td class="col-sm-10"><?php echo $row5["ta"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">DA</th>
        <td class="col-sm-10"><?php echo $row5["da"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Incentive</th>
        <td class="col-sm-10"><?php echo $row5["incentive"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Administrator ID</th>
        <td class="col-sm-10"><?php echo $row1["aid"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Administrator Name</th>
        <td class="col-sm-10"><?php echo $row1["name"];?></td>
      </tr>
      <tr class="row m-0">
        <th class="col-sm-2">Password</th>
        <td class="col-sm-9"><?php echo $row4["pswd"];?></td>
        <td class="col-sm-1"><input id="editpassword" type="button" class="btn" value="Edit"/></td>
      </tr>
  </table>
</div>

<div id="overlayform" class="container-fluid" style="display:none;">
  <form id="form" action="e_account_info.php" method="POST" class="p-5 mt-3">
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
      <input type="submit" class="btn btn-primary" value="Done"/>
      <button type="button" class="btn btn-primary cancel">Cancel</button>
    </div>
  </form>
</div>

</body>
</html>
