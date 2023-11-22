require("dotenv").config();

const express = require("express");
const path = require("path");
const morgan = require("morgan");
const fileUpload = require("express-fileupload");
const cors = require("cors");

const routes = require("./routes/index.routes");
const { registerService } = require("./libs/service");

require("./config/database");

//Initialize the server
const app = express();
require("./cron");

//Middleware
app.use(express.json());
app.use(morgan("dev"));
app.use(
  express.urlencoded({
    extended: true,
  })
);
app.use(fileUpload());
app.use(cors());

//Routes
app.use('/api', routes);

//Static files
app.use(express.static(path.join(__dirname, "public")));

app.listen(process.env.APP_PORT, process.env.APP_HOST, async () => {
  console.log("Listen to port " + process.env.APP_PORT);
});
