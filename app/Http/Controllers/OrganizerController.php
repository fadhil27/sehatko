<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizerResource;
use App\Model\Organizer;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class OrganizerController extends Controller
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
            $organizer = OrganizerResource::collection(Organizer::orderBy('id','DESC')->get());

            return DataTables::of($organizer)
                ->addIndexColumn()
                ->addColumn('action', function($organizer){
                    return '<div  style="text-align: center;">
                    <button id="view-button" onclick="viewOrganizer('.$organizer['id'].')" type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i></button> ' . ' ' . '
                    <button id="edit-button" onclick="editOrganizer('.$organizer['id'].')" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button> ' . ' ' . '
                    <button onclick="deleteOrganizer('.$organizer['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.organizer');
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

        if($request->hasFile('photo') || $request->hasFile('photo') && $request->hasFile('photo2')){
            if($input['team_category'] == 'presidium') {
                if($request->hasFile('photo')){
                    $input['photo'] = $this->uploadImage($request, 'organizer', 'photo');
                }
            } else if($input['team_category'] == 'division') {
                if($request->hasFile('photo') && $request->hasFile('photo2')){
                    $image1 = $this->uploadImage($request, 'organizer', 'photo');
                    $image2 = $this->uploadImage($request, 'organizer', 'photo2');
                    $image = array($image1, $image2);
                    $input['photo'] = json_encode($image);
                }
            }
        }
        Organizer::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Organizer Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organizer = Organizer::findOrFail($id);
        if ($organizer->team_category == 'division') {
            $photo = json_decode($organizer->photo);
            $organizer->photo = $photo[0];
        }
        return $organizer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organizer = Organizer::findOrFail($id);
        if ($organizer->team_category == 'division') {
            $photo = json_decode($organizer->photo);
            $organizer->photo = $photo[0];
        }
        return $organizer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $organizer = Organizer::findOrFail($id);
        $input['photo'] = $organizer->photo;
        if($request->hasFile('photo') && $request->hasFile('photo2')){
            // $input['photo'] = $this->updateImage($request, $organizer->photo, 'organizer', 'photo');
            if($organizer->team_category == 'presidium') {
                $this->deleteImage($organizer->photo, 'organizer');
                $input['photo'] = $this->uploadImage($request, 'organizer', 'photo');
            } else if($organizer->team_category == 'division') {    
                $photo = json_decode($organizer->photo);
                foreach($photo as $p) {
                    $this->deleteImage($p, 'organizer');
                }
                $image1 = $this->uploadImage($request, 'organizer', 'photo');
                $image2 = $this->uploadImage($request, 'organizer', 'photo2');
                $image = array($image1, $image2);
                $input['photo'] = json_encode($image);
            }
        }
        $organizer->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Organizer Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organizer = Organizer::findOrFail($id);
        if($organizer->photo != NULL){
            if($organizer->team_category == 'presidium') {
                $this->deleteImage($organizer->photo, 'organizer');
            } else if($organizer->team_category == 'division') {
                $photo = json_decode($organizer->photo);
                foreach($photo as $p) {
                    $this->deleteImage($p, 'organizer');
                }
            }
        }

        Organizer::destroy($id);
        return response()->json([
            'success'   => true
        ]);
    }
}
