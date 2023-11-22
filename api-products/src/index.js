import "dotenv/config";
import "./config/database.js"

import express from "express";
import morgan from "morgan";

import router from "./routes/api.js";

const app = express();

app.use(express.json());
app.use(morgan('dev'))

app.use('/api/v1', router)

app.listen(process.env.APP_PORT, () => {
    console.log(`Server listening on port ${process.env.APP_PORT}`)
})