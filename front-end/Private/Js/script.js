// front-end/JS/script.js

async function checkName(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    const name = document.getElementById('name').value;

    try {
        // Send a request to the backend to check if the name exists in the database
        const response = await fetch('/check-name', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name })
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const result = await response.json();

        // Redirect based on the result
        if (result.exists) {
            window.location.href = '/front-end/Inform-User/vote.html';
        } else {
            window.location.href = '/front-end/Inform-User/NotRegistered.html';
        }
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        alert('An error occurred. Please try again.');
    }
}
