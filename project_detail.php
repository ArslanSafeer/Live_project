<?php
   session_start();
   if(!isset($_SESSION['uid'])){
   header('location:signin.php');
   }
   ?>
<?php
   include 'project_detail_db.php';
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
   if(isset($_GET['Project_detail_id']) && !empty($_GET['Project_detail_id'])) {
   $deleteId = $_GET['Project_detail_id'];
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
            <div class="container-fluid d-flex align-items-center justify-content-between">
               <div class="navbar-header">
                  <!-- Navbar Header-->
                  <a href="index.php" class="navbar-brand">
                     <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">MDF</strong><strong>PORTAL</strong></div>
                     <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div>
                  </a>
                  <!-- Sidebar Toggle Btn-->
                  <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
               </div>
                 
                  <!-- Log out               -->
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
            <h2 class="h5 no-margin-bottom">Project Detail</h2>
         </div>
      </div>
      <!-- Breadcrumb-->
      <div class="container-fluid">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Project Detail</li>
         </ul>
      </div>
      <div class="container">
         <?php
            if (isset($_GET['msg1']) == "insert") {
              echo "<div class='alert alert-success alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      Detail added successfully
                    </div>";
              } 
            if (isset($_GET['msg2']) == "update") {
              echo "<div class='alert alert-success alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      Project detail updated successfully
                    </div>";
            }
            if (isset($_GET['msg3']) == "delete") {
              echo "<div class='alert alert-success alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      Project detail deleted successfully
                    </div>";
            }
            ?>
      </div>
   
         <!-- jquery -->
         <script src="js/jquery-1.12.4.min.js"></script>
         <!-- jquery ui -->
         <script src="js/jquery-ui-1.12.1.min.js"></script>
        
   </body>
</html>

 <div class="container">               
                    <div class="card-body">                    
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                              
                                    <div class="form-group">
                                        <label>Click to Filter</label> <br>
                                      <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                  <tr>
                        <td id="table-data">
                        </td>
                     </tr>                           
                        </form>                 
            </div>
        </div>
    </div>

<div class="text-right">
   <form style="margin-right: 23px;" action="excel.php" method="post">
      <input type="submit" name="export_excel" class="btn btn-success" value="Export to Excel" />
   </form>
</div>
</form>
<div class="container">
   <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">+ Add Record</button>
   <div id="demo" class="collapse">
      <div class="container">
         <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="">Date:</label>
               <input type="date"  name="date" class="form-control" placeholder="Enter Date" required>
            </div>
            <div class="form-group">
               <label for="">Attended By:</label>
               <input type="text" name="attended_by" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
               <label for="">Project Detail:</label>
               <textarea id="detail" name="detail" rows="4" class="form-control" cols="50" required></textarea>
            </div>
            <?php
               function get_user_name($user_id){
               $servername = "localhost";
               $username = "root";
               $password = "";
               $dbname = "live_project";
               
               // Create connection
               $conn = new mysqli($servername, $username, $password, $dbname);
                $get_u ="SELECT name FROM `project`WHERE project_id=$user_id";
                $get_row = $conn->query($get_u);
                $user_row=$get_row->fetch_assoc();
               
               //print_r( $user_row);
                return $user_row['name'];
               }
               
               
               
               $servername = "localhost";
               $username = "root";
               $password = "";
               $dbname = "live_project";
               
               // Create connection
               $conn = new mysqli($servername, $username, $password, $dbname);
               // Check connection
               if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
               }
               
               
               $sql="SELECT project_id, name,detail,started_date,parent_id,initiated_by_id,current_initiated_by FROM project";
               $result = $conn->query($sql);
               ?>
            <label for=""><b>Project:</b></label>
            <select name="project_id" class="form-control">
               <option value="">--Choose--</option>
               <?php 
                  while($row=$result->fetch_assoc()){
                      $project_id=$row['project_id'];
                      $name=$row['name'];
                      
                  ?>
               <?php 
                  $selected='';
                  if($_GET['project_id'] == $project_id)
                  {
                    $selected='selected';
                  }else{
                    $selected='';
                  }
                  ?>
               <option value="<?php echo $project_id; ?>" <?php echo $selected; ?>><?php echo $name; ?></option>
               <?php }?>    
            </select>
            <br>
            <button type="submit" name="submit" class="btn btn-info">Submit</button>
         </form>
         <br>
      </div>
   </div>
</div>
<br>
<div class="card shadow mb-4">
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
            <tr style="text-align: center;">
               <th>Sr No</th>
               <th>Date</th>
               <th>Attended By</th>
               <th>Project Detail</th>
               <th>Project</th>
               <th>Update</th>
               <th>Delete</th>
               <th>Upload Image</th>
               <th>View Image</th>
            </tr>
         </thead>
         <tbody id="table-data">
         <?php 
             $from_date=''; 
             $to_date='';
            if(isset($_GET['project_id']))
            {
             $project_id = $_GET['project_id'];
            }
            else
            {
             $project_id = ''; 
             $from_date=''; 
             $to_date='';
            }
            if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                                    $from_date = $_GET['from_date'];
                                    $to_date = $_GET['to_date'];
                              }
               $customers = $customerObj->displayData($project_id,$to_date,$from_date); 
               if($customers){
               foreach ($customers as $customer) {
             ?>
         <tr>
            <td style="text-align: center;"><?php echo $customer['Project_detail_id'] ?></td>
            <td style="text-align: center;"><?php echo $customer['date'] ?></td>
            <td style="text-align: center;"><?php echo $customer['attended_by'] ?></td>
            <td style="text-align: center;"><?php echo $customer['detail'] ?></td>
            <td style="text-align: center;"><?php echo $customer['name'] ?></td>
            <td>
               <a href="project_detail_update.php?Project_detail_id=<?php echo $customer['Project_detail_id'] ?>" style="color:green">
               <i class="fa fa-pencil" aria-hidden="true"></i></a>
            </td>
            &nbsp
            <td><a href="project_detail.php?Project_detail_id=<?php echo $customer['Project_detail_id'] ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
               <i class="fa fa-trash" aria-hidden="true"></i>
               </a>
            </td>
            <td>
                <a href="upload.php?Project_detail_id=<?php echo $customer['Project_detail_id'] ?>" style="color:green">
                 <button type="button" class="btn btn-info">Upload Image</button></a>
               </td>
               <td>
                <a href="fetch_images.php?Project_detail_id=<?php echo $customer['Project_detail_id'] ?>" style="color:green">
                 <button type="button" class="btn btn-info">Image Gallery</button></a>
               </td>
         </tr>
         <?php }
            } ?></tbody><br><br>
      </div>
   </div>
</div>
<!-- JavaScript files-->
<script src="vendor/popper.js/umd/popper.min.js"> </script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="js/charts-custom.js"></script>
<script src="js/front.js"></script>
</body>
</html