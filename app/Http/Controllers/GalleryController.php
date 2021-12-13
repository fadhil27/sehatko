<?php

namespace App\Http\Controllers;

use App\Model\Gallery;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
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
            $gallery = Gallery::orderBy('id','DESC')->get();

            return DataTables::of($gallery)
                ->addIndexColumn()
                ->addColumn('action', function($gallery){
                    return '<div  style="text-align: center;">
                    <button onclick="viewGallery('.$gallery['id'].')" type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i></button> ' . ' ' . '
                    <button onclick="editGallery('.$gallery['id'].')" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button> ' . ' ' . '
                    <button onclick="deleteGallery('.$gallery['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.gallery');
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
        $input = $request->all();
        $input['image'] = null;
        if($request->hasFile('image')){
            $input['image'] = $this->uploadImage($request, 'gallery', 'image');
            // $input['background_image'] = 'genbiUH.png';
        }
        Gallery::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Gallery Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return $gallery;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return $gallery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $gallery = Gallery::findOrFail($id);
        $input['image'] = $gallery->image;
        if($request->hasFile('image')){
            $input['image'] = $this->updateImage($request, $gallery->background_image, 'gallery', 'image');
        }
        $gallery->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Main Background Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if($gallery->image != NULL){
            $this->deleteImage($gallery->image, 'gallery');
        }

        Gallery::destroy($id);
        return response()->json([
            'success'   => true
        ]);
    }
}
