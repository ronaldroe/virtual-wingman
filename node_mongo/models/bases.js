var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var basesSchema = new Schema({
    base_name: String,
    base_aadd_num: String,
    base_sapr_num: String,
    base_afrc_num: String
});

mongoose.model('bases', basesSchema);