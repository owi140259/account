<?php
    // web/index.php

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/delegates/auth_delegate.php';
    
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\Session;

    $app = new Silex\Application();
    
    // Service provider registrations go here
    $app->register(new Silex\Provider\SessionServiceProvider());
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));

    // Before
    $app->before(function(Request $request) {
        $request->getSession()->start();
    });

    // Routes go here
    $app->get('/', function(Request $request) use ($app) {
        return "<h1>Hello World</h1>";
    });

    $app->get('/login', function(Request $request) use ($app) {
        return $app['twig']->render('login.twig', array());
    });

    $app->post('/login', function(Request $request) use ($app) {
        // Grab the form data
        $formEmail = $request->get('email');
        $formPassword = $request->get('password');
        
        // Validation
        $errors = array();
        $user = get_user_by_email($formEmail);
        
        if ($user == null) {
            
            $errors['email'] = "This email is not registered.";
            $model = array('email' => $formEmail, 'errors' => $errors);
            return $app['twig']->render('login.twig', $model);
            
        } else if (!correct_password_for_user($user, $formPassword)) {
            
            $errors['password'] = "This password is incorrect.";
            $model = array('email' => $formEmail, 'errors' => $errors);
            return $app['twig']->render('login.twig', $model);
            
        } else {
            
            $app['session']->set('id', $user['id']);
            $app['session']->set('name', $user['name']);
            $app['session']->set('email', $user['email']);
            $app['session']->set('avatar', $user['avatar_path']);
            return $app->redirect('/account/web/settings');
            
        }
    });

    $app->post('/logout', function(Request $request) use ($app) {
        $app['session']->invalidate();
        return $app['twig']->render('logout.twig', array());
    });
    
    $app->get('/greeting/{person}', function(Request $request, $person) use ($app) {
        return $app['twig']->render('hello.twig', array('name'=>$person));
    });

    $app->get('/settings', function(Request $request) use ($app) {
        return $app['twig']->render('settings.twig', array());
    });

    $app->get('/friends', function(Request $request) use ($app) {
        return $app['twig']->render('friends.twig', array());
    });

    // Run the app
    $app->run();
?>