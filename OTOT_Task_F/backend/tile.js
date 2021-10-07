const mongoose = require("mongoose");
const { Schema } = mongoose;

const tileSchema = new Schema({
    type: String,
    X: Integer,
    y: Integer,
});

mongoose.model("Tile", tileSchema);