<?php
    // web/index.php
    
    require_once __DIR__.'/../vendor/autoload.php';
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    
    $app = new Silex\Application();
    
    // Service provider registrations go here
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));

    // Routes go here
    $app->get('/', function(Request $request) use ($app) {
        return "<h1>Hello World</h1>";
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