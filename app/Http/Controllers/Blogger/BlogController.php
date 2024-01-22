<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (auth()->user()->role !== 'blogger') {
            abort(403, 'Unauthorized'); 
        }
        $bloggerId = Auth::id();
        $blogs = Blog::where('blogger_id', $bloggerId)
            ->orderBy('created_at', 'desc')
            ->simplePaginate(10);
        
        return view('blogger.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories= Category::all();
        return view('blogger.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'introduction' => 'required',
            'category' =>'required',
            'description' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif', // Validate that 'img' is an image file
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $validatedData['blogger_id']= Auth::id();
        // Handle image upload
        $imageName = null;
         if ($request->hasFile('img')) {
             $imageName = time() . '_' . $request->img->getClientOriginalName();
             $request->img->move(public_path('images'), $imageName);
             $validatedData['img']= $imageName;
         }

        Blog::create($validatedData);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories= Category::all();
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blogger.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'introduction' => 'required',
            'category' =>'required',
            'description' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Allow updating 'img' as an image file
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $blog = Blog::findOrFail($id);

       // Handle image update
       $imageName = null;
       if ($request->hasFile('img')) {
           $imageName = time() . '_' . $request->img->getClientOriginalName();
           $request->img->move(public_path('images'), $imageName);
           $validatedData['img']= $imageName;
       } else {
            unset($validatedData['img']); // Remove 'img' from the validated data if no new image is uploaded
        }

        $blog->update($validatedData);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }

    public function showComments($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $comments = Comment::where('blog_id', $blogId)->get();

        return view('blogger.blog.comments', compact('blog', 'comments'));
    }
}