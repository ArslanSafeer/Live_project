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
            $income_from = $this->con->real_escape_string($_POST['income_from']);
            $income_detail = $this->con->real_escape_string($_POST['income_detail']);
            $amount = $this->con->real_escape_string($_POST['amount']);
            $date = $this->con->real_escape_string($_POST['date']);            
            $query="INSERT INTO income(income_from,income_detail,amount,date) VALUES('$income_from','$income_detail','$amount','$date')";

            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:income.php?msg1=insert");
            }else{
                echo "Data not inserted!";
            }
        }

        // Fetch customer records for show listing
        public function displayData()
        {
            $query = "SELECT * FROM income";
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
            $query = "SELECT * FROM income WHERE income_id= '$id'";
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
            $income_from = $this->con->real_escape_string($_POST['income_from']);
            $income_detail = $this->con->real_escape_string($_POST['income_detail']);
            $amount = $this->con->real_escape_string($_POST['amount']);
            $date = $this->con->real_escape_string($_POST['date']);
            $id = $this->con->real_escape_string($_REQUEST['income_id']);
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE income SET income_from ='$income_from', income_detail='$income_detail', amount='$amount', date='$date' WHERE income_id = '$id'";
            $sql = $this->con->query($query);
            if ($sql==true) {
                header("Location:income.php?msg2=update");
            }else{
                echo "Data not update successfully";
            }
            }
            
        }


        // Delete customer data from customer table
        public function deleteRecord($id)
        {
            $query = "DELETE FROM income WHERE income_id = '$id'";
            $sql = $this->con->query($query);
        if ($sql==true) {
            header("Location:income.php?msg3=delete");
        }else{
            echo "Record does not delete try again";
            }
        }

    }
?>