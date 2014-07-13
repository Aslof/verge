<?php
include 'lib/bones.php';

#Temp Benutzername und Passwort für den Admin der CouchDB
define('ADMIN_USER', 'root');
define('ADMIN_PASSWORD', 'Alexander1');

get('/', function($app) {
	$app->set('message', 'Welcome Back!');
	$app->render('home');

});

get('/signup', function($app) {
	$app->render('user/signup');
});

get('/login', function($app) {
	$app->render('user/login');
});

get('/logout', function($app) {
	User::logout();
	$app->redirect('/');
});

get('/say/:message', function($app) {
	$app->set('message', $app->request('message'));
	$app->render('home');
});

post('/signup', function($app) {
	$user = new User();
	$user->full_name = $app->form('full_name');
	$user->email = $app->form('email');
	$user->signup($app->form('username'), $app->form('password'));
	$app->set('success', 'Thanks for Signing Up ' . $user->full_name .   '!');
	$app->render('home');
});

post('/login', function($app) {
	$user = new User();
	$user->name = $app->form('username');
	$user->login($app->form('password'));
	$app->set('success', 'You are now logged in!');
	$app->render('home');
});

post('/post', function($app) {
	if (User::is_authenticated()) {
		$post = new Post();
		$post->content = $app->form('content');
		$post->create();
		$app->redirect('/user/' . User::current_user());
	} else {
		$app->set('error', 'You must be logged in to do that.');
		$app->render('user/login');
	}
});

get('/user/:username', function($app) {
	$app->set('user', User::get_by_username($app->request('username')));
	$app->set('is_current_user', ($app->request('username') == User::current_user() ? true : false));
	$app->render('user/profile');
});


//Muss immer am Ende des files stehen!!!
//resolve übernimmt das error handling für nicht gefundene Pfade!
resolve();
