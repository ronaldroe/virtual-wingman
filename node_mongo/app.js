var express = require('express');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var mongoose = require('mongoose');
var fs = require('fs');

var index = require('./routes/index');
var login = require('./routes/login');
var sendlogin = require('./routes/sendlogin');
var sendbase = require('./routes/sendbase.js');
var acw_demo = require('./routes/acw_demo.js');
var mxg_demo = require('./routes/mxg_demo.js');

var app = express();

fs.readdirSync(__dirname + '/models').forEach(function(filename){
    if(~filename.indexOf('.js')) require(__dirname + '/models/' + filename);
});

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'hjs');
app.set('partials', {header: 'header', footer: 'footer'});

// uncomment after placing your favicon in /public
//app.use(favicon(__dirname + '/public/favicon.ico'));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(require('node-compass')({mode: 'expanded'}));
app.use(express.static(path.join(__dirname, 'public')));

app.use('/', index);
app.use('/login', login);
app.use('/sendlogin', sendlogin);
app.use('/sendbase', sendbase);
app.use('/acw', acw_demo);
app.use('/mxg', mxg_demo);

// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});

mongoose.connect('mongodb://' + process.env.IP + '/drunk_button'); 

// error handlers

// development error handler
// will print stacktrace
if (app.get('env') === 'development') {
  app.use(function(err, req, res, next) {
    res.status(err.status || 500);
    res.render('error', {
      message: err.message,
      error: err
    });
  });
}

// production error handler
// no stacktraces leaked to user
app.use(function(err, req, res, next) {
  res.status(err.status || 500);
  res.render('error', {
    message: err.message,
    error: {}
  });
});


module.exports = app;
