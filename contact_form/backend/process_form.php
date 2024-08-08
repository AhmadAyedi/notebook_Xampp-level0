<?php
// Set the Content-Type header to indicate that the response will be in JSON format (no9sdo biha json string)
header('Content-Type: application/json');

// Include the database configuration file to establish a database connection
require 'db_config.php';

// Get the raw POST data from the request body
$postData = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array(converti m json string lil json object waila data structure liyifhimha php)
$request = json_decode($postData, true);

// Extract individual fields from the decoded JSON data
$name = $request['name']; // Retrieve the 'name' field
$email = $request['email']; // Retrieve the 'email' field
$message = $request['message']; // Retrieve the 'message' field

// Prepare an SQL statement to insert the form data into the 'contacts' table
$stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");

// Bind (yorbot) the parameters to the SQL statement (sss indicates that all three parameters are strings)
$stmt->bind_param("sss", $name, $email, $message);

// Execute the SQL statement
if ($stmt->execute()) {
    // If the execution is successful, send a success message in JSON format (aa tawa ki tji traja3 response lil client ista3mil json_encode bch tconverti m json object te3 php lil json string linista3mloha f data transmission)
    echo json_encode(['message' => 'Form submitted successfully.']);
} else {
    // If there's an error executing the statement, send an error message in JSON format
    echo json_encode(['message' => 'Error submitting form.']);
}

// Close the statement to free up resources
$stmt->close();

// Close the database connection
$conn->close();
