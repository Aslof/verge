<?php
include 'lib/bones.php';

get('/', function($app) {
	echo "Home";
});

get('/signup', function($app) {
	echo "Signup!";
});

get('/love', function($app) {
	echo "I love you!";
});

