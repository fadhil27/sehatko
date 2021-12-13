<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Model\Blog;
use App\Model\Category;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $blog = BlogResource::collection(Blog::orderBy('id','DESC')->get());

            return DataTables::of($blog)
                ->addIndexColumn()
                ->addColumn('action', function($blog){
                    return '<div  style="text-align: center;">
                    <a href="/administrator/blog/'.$blog['id'].'/edit" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a> ' . ' ' . '
                    <button onclick="deleteBlog('.$blog['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.blog');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('admin.pages.blogForm', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required',
            'writer'            => 'required',
            'blog_image'        => 'required',
            'title'             => 'required',
            'content'           => 'required'
        ]);
            
        $input = $request->all();
        $input['blog_image'] = null;
        if($request->has('blog_image')){
            $input['blog_image'] = $this->uploadImage($request, 'blog_image', 'blog_image');
        }
        Blog::create($input);
        return redirect('/administrator/blog')->with('status','Data Has Been Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $data = [
            'blog'          => $blog,
            'categories'    => Category::orderBy('id','DESC')->get(),
            // 'gg'            => 'gg'
        ];
        return view('admin.pages.blogUpdate', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id'       => 'required',
            'writer'            => 'required',
            'blog_image'        => 'nullable',
            'title'             => 'required',
            'content'           => 'required'
        ]);

        $blog = Blog::findOrFail($id);
        $input = $request->all();
        $input['blog_image'] = $blog->blog_image;
        if($request->has('blog_image')){
            $input['blog_image'] = $this->updateImage($request, $blog->blog_image, 'blog_image', 'blog_image');
        }
        $blog->update($input);
        return redirect('/administrator/blog')->with('status','Data Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if($blog->blog_image != NULL){
            $this->deleteImage($blog->blog_image, 'blog_image');
        }

        Blog::destroy($id);
        return response()->json([
            'success'   => true
        ]);
    }
}
