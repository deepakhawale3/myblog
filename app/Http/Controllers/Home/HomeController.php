<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Newsletter;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all blogs in descending order
        $allBlogs = Blog::orderBy('created_at', 'desc')->where('status', 1)->limit(4)->get();

        

        // Get blogs with category 'Healthcare' (limit 4)
        $healthcareBlogs = Blog::orderBy('created_at', 'desc')->where('category', 'Healthcare')->where('status', 1)->limit(4)->get();

        // Get blogs with category 'Sports' (limit 4)
        $sportsBlogs = Blog::orderBy('created_at', 'desc')->where('category', 'Sports')->where('status', 1)->limit(4)->get();

        // Get blogs with category 'Educational' (limit 4)
        $educationalBlogs = Blog::orderBy('created_at', 'desc')->where('category', 'Educational')->where('status', 1)->limit(4)->get();

        // Get blogs with category 'Business' (limit 4)
        $businessBlogs = Blog::orderBy('created_at', 'desc')->where('category', 'Business')->where('status', 1)->limit(4)->get();

        // Get blogs with category 'Entertainment' (limit 4)
        $entertainmentBlogs = Blog::orderBy('created_at', 'desc')->where('category', 'Entertainment')->where('status', 1)->limit(4)->get();
        
        // Get blogs with category 'Entertainment' (limit 4)
        $economicalBlogs = Blog::orderBy('created_at', 'desc')->where('category', 'Economical')->where('status', 1)->limit(3)->get();
        // Get blogs randomly (limit 6)
        $randomBlogs = Blog::inRandomOrder()->where('status', 1)->limit(6)->get();

        return view('home.index', compact(
            'allBlogs',
            'healthcareBlogs',
            'sportsBlogs',
            'educationalBlogs',
            'businessBlogs',
            'entertainmentBlogs',
            'economicalBlogs',
            'randomBlogs'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showCategoryBlogs($categorySlug)
    {
        // Get the category based on the slug
        $category = Category::where('name', $categorySlug)->first();

        if (!$category) {
            abort(404); // Handle the case where the category is not found
        }

        // Get all blogs in the selected category
        $categoryBlogs = Blog::where('category', $categorySlug)->orderBy('created_at', 'desc')->where('status', 1)->paginate(10);

        // Get blogs randomly (limit 6)
        $randomBlogs = Blog::inRandomOrder()->where('status', 1)->limit(5)->get();

        return view('home.category', compact('category', 'categoryBlogs','randomBlogs'));
    }

    public function showBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $randomBlogs = Blog::inRandomOrder()->where('status', 1)->limit(5)->get();
         // Fetch comments associated with the blog
        $comments = Comment::where('blog_id', $blog->id)->where('status', 1)->get();

        return view('home.blog', compact('blog','randomBlogs','comments'));
    }


    



    public function storeComment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        Comment::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
            'blog_id' => $request->input('blog_id'),
            'status' => 0,
        ]);

        return redirect()->back()->with('success', 'Comment submitted successfully!');
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $blogs = Blog::where('title', 'like', '%' . $keyword . '%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        $randomBlogs = Blog::inRandomOrder()->where('status', 1)->limit(5)->get();
        return view('home.search', compact('blogs', 'keyword','randomBlogs'));
    }

    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create([
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'You have subscribed to the newsletter!');
    }
}
