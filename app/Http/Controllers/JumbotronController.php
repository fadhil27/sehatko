<?php

namespace App\Http\Controllers;

use App\Model\Jumbotron;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JumbotronController extends Controller
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
            $jumbotron = Jumbotron::orderBy('id','DESC')->get();

            return DataTables::of($jumbotron)
                ->addIndexColumn()
                ->addColumn('action', function($jumbotron){
                    return '<div  style="text-align: center;">
                    <button onclick="editJumbotron('.$jumbotron['id'].')" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button> ' . ' ' . '
                    <button onclick="deleteJumbotron('.$jumbotron['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.mainBackground');
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
        $input['background_image'] = null;
        if($request->hasFile('background_image')){
            $input['background_image'] = $this->uploadImage($request, 'backgroundImage', 'background_image');
            // $input['background_image'] = 'genbiUH.png';
        }
        Jumbotron::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Main Background Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Jumbotron  $jumbotron
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jumbotron = Jumbotron::findOrFail($id);
        return $jumbotron;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Jumbotron  $jumbotron
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jumbotron = Jumbotron::findOrFail($id);
        return $jumbotron;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Jumbotron  $jumbotron
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $jumbotron = Jumbotron::findOrFail($id);
        $input['background_image'] = $jumbotron->background_image;
        if($request->hasFile('background_image')){
            $input['background_image'] = $this->updateImage($request, $jumbotron->background_image, 'backgroundImage', 'background_image');
        }
        $jumbotron->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Main Background Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Jumbotron  $jumbotron
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jumbotron = Jumbotron::findOrFail($id);
        if($jumbotron->background_image != NULL){
            $this->deleteImage($jumbotron->background_image, 'backgroundImage');
        }

        Jumbotron::destroy($id);
        return response()->json([
            'success'   => true
        ]);
    }
}
