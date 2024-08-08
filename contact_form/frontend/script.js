// Attach an event listener to the form with the ID 'contactForm'
document.getElementById('contactForm').addEventListener('submit', function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();
    
    // Get the values from the form inputs
    const name = document.getElementById('name').value; // Get the value of the input with ID 'name'
    const email = document.getElementById('email').value; // Get the value of the input with ID 'email'
    const message = document.getElementById('message').value; // Get the value of the input with ID 'message'

    // Send a POST request to the server with the form data
    fetch('http://localhost/contact_form/backend/process_form.php', {
        method: 'POST', // Use the POST method to send data to the server
        headers: {
            'Content-Type': 'application/json' // Specify that the request body is JSON
        },
        body: JSON.stringify({ name, email, message }) // Convert the form data to a JSON string
    })
    // Parse the JSON from the response(tawa converti l json string lijeya m php(server_side) lil json object lihia data structure te3 js)
    .then(response => response.json())
    // Work with the parsed data
    .then(data => {
        // Display the server's response message in an element with the ID 'response'
        document.getElementById('response').innerText = data.message;
    })
    // Handle any errors that occur during the fetch operation
    .catch(error => {
        // Display an error message in an element with the ID 'response'
        document.getElementById('response').innerText = 'Error submitting form.';
    });
});
