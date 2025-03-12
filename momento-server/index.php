<?php 

// Define your base directory 
$base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove the base directory from the request if present
if (strpos($request, $base_dir) === 0) {
    $request = substr($request, strlen($base_dir));
}

// Ensure the request is at least '/'
if ($request == '') {
    $request = '/';
}

$apis = [
    // User routes
    '/register' => ['controller' => 'UserController', 'method' => 'register'],
    '/login'    => ['controller' => 'UserController', 'method' => 'login'],
    '/user'     => ['controller' => 'UserController', 'method' => 'getUser'],
    '/update'   => ['controller' => 'UserController', 'method' => 'updateUser'],
    '/delete'   => ['controller' => 'UserController', 'method' => 'deleteUser'],

    // Photo routes
    '/photos' => ['controller' => 'PhotoController', 'method' => 'getAllPhotos'],
    '/photo/upload' => ['controller' => 'PhotoController', 'method' => 'uploadPhoto'],
    '/photo' => ['controller' => 'PhotoController', 'method' => 'getPhoto'],
    '/photo/tags' => ['controller' => 'PhotoController', 'method' => 'getPhotoTags'],
    '/photo/update-tags' => ['controller' => 'PhotoController', 'method' => 'updatePhotoTags'],
    '/photos/by-tag' => ['controller' => 'PhotoController', 'method' => 'getPhotosByTag'],
    
    // Tag routes
    '/tags' => ['controller' => 'TagController', 'method' => 'getAllTags'],
    '/tag/create' => ['controller' => 'TagController', 'method' => 'createTag'],
    '/tag/delete' => ['controller' => 'TagController', 'method' => 'deleteTag']
];

if (isset($apis[$request])) {
    $controllerName = $apis[$request]['controller'];
    $method = $apis[$request]['method'];
    require_once "api/v1/{$controllerName}.php";
    
    $controller = new $controllerName();
    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        echo "Error: Method {$method} not found in {$controllerName}.";
    }
} else {
    echo "404 Not Found";
}