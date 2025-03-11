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
    // Photo routes
    '/api/photos' => ['controller' => 'PhotoController', 'method' => 'getAllPhotos'],
    '/api/photo/upload' => ['controller' => 'PhotoController', 'method' => 'uploadPhoto'],
    '/api/photo' => ['controller' => 'PhotoController', 'method' => 'getPhoto'],
    '/api/photo/tags' => ['controller' => 'PhotoController', 'method' => 'getPhotoTags'],
    '/api/photo/update-tags' => ['controller' => 'PhotoController', 'method' => 'updatePhotoTags'],
    '/api/photos/by-tag' => ['controller' => 'PhotoController', 'method' => 'getPhotosByTag'],
    
    // Tag routes
    '/api/tags' => ['controller' => 'TagController', 'method' => 'getAllTags'],
    '/api/tag/create' => ['controller' => 'TagController', 'method' => 'createTag'],
    '/api/tag/delete' => ['controller' => 'TagController', 'method' => 'deleteTag']
];

if (isset($apis[$request])) {
    $controllerName = $apis[$request]['controller'];
    $method = $apis[$request]['method'];
    require_once "apis/v1/{$controllerName}.php";
    
    $controller = new $controllerName();
    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        echo "Error: Method {$method} not found in {$controllerName}.";
    }
} else {
    echo "404 Not Found";
}