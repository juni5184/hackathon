<?php
require_once("./dbconfig.php");

mysqli_set_charset($conn, "utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE predict (
seq INT(6) AUTO_INCREMENT PRIMARY KEY, 
product_name VARCHAR(200) NOT NULL,
predict_year VARCHAR(200) NOT NULL,
ave_area VARCHAR(200) NOT NULL,
real_ave_amount VARCHAR(200) NOT NULL,
predict_ave_amount VARCHAR(200) NOT NULL,
real_amount VARCHAR(200) NOT NULL,
predict_amount VARCHAR(200) NOT NULL,
real_price VARCHAR(200) NOT NULL,
predict_price VARCHAR(200) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();




?>

