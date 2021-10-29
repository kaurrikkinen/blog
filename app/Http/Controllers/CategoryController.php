<?php


namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public $messages = [
        "name.required" => "Please enter a name.",
        "name.max" => "Category name cannot exceed 15 characters.",
        "name.unique" => "This category name is already taken.",
        "name.regex" => "Please use only letters, numbers and underscores."
    ];

    public function getAllCategories()
    {
        return response()->json(Category::orderBy("created_at", "DESC")->get());
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "name" => "required|max:15|unique:categories|regex:/^[\w]*$/"
        ], $this->messages);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            "name" => "required|max:15|unique:categories|regex:/^[\w]*$/"
        ], $this->messages);


        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category, 200);
    }
}
