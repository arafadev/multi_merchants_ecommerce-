<?php

namespace App\Http\Controllers\Site;

use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogPost = BlogPost::latest()->get();
        return view('site.blog.index', compact('blogCategories', 'blogPost'));
    }
    public function blogDetails($id, $slug)
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogDetails = BlogPost::findOrFail($id);
        $breadcat = BlogCategory::where('id', $id)->get();
        return view('site.blog.details', compact('blogCategories', 'blogDetails', 'breadcat'));
    }
    public function BlogPostCategory($id, $slug)
    {

        $blogCategories = BlogCategory::latest()->get();
        $blogPost = BlogPost::where('category_id', $id)->get();
        $breadcat = BlogCategory::where('id', $id)->get();
        return view('site.blog.category_post', compact('blogCategories', 'blogPost', 'breadcat'));
    } // End Method
}
