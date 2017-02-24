var express = require('express');
var mongoose = require('mongoose');
var router = express.Router();

/* GET home page. */
router.post('/', function(req, res, next) {
    
    var unit = req.body.unit;
    var pass = req.body.pass;
    
    if(unit && pass  && unit != "Select Unit"){
        
        mongoose.model('units').findOne({unit_name: unit}, function(err, units){
            
            if(pass == units.unit_pass){

                res.send(units);

            } else {

                res.send({password_error: true});

            }
        });
        
    } else {
     
        res.send({login_error: true});
        
    }
});

module.exports = router;
