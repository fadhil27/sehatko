<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategorySelectedResource;
use App\Model\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $category = CategoryResource::collection(Category::orderBy('id','DESC')->get());
            return DataTables::of($category)
                ->addIndexColumn()
                ->addColumn('action', function($category){
                    return '<div  style="text-align: center;">
                    <button onclick="viewCategory('.$category['id'].')" type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i></button> ' . ' ' . '
                    <button onclick="editCategory('.$category['id'].')" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button> ' . ' ' . '
                    <button onclick="deleteCategory('.$category['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.category');
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
        Category::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Category Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'category'  => new CategorySelectedResource($category)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'category'  => new CategorySelectedResource($category)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Category Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->blogs->isEmpty()){
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category Deleted',
                'type'    => 'success',
                'title'   => 'Success'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Category Deleted Failed, Delete All Binding This Category',
            'type'    => 'error',
            'title'   => 'Oops...'
        ]);
    }
}
