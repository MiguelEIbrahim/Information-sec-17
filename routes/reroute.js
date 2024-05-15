const express = require('express');
const app = express();

// Redirect all requests to index.html
app.get('*', (req, res) => {
    res.redirect('index.html');
});

// Start the server
const PORT = process.env.PORT || 5500;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
