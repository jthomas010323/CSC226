<?php
// Include the database connection
include('db.php');

// Only handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if the required fields are present
    if (isset($data['name']) && isset($data['email']) && isset($data['salary']) && isset($data['dob'])) {
        $name = $data['name'];
        $email = $data['email'];
        $salary = $data['salary'];
        $dob = $data['dob'];

        // Prepare the SQL query to insert the record
        $sql = "INSERT INTO employees (name, email, salary, dob) VALUES ('$name', '$email', '$salary', '$dob')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "New record created successfully"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Invalid input data"]);
    }
}

$conn->close();
?>
