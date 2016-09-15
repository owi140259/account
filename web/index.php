<?php
    // web/index.php
    
    require_once __DIR__.'/../vendor/autoload.php';
    
    use Symfony\Component\HttpFoundation\Request;

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));

    // Routes go here
    $app->get('/', function(Request $request) use ($app) {
        return "<h1>Hello World</h1>";
    });

    // Routes go here
    $app->get('/greeting/{person}', function(Request $request, $person) use ($app) {
        return $app['twig']->render('hello.twig', array('name' => $person));
    });

    $app->run();
?>