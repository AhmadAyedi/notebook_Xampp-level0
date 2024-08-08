// Function to send data from the input field to the server
function sendData() {
    // Get the value entered by the user in the input field with ID 'noteInput'
    const note = document.getElementById('noteInput').value;
    
    // Check if the input field is empty or contains only whitespace
    if (note.trim() === "") {
        // Alert the user to enter a note
        alert("Please enter a note.");
        // Exit the function to prevent sending an empty request
        return;
    }

    // Send a POST request to the server with the note data
    fetch('http://localhost/notebook/server_side/store_data.php', {
        method: 'POST', // Specify the HTTP method as POST
        headers: {
            'Content-Type': 'application/json', // Indicate that the request body is JSON
        },
        body: JSON.stringify({ note: note }), // Convert the note data to a JSON string
    })
    .then(response => response.json()) // Parse the JSON response from the server
    .then(data => {
        // Display the message received from the server in an element with ID 'message'
        document.getElementById('message').textContent = data.message;
        // Clear the input field after successful submission
        document.getElementById('noteInput').value = '';
    })
    .catch((error) => {
        // Log any errors to the console
        console.error('Error:', error);
    });
}
