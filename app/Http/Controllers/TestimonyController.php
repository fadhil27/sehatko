<?php

namespace App\Http\Controllers;

use App\Model\Testimony;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestimonyController extends Controller
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
            $testimony = Testimony::orderBy('id','DESC')->get();

            return DataTables::of($testimony)
                ->addIndexColumn()
                ->addColumn('action', function($testimony){
                    return '<div  style="text-align: center;">
                    <button onclick="viewGallery('.$testimony['id'].')" type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i></button> ' . ' ' . '
                    <button onclick="editGallery('.$testimony['id'].')" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button> ' . ' ' . '
                    <button onclick="deleteGallery('.$testimony['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.testimony');
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
        $input['photo'] = null;
        if($request->hasFile('photo')){
            $input['photo'] = $this->uploadImage($request, 'testimony', 'photo');
            // $input['background_image'] = 'genbiUH.png';
        }
        Testimony::create($input);
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
        $testimony = Testimony::findOrFail($id);
        return $testimony;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimony = Testimony::findOrFail($id);
        return $testimony;
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
        $testimony = Testimony::findOrFail($id);
        $input['photo'] = $testimony->photo;
        if($request->hasFile('image')){
            $input['photo'] = $this->updateImage($request, $testimony->photo, 'testimony', 'image');
        }
        $testimony->update($input);

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
        $testimony = Testimony::findOrFail($id);
        if($testimony->photo != NULL){
            $this->deleteImage($testimony->photo, 'testimony');
        }

        Testimony::destroy($id);
        return response()->json([
            'success'   => true
        ]);
    }
}
