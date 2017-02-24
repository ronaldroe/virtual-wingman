var express = require('express');
var mongoose = require('mongoose');
var router = express.Router();

router.get('/', function(req, res, next){
    res.render('acw');
});

module.exports = router;