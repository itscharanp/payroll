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
if(isset($_POST['Delete'])){
  $eid=$_POST['eid'];
  $result1=mysqli_query($conn,"DELETE FROM employee WHERE eid='$eid';");
  $result1=mysqli_query($conn,"DELETE FROM user WHERE id='$eid';");
}
if(isset($_POST['Insert'])){
  $eid=$_POST['eid'];
  $ename=$_POST['ename'];
  $dob=$_POST['dob'];
  $phn=$_POST['phn'];
  $designation=$_POST['designation'];
  $basic=$_POST['basic'];
  $result1=mysqli_query($conn,"INSERT INTO employee VALUES('$ename','$eid','$designation','$dob','$phn','$basic','$aid');");
  $result1=mysqli_query($conn,"INSERT INTO user VALUES('$eid','$eid','e');");
}
if(isset($_POST['Update'])){
  $i=$_POST['eid'];
  $result1=mysqli_query($conn,"SELECT * FROM employee WHERE eid='$i';");
  $row1=mysqli_fetch_assoc($result1);
}
if(isset($_POST['upd'])){
  $i=$_POST['i'];
  $eid=$_POST['eid'];
  $ename=$_POST['ename'];
  $dob=$_POST['dob'];
  $phn=$_POST['phn'];
  $designation=$_POST['designation'];
  $basic=$_POST['basic'];
  $result2=mysqli_query($conn,"UPDATE employee SET ename='$ename',eid='$eid',designation='$designation',dob='$dob',phone_no='$phn',basic='$basic',aid='$aid' WHERE eid='$i';");
  $result2=mysqli_query($conn,"UPDATE user SET id='$eid',pswd='$eid' WHERE id='$i';");
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
        <th>Employee ID</th>
        <th>Employee Name</th>
        <th>Date of Birth</th>
        <th>Phone Number</th>
        <th>Designation</th>
        <th>Basic</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result=mysqli_query($conn,"SELECT * FROM employee WHERE aid='$id';");
        while($row = mysqli_fetch_assoc($result)){ ?>
          <tr>
            <td><?php echo $row["eid"];?></td>
            <td><?php echo $row["ename"];?></td>
            <td><?php echo $row["dob"];?></td>
            <td><?php echo $row["phone_no"];?></td>
            <td><?php echo $row["designation"];?></td>
            <td><?php echo $row["basic"];?></td>
            <td>
              <form action="" method="post">
                <input type="text" name="eid" value="<?php echo $row["eid"];?>" style="display:none;">
                <input id="update" class="btn" type="submit" name="Update" value="Update">
              </form>
            </td>
            <td>
              <form action="" method="post">
                <input type="text" name="eid" value="<?php echo $row["eid"];?>" style="display:none;">
                <input id="delete" class="btn" type="submit" name="Delete" value="Delete">
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
    <div class="form-group">
      <label for="eid">Employee ID:</label>
      <input type="text" class="form-control" id="eid" placeholder="Employee ID" name="eid">
    </div>
    <div class="form-group">
      <label for="ename">Employee Name:</label>
      <input type="text" class="form-control" id="ename" placeholder="Employee name" name="ename">
    </div>
    <div class="form-group">
      <label for="dob">Date of Birth:</label>
      <input type="date" class="form-control" id="dob" name="dob">
    </div>
    <div class="form-group">
      <label for="phn">Phone Number:</label>
      <input type="text" class="form-control" id="phn" placeholder="Enter phone number" name="phn">
    </div>
    <div class="form-group">
      <label for="designation">Designation:</label>
      <input type="text" class="form-control" id="designation" placeholder="Enter designation" name="designation">
    </div>
    <div class="form-group">
      <label for="basic">Basic:</label>
      <input type="text" class="form-control" id="basic" placeholder="Enter basic" name="basic">
    </div>
    <div class="text-center">
      <input type="submit" class="btn btn-primary" name="Insert" value="Insert">
      <button type="button" class="btn btn-primary cancel">Cancel</button>
    </div>
  </form>
</div>

<div id="overlayuform" class="container-fluid" style="display:<?php echo isset($_POST['Update'])?'block':'none';?>">
  <form id="form" action="" class="p-5 mt-3" method="post">
    <input type="text" name="i" value="<?php echo isset($row1['eid'])?$row1['eid']:'none';?>" style="display:none;">
    <div class="form-group">
      <label for="eid">Employee ID:</label>
      <input type="text" class="form-control" id="eid" placeholder="Employee ID" name="eid" value="<?php echo isset($row1['eid'])?$row1['eid']:'none';?>">
    </div>
    <div class="form-group">
      <label for="ename">Employee Name:</label>
      <input type="text" class="form-control" id="ename" placeholder="Employee name" name="ename" value="<?php echo isset($row1['ename'])?$row1['ename']:'none';?>">
    </div>
    <div class="form-group">
      <label for="dob">Date of Birth:</label>
      <input type="date" class="form-control" id="dob" name="dob" value="<?php echo isset($row1['dob'])?$row1['dob']:'none';?>">
    </div>
    <div class="form-group">
      <label for="phn">Phone Number:</label>
      <input type="text" class="form-control" id="phn" placeholder="Enter phone number" name="phn" value="<?php echo isset($row1['phone_no'])?$row1['phone_no']:'none';?>">
    </div>
    <div class="form-group">
      <label for="designation">Designation:</label>
      <input type="text" class="form-control" id="designation" placeholder="Enter designation" name="designation" value="<?php echo isset($row1['designation'])?$row1['designation']:'none';?>">
    </div>
    <div class="form-group">
      <label for="basic">Basic:</label>
      <input type="text" class="form-control" id="basic" placeholder="Enter basic" name="basic" value="<?php echo isset($row1['basic'])?$row1['basic']:'none';?>">
    </div>
    <div class="text-center">
      <input type="submit" class="btn btn-primary" name="upd" value="Update">
      <button type="button" class="btn btn-primary cancel">Cancel</button>
    </div>
  </form>
</div>

</body>
</html>
