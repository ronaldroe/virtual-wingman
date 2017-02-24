var express = require('express');
var mongoose = require('mongoose');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
    
    var unit = req.query.unit;
    var pass = req.query.pass;
    
    console.log(unit + "\n" + pass);
    
    if(unit && pass && pass != "Select Unit"){
        mongoose.model('units').findOne({ unit_name: unit }, { '_id': 0, 'lastModified': 0 }, function(err, units){
            
            mongoose.model('bases').findOne({ base_name: units.unit_base }, { '_id': 0 }, function(err, base_info){
            
                if(pass == units.unit_pass){
                    console.log(units + "\n" + base_info);
                    res.render('index', { title: units.unit_name + " Virtual Wingman", qr_login_data: "var unit_info = " + units + "; var base_info = " + base_info + ";" });
    
                } else {
                    
                    res.render('index', { title: "Virtual Wingman" });
                    
                }
            
            });
        });
        
    } else {
        res.render('index', { title: "Virtual Wingman" });
    }
});


module.exports = router;
