<?php

    class Customers
    {
        private $servername = "localhost";
        private $username   = "root";
        private $password   = "";
        private $database   = "live_project";
        public  $con;


        // Database Connection 
        public function __construct()
        {
            $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
            if(mysqli_connect_error()) {
             trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
            }else{
            return $this->con;
            }
        }

        // Insert customer data into customer table
        public function insertData($post)
        {

            $date = $this->con->real_escape_string($_POST['date']);
            $attended_by = $this->con->real_escape_string($_POST['attended_by']);
            $detail = $this->con->real_escape_string($_POST['detail']);
            $project_id = $this->con->real_escape_string($_POST['project_id']);
            
             $query="INSERT INTO project_detail(date,attended_by,detail,project_id) VALUES('$date','$attended_by','$detail','$project_id')";

            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:project_detail.php?msg1=insert");
            }else{
                echo "Data not inserted!";
            }
        }

        // Fetch customer records for show listing
        public function displayData($project_id= '',$todate='',$fromdate='')
        {
             $where = '';
            if($project_id != '')
            {
                $where .= " AND a.project_id = ".$project_id;
            }
            if($todate != '' && $fromdate != ''){
                $where .= " AND a.date  BETWEEN '".$fromdate."' AND '".$todate."'";
            }



            $query = "SELECT a.Project_detail_id, a.date, a.attended_by, a.detail, b.name
FROM project_detail a
left join project b on b.project_id=a.project_id WHERE 1 $where"; 
            $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                   $data[] = $row;
            }
             return $data;
            }else{
             echo "No records found";
            }
        }

        // Fetch single data for edit from customer table
        public function displyaRecordById($id)
        {
            $query = "SELECT * FROM project_detail WHERE Project_detail_id= '$id'";
            $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
            }else{
            echo "Record not found";
            }
        }

        // Update customer data into customer table
        public function updateRecord($postData)
        {
            $date = $this->con->real_escape_string($_POST['date']);
            $attended_by = $this->con->real_escape_string($_POST['attended_by']);
            $detail = $this->con->real_escape_string($_POST['detail']);
            $project_id = $this->con->real_escape_string($_POST['project_id']);
            $id = $this->con->real_escape_string($_REQUEST['Project_detail_id']);
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE project_detail SET date ='$date', attended_by='$attended_by', detail='$detail', project_id='$project_id' WHERE Project_detail_id = '$id'";
            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:project_detail.php?msg2=update");
            }else{
                echo "Data not update successfully";
            }
            }
            
        }


        // Delete customer data from customer table
        public function deleteRecord($id)
        {
            $query = "DELETE FROM project_detail WHERE Project_detail_id = '$id'";
            $sql = $this->con->query($query);
        if ($sql==true) {
            header("Location:project_detail.php?msg3=delete");
        }else{
            echo "Record does not delete try again";
            }
        }

    }
?>