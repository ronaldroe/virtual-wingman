var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var unitsSchema = new Schema({
    unit_name: String,
    unit_pass: String,
    unit_base: String,
    unit_shirt_num: String,
    unit_chaplain_num: String
});

var units = mongoose.model('units', unitsSchema);