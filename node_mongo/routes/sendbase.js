var express = require('express');
var mongoose = require('mongoose');
var router = express.Router();

/* GET home page. */
router.post('/', function(req, res, next) {
    var base = req.body.base;
    
    if(base){
        
        mongoose.model('bases').findOne({base_name: base}, function(err, units){
            
            res.send(units);
        
        });
        
    } else {
     
        res.send({login_error: true});
        
    }
});

module.exports = router;
