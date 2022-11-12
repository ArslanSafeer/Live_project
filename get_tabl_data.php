<?php
  $conn = mysqli_connect("localhost","root","","live_project") or die("Connection failed");

  if(isset($_POST['date1']) && isset($_POST['date2'])){
    $min = $_POST['date1'];
    $max = $_POST['date2'];
    $sql = "SELECT * FROM project_detail WHERE date BETWEEN '{$min}' AND '{$max}'";
  }else{
    $sql = "SELECT * FROM project_detail ORDER BY project_detail_id asc";
  }

  $result = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
  $output = "";

  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $dob = date('d M, Y',strtotime($row['date']));
      $output .= "<tr>
                           <td style='text-align: center;'>{$row['Project_detail_id'] }</td>
                           <td style='text-align: center;'>{$row['date'] }</td>
                           <td style='text-align: center;'>{$row['attended_by'] }</td>
                           <td style='text-align: center;'>{$row['detail'] }</td>
                           <td style='text-align: center;'>Username</td>
                           <td>
                              <a href='project_detail_update.php?project_id={$row['project_id'] }' style='color:green'>
                              <i class='fa fa-pencil' aria-hidden='true'></i></a>
                           </td>
                           &nbsp
                           <td><a href='project_detail.php?project_id={$row['project_id'] }' style='color:red' onclick='confirm('Are you sure want to delete this record')'>
                              <i class='fa fa-trash' aria-hidden='true'></i>
                              </a>
                           </td>
                        </tr>";
    }
    echo $output;
  }else{
    echo "<h2>No Record Found.</h2>";
  }

?>
