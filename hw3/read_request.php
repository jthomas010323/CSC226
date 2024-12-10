<?php
// Include the database connection
include('db.php');

// Only handle GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // If specific ID is passed, filter by ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM employees WHERE id = '$id'";
    } else {
        // Fetch all employees if no ID is provided
        $sql = "SELECT * FROM employees";
    }

    $result = $conn->query($sql);

    // Check if any records were found
    if ($result->num_rows > 0) {
        $employees = [];
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        echo json_encode($employees);
    } else {
        echo json_encode(["message" => "No records found"]);
    }
}

$conn->close();
?>
