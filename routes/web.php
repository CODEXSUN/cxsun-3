<?php
require_once __DIR__.'/../lib/bootstrap.php';

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Core\Models\Post;

$router = new Router(new \Illuminate\Events\Dispatcher);

$request = Request::capture();

// Public routes
$router->get('/', function () {
    $posts = Post::published()->latest()->get();
    return view('home', ['posts' => $posts]);
});

$router->get('/post/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->firstOrFail();
    return view('post', ['post' => $post]);
});

// Admin routes
$router->get('/admin', function () {
    return view('admin/layout');
});

$router->get('/admin/posts', function () {
    $posts = Post::latest()->get();
    return view('admin/posts', ['posts' => $posts]);
});

$router->post('/admin/posts', function () use ($request) {
    $data = $request->all();
    $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
    Post::create($data);
    return redirect('/admin/posts');
});

// API for React
$router->get('/api/posts', fn() => response()->json(Post::all()));
$router->post('/api/posts', function () use ($request) {
    $post = Post::create($request->all());
    return response()->json($post, 201);
});

return $router;