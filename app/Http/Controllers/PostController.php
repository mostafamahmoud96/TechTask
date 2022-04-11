<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function get_posts()
    {

        if (auth()->user()->roles[0]->name == "Author") {
            $posts = Post::where('user_id', auth()->user()->id)->get();
            if(count($posts) > 0)
            {
                return response()->json([
                    "posts" => $posts,
                ], 200);

            }else
            {
                return response()->json([
                    "message" => "No posts Available for this Author"
                ], 200);
            }
        } else {
            $posts = Post::all();

            if(count($posts)>0)
            {
                return response()->json([
                    "posts" => $posts,
                ], 200);

            }
            else
            {
                return response()->json([
                    "message" => "No Posts Available",
                ], 200);
            }
        }
    }
}