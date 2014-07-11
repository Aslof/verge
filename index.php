<?php
include 'lib/bones.php';

get('/', function($app) {
	$app->set('message', 'Welcome Back!');
	$app->render('home');

});

get('/signup', function($app) {
  $app->render('signup');
});

get('/love', function($app) {
	echo "I love you!";
});

