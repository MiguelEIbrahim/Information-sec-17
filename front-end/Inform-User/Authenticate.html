<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authenticate User</title>
    <link rel="stylesheet" href="../../front-end/CSS/index.css">
    <link rel="icon" href="../../img/logo-black.png" type="image/png">
    <script>
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
    </script>
</head>
<body>
    <form onsubmit="checkName(event)">
        <label for="name">Enter your name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
