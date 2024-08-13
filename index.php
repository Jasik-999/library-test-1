<?php
    require_once('config.php');
    require_once('Router.php');
    require_once('db_connection.php');

    // Router::route('blog/(\w+)/(\d+)', function($category, $id){
    //     print $category . ':' . $id;
    // });

    include_once('views/header.php');

    Router::route('/', function() use ($db){
        return include('views/home.php');
    });

    Router::route('/(\w+)', function($controller) use ($db){
        return include("views/{$controller}/index.php");
    });

    // Router::route('/assets/(\w+)', function($controller){
    //     return include("assets");
    // });

    Router::route('/(\w+)/(\w+)', function($controller, $action) use ($db){
        return include("views/{$controller}/{$action}.php");
    });
    
    Router::execute($_SERVER['REQUEST_URI']);

    include_once('views/footer.php');