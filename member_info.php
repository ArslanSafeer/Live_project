
<?php
session_start();
if(!isset($_SESSION['uid'])){
header('location:signin.php');
}
?>

<?php
include 'member_info_db.php';
  // Include database file
  $customerObj = new Customers();

  // Insert Record in customer table
  if(isset($_POST['submit'])) {
    $customerObj->insertData($_POST);
  }

?>

<?php
  
      $customerObj = new Customers();

  // Delete record from table
  if(isset($_GET['project_members_id']) && !empty($_GET['project_members_id'])) {
      $deleteId = $_GET['project_members_id'];
      $customerObj->deleteRecord($deleteId);
  }
     
?> 
<!DOCTYPE html>
<html>
  <head> 

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Live Project</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="index.php" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">MDF</strong><strong>PORTAL</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
                      
            <!-- Log out-->
            <div class="list-inline-item logout"><a id="logout" href="signin.php" class="nav-link">Logout <i class="icon-logout"></i></a></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5"></h1>
            <p></p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li><a href="index.php"> <i class="icon-home"></i>Home </a></li>
                <li><a href="project.php"> <i class="icon-grid"></i>Projects </a></li>
                <li><a href="project_detail.php"> <i class="icon-grid"></i>Project Detail </a></li>
                <li><a href="member_info.php"> <i class="icon-grid"></i>Project Members</a></li>
                <li><a href="user.php"> <i class="icon-grid"></i>Users </a></li>
                <li><a href="income.php"> <i class="icon-grid"></i>Income </a></li>
                <li><a href="expense.php"> <i class="icon-grid"></i>Expense </a></li>

      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Member Info</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Member Info</li>
          </ul>
        </div>
<div class="container">
  <?php
    if (isset($_GET['msg1']) == "insert") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Member added successfully
            </div>";
      } 
    if (isset($_GET['msg2']) == "update") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Member updated successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Member deleted successfully
            </div>";
    }
  ?>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<div class="container">
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">+ Add Record</button>
  <div id="demo" class="collapse">
    
            <div class="container">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="">Name:</label>
      <input type="text"  name="name" class="form-control" placeholder="Enter Name" required>
    </div>
        <div class="form-group">
      <label for="">Phone Number:</label>
      <input type="text" name="phone_no" class="form-control" placeholder="Enter Number" required>
    </div>
    <div class="form-group">
      <label for="">Email:</label>
      <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
    </div>
    <button type="submit" name="submit" class="btn btn-info">Submit</button>
  </form>
</div>
  </div>
</div>
<br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>Sr No</th>
                                            <th>Member Name</th>
                                            <th>Phone No</th>
                                            <th>Email</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                            
                                            
                                        </tr>
                                    </thead>

      <?php 
          $customers = $customerObj->displayData(); 
          foreach ($customers as $customer) {
        ?>
        <tr>
          <td style="text-align: center;"><?php echo $customer['project_members_id'] ?></td>
          <td style="text-align: center;"><?php echo $customer['name'] ?></td>
          <td style="text-align: center;"><?php echo $customer['phone_no'] ?></td>
          <td style="text-align: center;"><?php echo $customer['email'] ?></td>
          <td>
            <a href="memberinfo_update.php?project_members_id=<?php echo $customer['project_members_id'] ?>" style="color:green">
              <i class="fa fa-pencil" aria-hidden="true"></i></a></td>&nbsp
            <td><a href="member_info.php?project_members_id=<?php echo $customer['project_members_id'] ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      <?php } ?><br><br>
        
      </div>
    </div>

    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-custom.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>