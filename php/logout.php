<?php
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    // Validate logout_id
    $logout_id = isset($_GET['logout_id']) ? (int)$_GET['logout_id'] : null;
    if(isset($logout_id)){
        $logout_id = mysqli_real_escape_string($conn, $logout_id);
        $status = "Offline now";
        
        // Debugging statement to print the SQL query
        $sql_query = "UPDATE users SET status = '{$status}' WHERE unique_id={$logout_id}";
        echo "SQL Query: " . $sql_query; // Print the SQL query for debugging purposes
        
        $sql = mysqli_query($conn, $sql_query);
        if($sql){
            session_unset();
            session_destroy();
            header("location: ../login.php");
            exit(); // Stop further execution after redirect
        } else {
            // Handle query error
            echo "Error: " . mysqli_error($conn);
            exit();
        }
    } else {
        header("location: ../users.php");
        exit(); // Stop further execution after redirect
    }
} else {  
    header("location: ../login.php");
    exit(); // Stop further execution after redirect
}
?>
