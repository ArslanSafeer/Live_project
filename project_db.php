
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

            $name = $this->con->real_escape_string($_POST['name']);
            $detail = $this->con->real_escape_string($_POST['detail']);
            $started_date = $this->con->real_escape_string($_POST['started_date']);
            $parent_id = $this->con->real_escape_string($_POST['parent_id']);
            $initiated_by_id = $this->con->real_escape_string($_POST['initiated_by_id']);
            $current_initiated_by = $this->con->real_escape_string($_POST['current_initiated_by']);
            
            
           $query="INSERT INTO project(name,detail,started_date,parent_id,initiated_by_id,current_initiated_by) VALUES('$name','$detail','$started_date','$parent_id','$initiated_by_id','$current_initiated_by')";
            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:project.php?msg1=insert");
            }else{
                echo "Data not inserted!";
            }
        }

        // Fetch customer records for show listing
        public function displayData($project_id='',$todate='',$fromdate='')
        {
             $where = '';
            if($project_id != '')
            {
                $where .= " AND a.project_id = ".$project_id;
            }
            if($todate != '' && $fromdate != ''){
                $where .= " AND a.started_date  BETWEEN '".$fromdate."' AND '".$todate."'";
            }
            
            
            

         $query = "SELECT a.project_id, a.name, a.detail, a.started_date, a.parent_id, a.initiated_by_id, b.user_name,  a.current_initiated_by
FROM project a
left join user b on b.id=a.initiated_by_id WHERE 1 $where
 ";
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
            $query = "SELECT * FROM project WHERE project_id= '$id'";
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
            $name = $this->con->real_escape_string($_POST['name']);
            $detail = $this->con->real_escape_string($_POST['detail']);
            $started_date = $this->con->real_escape_string($_POST['started_date']);
            $parent_id = $this->con->real_escape_string($_POST['parent_id']);
            $initiated_by_id = $this->con->real_escape_string($_POST['initiated_by_id']);
            $current_initiated_by = $this->con->real_escape_string($_POST['current_initiated_by']);
            $id = $this->con->real_escape_string($_REQUEST['project_id']);
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE project SET name ='$name', detail='$detail', started_date='$started_date', parent_id='$parent_id', initiated_by_id='$initiated_by_id', current_initiated_by='$current_initiated_by' WHERE project_id = '$id'";
            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:project.php?msg2=update");
            }else{
                echo "Data not update successfully";
            }
            }
            
        }


        // Delete customer data from customer table
        public function deleteRecord($id)
        {
            $query = "DELETE FROM project WHERE project_id = '$id'";
            $sql = $this->con->query($query);
        if ($sql==true) {
            header("Location:project.php?msg3=delete");
        }else{
            echo "Record does not delete try again";
            }
        }

    }
?>