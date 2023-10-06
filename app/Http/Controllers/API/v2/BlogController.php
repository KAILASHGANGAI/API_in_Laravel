<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCollection;
use App\Http\Resources\BlogResource;
use App\Http\Resources\UserCollection;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Contains;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return new BlogCollection($blogs);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required | min:8',
            'description' => 'required'
        ]);

        $validated['user_id'] = Auth::id();
        $model = Blog::create($validated);
        if ($model) {
            return response()->json([
                'mesage' => "Blog Created Successfully"
            ]);
        } else {
            return response()->json([
                'mesage' => "Blog Not Created. try Again Later"
            ]);
        }
    }
    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required | min:8',
            'description' => 'required'
        ]);

        $validated['user_id'] = Auth::id();
        $model = $blog->update($validated);
        if ($model) {
            return response()->json([
                'mesage' => "Blog Updated Successfully"
            ]);
        } else {
            return response()->json([
                'mesage' => "Blog Not Updated. try Again Later"
            ]);
        }
    }
    public function destroy(Blog $blog)
    {
        if ($blog->delete()) {
            return response()->json([
                'mesage' => "Blog Deletec Successfully"
            ]);
        } else {
            return response()->json([
                'mesage' => "Blog Not Deleted. try Again Later"
            ]);
        }
    }
}
