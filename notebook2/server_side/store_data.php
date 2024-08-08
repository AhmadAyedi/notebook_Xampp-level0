<?php
// Set the Content-Type header to JSON, indicating that the response will be in JSON format
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notebook";

// Create a new MySQLi connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // Send a JSON-encoded error message if the connection fails
    die(json_encode(["message" => "Connection failed: " . $conn->connect_error]));
}

// Read the raw POST data from the request body
$data = json_decode(file_get_contents("php://input"), true);
// Extract the 'note' field from the decoded JSON data
$note = $data['note'];

// Prepare an SQL statement to insert the note into the 'notes' table
$stmt = $conn->prepare("INSERT INTO notes (note) VALUES (?)");
// Bind the note parameter to the SQL statement (s indicates a string)
$stmt->bind_param("s", $note);

// Execute the SQL statement
if ($stmt->execute()) {
    // Send a JSON-encoded success message if the insertion is successful
    echo json_encode(["message" => "Note saved successfully!"]);
} else {
    // Send a JSON-encoded error message if the insertion fails
    echo json_encode(["message" => "Error: " . $stmt->error]);
}

// Close the prepared statement to free up resources
$stmt->close();
// Close the database connection
$conn->close();
