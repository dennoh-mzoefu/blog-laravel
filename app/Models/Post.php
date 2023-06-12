<?php

namespace App\Models;
use Illuminate\Support\Facades\File;

class Post {
    public static function find($slug){

    $path = __DIR__."/../../resources/posts/{$slug}.html";

    if(!file_exists($path)){
        throw new ModelNotFoundException;
    }
     return cache() -> remember("posts.{$slug}",1200, fn() => file_get_contents($path));
    
    }
    public static function all(){
        $files=File::files(resource_path('posts/'));
        // dd(File::files(resource_path('posts/')))
       return array_map(
            function ($file) {
                return $file->getContents();
            },$files);
   
}
} 

?>