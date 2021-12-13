<?php

namespace App\Http\Controllers;

use App\Http\Resources\YoutubeResource;
use App\Model\Youtube;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class YoutubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $youtube = YoutubeResource::collection(Youtube::orderBy('id','DESC')->get());

            return DataTables::of($youtube)
                ->addIndexColumn()
                ->addColumn('action', function($youtube){
                    return '<div  style="text-align: center;">
                    <button onclick="viewYoutube('.$youtube['id'].')" type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i></button> ' . ' ' . '
                    <button onclick="editYoutube('.$youtube['id'].')" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button> ' . ' ' . '
                    <button onclick="deleteYoutube('.$youtube['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.youtube');
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
        Youtube::create([
            'title'     => $request['title'],
            'link'      => $request['link']
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Youtube Content Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $youtube = Youtube::findorFail($id);
        return $youtube;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $youtube = Youtube::findOrFail($id);
        return $youtube;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $youtube = Youtube::find($id);
        $youtube->update([
            'title' => $request['title'],
            'link' => $request['link'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Youtube Content Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Youtube  $youtube
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Youtube::destroy($id);
    }
}
