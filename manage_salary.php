<?php include 'dbconnect.php'?>
<?php
session_start();
$id=$_SESSION['id'];
$aid=$id;
if(isset($_POST['Logout'])){
  session_unset();
  session_destroy();
  header('location: index.php');
}
if(isset($_POST['Edit'])){
  $basic=$_POST['basic'];
  $result1=mysqli_query($conn,"SELECT * FROM salary WHERE basic='$basic';");
  $row1=mysqli_fetch_assoc($result1);
}
if(isset($_POST['Update'])){
  $basic=$_POST['basic'];
  $ma=$_POST['ma'];
  $hra=$_POST['hra'];
  $ta=$_POST['ta'];
  $da=$_POST['da'];
  $incentive=$_POST['incentive'];
  $result1=mysqli_query($conn,"UPDATE salary SET medical_allowance='$ma',hra='$hra',ta='$ta',da='$da',incentive='$incentive' WHERE basic='$basic';");
}
if(isset($_POST['Insert'])){
  $aid=$_POST['aid'];
  $basic=$_POST['basic'];
  $ma=$_POST['ma'];
  $hra=$_POST['hra'];
  $ta=$_POST['ta'];
  $da=$_POST['da'];
  $incentive=$_POST['incentive'];
    $result1=mysqli_query($conn,"INSERT INTO salary VALUES('$ma','$basic','$hra','$ta','$da','$incentive','$aid');");
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

<nav class="container p-3">
  <ul class="nav nav-pills justify-content-center">
    <li class="nav-item" style="border:1px solid blue;">
      <a id="insert" class="nav-link pl-4 pr-4">Insert</a>
    </li>
  </ul>
</nav>

<div class="container">
  <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Basic</th>
        <th>Medical Allowance</th>
        <th>HRA</th>
        <th>TA</th>
        <th>DA</th>
        <th>Incentive</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result=mysqli_query($conn,"SELECT * FROM salary WHERE aid='$id';");
        while($row = mysqli_fetch_assoc($result)){ ?>
          <tr>
            <td><?php echo $row["basic"];?></td>
            <td><?php echo $row["medical_allowance"];?></td>
            <td><?php echo $row["hra"];?></td>
            <td><?php echo $row["ta"];?></td>
            <td><?php echo $row["da"];?></td>
            <td><?php echo $row["incentive"];?></td>
            <td>
              <form action="" method="post">
                <input type="text" name="basic" value="<?php echo $row["basic"];?>" style="display:none;">
                <input id="edit" class="btn" type="submit" name="Edit" value="Edit">
              </form>
            </td>
          </tr>
        <?php }
        ?>
    </tbody>
  </table>
</div>

<div id="overlayiform" class="container-fluid" style="display:none;">
  <form id="form" action="" class="p-5 mt-3" method="post">
    <input type="text" name="aid" value="<?php echo $aid;?>" style="display:none;">
    <div class="form-group">
      <label for="basic">Basic:</label>
      <input type="text" class="form-control" id="basic" placeholder="Enter basic" name="basic">
    </div>
    <div class="form-group">
      <label for="ma">Medical Allowance:</label>
      <input type="text" class="form-control" id="ma" placeholder="Enter medical allowance" name="ma">
    </div>
    <div class="form-group">
      <label for="hra">HRA:</label>
      <input type="text" class="form-control" id="hra" placeholder="Enter HRA" name="hra">
    </div>
    <div class="form-group">
      <label for="ta">TA:</label>
      <input type="text" class="form-control" id="ta" placeholder="Enter TA" name="ta">
    </div>
    <div class="form-group">
      <label for="da">DA:</label>
      <input type="text" class="form-control" id="da" placeholder="Enter DA" name="da">
    </div>
    <div class="form-group">
      <label for="incentive">Incentive:</label>
      <input type="text" class="form-control" id="incentive" placeholder="Enter incentive" name="incentive">
    </div>
    <div class="text-center">
      <input type="submit" class="btn btn-primary" name="Insert" value="Insert">
      <button type="button" class="btn btn-primary cancel">Cancel</button>
    </div>
  </form>
</div>

<div id="overlayform" class="container-fluid" style="display:<?php echo isset($_POST['Edit'])?'block':'none';?>">
  <form id="form" action="" class="p-5 mt-3" method="post">
    <div class="form-group">
      <label for="basic">Basic:</label>
      <input type="text" name="basic" value="<?php echo isset($row1['basic'])?$row1['basic']:'';?>" style="display:none;">
      <input type="text" class="form-control" id="basic" placeholder="Enter basic" name="basic" value="<?php echo isset($row1['basic'])?$row1['basic']:'';?>" disabled>
    </div>
    <div class="form-group">
      <label for="ma">Medical Allowance:</label>
      <input type="text" class="form-control" id="ma" placeholder="Enter medical allowance" name="ma" value="<?php echo isset($row1['medical_allowance'])?$row1['medical_allowance']:'';?>">
    </div>
    <div class="form-group">
      <label for="hra">HRA:</label>
      <input type="text" class="form-control" id="hra" placeholder="Enter HRA" name="hra" value="<?php echo isset($row1['hra'])?$row1['hra']:'';?>">
    </div>
    <div class="form-group">
      <label for="ta">TA:</label>
      <input type="text" class="form-control" id="ta" placeholder="Enter TA" name="ta" value="<?php echo isset($row1['ta'])?$row1['ta']:'';?>">
    </div>
    <div class="form-group">
      <label for="da">DA:</label>
      <input type="text" class="form-control" id="da" placeholder="Enter DA" name="da" value="<?php echo isset($row1['da'])?$row1['da']:'';?>">
    </div>
    <div class="form-group">
      <label for="incentive">Incentive:</label>
      <input type="text" class="form-control" id="incentive" placeholder="Enter incentive" name="incentive" value="<?php echo isset($row1['incentive'])?$row1['incentive']:'';?>">
    </div>
    <div class="text-center">
      <input type="submit" class="btn btn-primary" name="Update" value="Update">
      <button type="button" class="btn btn-primary cancel">Cancel</button>
    </div>
  </form>
</div>

</body>
</html>
