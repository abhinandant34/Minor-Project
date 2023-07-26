const express = require('express');
const bodyParser = require('body-parser');
const { spawn, exec } = require('child_process');

const app = express();

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

app.post('/predict', (req, res) => {
  const data = req.body.input;

  const pythonProcess = spawn(`python`, [`-u`,`${__dirname}/sqli.py`, data]);

  pythonProcess.stdout.on('data', (data) => {
    const output = data.toString();
    res.json({ success: true, output });
  });

  pythonProcess.stderr.on('data', (data) => {
    const error = data.toString().trim();
    res.json({ success: false, error });
    console.log(error);
  });

  pythonProcess.on('close', (code) => {
    console.log(`Python process exited with code ${code}`);
  });
});

const port = process.env.PORT || 3000;
app.listen(port, () => console.log(`Server listening on port ${port}`));
