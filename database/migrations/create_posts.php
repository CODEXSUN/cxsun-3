<?php

require '../../lib/bootstrap.php';
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropIfExists('posts');
Capsule::schema()->create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->longText('content');
    $table->enum('status', ['draft', 'published'])->default('draft');
    $table->timestamps();
});

echo "Posts table created!\n";