<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function getPosts($category_id)
    {
        return response()->json(Post::orderBy("updated_at", "DESC")->where("category_id", "LIKE", "$category_id")->get());
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "content" => "required|max:140",
            "category_id" => "exists:categories,id"
        ]);

        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            "content" => "required|max:140",
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        return response("Deleted", 200);
    }
}
