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
            $user_name = $this->con->real_escape_string($_POST['user_name']);
            $user_email = $this->con->real_escape_string($_POST['user_email']);            
            $query="INSERT INTO user(user_name,user_email) VALUES('$user_name','$user_email')";

            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:user.php?msg1=insert");
            }else{
                echo "Data not inserted!";
            }
        }

        // Fetch customer records for show listing
        public function displayData()
        {
            $query = "SELECT * FROM user";
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
            $query = "SELECT * FROM user WHERE id= '$id'";
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
            $user_name = $this->con->real_escape_string($_POST['user_name']);
            $user_email = $this->con->real_escape_string($_POST['user_email']);
            $id = $this->con->real_escape_string($_REQUEST['id']);
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE user SET user_name ='$user_name', user_email='$user_email' WHERE id = '$id'";
            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:user.php?msg2=update");
            }else{
                echo "Data not update successfully";
            }
            }
            
        }


        // Delete customer data from customer table
        public function deleteRecord($id)
        {
            $query = "DELETE FROM user WHERE id = '$id'";
            $sql = $this->con->query($query);
        if ($sql==true) {
            header("Location:user.php?msg3=delete");
        }else{
            echo "Record does not delete try again";
            }
        }

    }
?>