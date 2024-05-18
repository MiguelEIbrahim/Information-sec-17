const express = require('express');
const bodyParser = require('body-parser');
const path = require('path');

const app = express();
const port = 3000;

// Sample database
const registeredNames = ['Alice', 'Bob', 'Charlie'];

app.use(bodyParser.json());
app.use('/front-end', express.static(path.join(__dirname, 'front-end')));
// Serve the root directory's index.html
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'index.html'));
});

// Endpoint to check if the name exists in the database
app.post('/check-name', (req, res) => {
    const { name } = req.body;
    const exists = registeredNames.includes(name);
    res.json({ exists });
});

app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
