<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadPhotoTrait;

class BlogController extends Controller
{
    use UploadPhotoTrait;
    public function allBlogCategory()
    {
        $blogCategories = BlogCategory::latest()->get();
        return view('admin.blog.category.index', ['blogCategories' => $blogCategories]);
    }
    public function addBlogCategory()
    {
        return view('admin.blog.category.create');
    }
    public function storeBlogCategory(Request $request)
    {

        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification);
    } // End Method

    public function editBlogCategory($id)
    {

        $blogCategories = BlogCategory::findOrFail($id);
        return view('admin.blog.category.edit', compact('blogCategories'));
    } // End Method

    public function updateBlogCategory(Request $request)
    {

        $blog_id = $request->id;

        BlogCategory::findOrFail($blog_id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
        ]);

        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification);
    } // End Method


    public function deleteBlogCategory($id)
    {
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function allBlogPost()
    {

        $blogPost = BlogPost::latest()->get();
        return view('admin.blog.posts.index', ['blogPost' => $blogPost]);
    }


    public function addBlogPost()
    {
        $blogCategories = BlogCategory::latest()->get();
        return view('admin.blog.posts.create', ['blogCategories' => $blogCategories]);
    } // End Method
    public function storeBlogPost(Request $request)
    {
        $filename = $this->uploadPhoto($request->file('post_image'), 'upload/blog', 1103, 906);
        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description,
            'post_image' => $filename,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.post')->with($notification);
    } // End Method

    public function editBlogPost($id)
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogPost = BlogPost::findOrFail($id);
        return view('admin.blog.posts.edit', compact('blogCategories', 'blogPost'));
    } // End Method


    public function updateBlogPost(Request $request)
    {
        if ($request->file('post_image')) {
            $filename = $this->uploadPhoto($request->file('post_image'), 'upload/blog', 1103, 906);
            unlink($request->old_image);
        }
        BlogPost::findOrFail($request->id)->update([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description,
            'post_image' => $filename ?? $request->old_image,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Post Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.post')->with($notification);
    }


    public function deleteBlogPost($id)
    {

        $blogPost = BlogPost::findOrFail($id);
        unlink($blogPost->post_image);

        $blogPost->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

}
