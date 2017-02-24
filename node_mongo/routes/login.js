var express = require('express');
var mongoose = require('mongoose');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
    var units_output = mongoose.model('units').find().sort('unit_name').find(function(err, units_output){
        res.render('login', {title: 'Log in to your Virtual Wingman', 
                             data_opts: units_output
        });
    });
});

module.exports = router;
