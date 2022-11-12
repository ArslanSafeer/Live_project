<?php

$search = $_POST["search"];

$conn = mysqli_connect("localhost","root","","live_project") or die("Connection Failed");

$sql = "SELECT * FROM project WHERE name LIKE '%{$search}%'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){
  
 function get_user_tbl_name($user_id){
                           $servername = "localhost";
                           $username = "root";
                           $password = "";
                           $dbname = "live_project";
                           
                           // Create connection
                           $conn = new mysqli($servername, $username, $password, $dbname);
                            $get_u ="SELECT user_name FROM `user`   WHERE id=$user_id";
                            $get_row = $conn->query($get_u);
                            $user_row=$get_row->fetch_assoc();
                           
                           //print_r( $user_row);
                            return $user_row['user_name'];
                           }
   function get_project_detail_name($id){
                           $servername = "localhost";
                           $username = "root";
                           $password = "";
                           $dbname = "live_project";
                           
                           // Create connection
                           $conn = new mysqli($servername, $username, $password, $dbname);
                            $get_u ="SELECT attended_by FROM `project_detail`   WHERE Project_detail_id=$id";
                            $get_row = $conn->query($get_u);
                            $user_row=$get_row->fetch_assoc();
                           
                           //print_r( $user_row);
                            return $user_row['attended_by'];
                           }
              while($row = mysqli_fetch_assoc($result)){
                // $output .= "<tr>
                //  <td align='center'>{$row["project_id"]}</td><td>{$row["name"]}</td><td>{$row["detail"]}</td>
                //  <td>{$row["started_date"]}</td>
                //  <td>{$row["name"]}</td>
                //  <td>{$row["initiated_by_id"]}</td>
                //  <td>{$row["current_initiated_by"]}</td>
                //  </tr>";


                 $output .= "<tr>
                           <td style='text-align: center;'>{$row['project_id'] }</td>
                           <td style='text-align: center;'>{$row['name'] }</td>
                           <td style='text-align: center;'>{$row['detail'] }</td>
                           <td style='text-align: center;'>{$row['started_date'] }</td>
                           <td style='text-align: center;'>{$row['name'] }</td>
                           <td style='text-align: center;'>".get_project_detail_name($row['initiated_by_id'])."</td>
                           <td style='text-align: center;'>".get_user_tbl_name($row['current_initiated_by'])."</td>
                           <td>
                              <a href='project_update.php?project_id={$row['project_id'] }' style='color:green'>
                              <i class='fa fa-pencil' aria-hidden='true'></i></a>
                           </td>
                           &nbsp
                           <td><a href='project.php?project_id={$row['project_id'] }' style='color:red' onclick='confirm('Are you sure want to delete this record')'>
                              <i class='fa fa-trash' aria-hidden='true'></i>
                              </a>
                           </td>
                           <td>
                              <a href='project_detail.php?project_id={$row['project_id'] }' style='color:green'>
                              <button type='button' class='btn btn-info'>Project detail</button></a>
                           </td>
                        </tr>";
              }

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>
