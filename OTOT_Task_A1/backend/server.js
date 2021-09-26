const express = require("express");
const app = express();
const port = 8080;

app.get("/message", (req, res) => {
	res.send({
		data: "message to show that yuting successfully created a reverse proxy :) ",
	});
});

app.listen(port, () => {
	console.log(`Task A backend app listening at http://localhost:${port}`);
});
