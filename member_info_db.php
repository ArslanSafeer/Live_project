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
            $phone_no = $this->con->real_escape_string($_POST['phone_no']);
            $email = $this->con->real_escape_string($_POST['email']);
            
            $query="INSERT INTO project_members(name,phone_no,email) VALUES('$name','$phone_no','$email')";
            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:member_info.php?msg1=insert");
            }else{
                echo "Data not inserted!";
            }
        }

        // Fetch customer records for show listing
        public function displayData()
        {
            $query = "SELECT * FROM project_members";
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
            $query = "SELECT * FROM project_members WHERE project_members_id= '$id'";
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
            $phone_no = $this->con->real_escape_string($_POST['phone_no']);
            $email = $this->con->real_escape_string($_POST['email']);
            $id = $this->con->real_escape_string($_REQUEST['project_members_id']);
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE project_members SET name ='$name', phone_no='$phone_no', email='$email' WHERE project_members_id = '$id'";
            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:member_info.php?msg2=update");
            }else{
                echo "Data not update successfully";
            }
            }
            
        }


        // Delete customer data from customer table
        public function deleteRecord($id)
        {
            $query = "DELETE FROM project_members WHERE project_members_id = '$id'";
            $sql = $this->con->query($query);
        if ($sql==true) {
            header("Location:member_info.php?msg3=delete");
        }else{
            echo "Record does not delete try again";
            }
        }

    }
?>