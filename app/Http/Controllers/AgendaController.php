<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgendaResource;
use App\Model\Agenda;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $agenda = AgendaResource::collection(Agenda::orderBy('id','DESC')->get());
            return DataTables::of($agenda)
                ->addIndexColumn()
                ->addColumn('action', function($agenda){
                    return '<div  style="text-align: center;">
                    <button onclick="viewAgenda('.$agenda['id'].')" type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i></button> ' . ' ' . '
                    <button onclick="editAgenda('.$agenda['id'].')" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button> ' . ' ' . '
                    <button onclick="deleteAgenda('.$agenda['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.agenda');
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
        Agenda::create([
            'agenda_head'           => $request['agenda_head'],
            'agenda_description'    => $request['agenda_description'],
            'start_date'            => $request['start_date'],
            'end_date'              => $request['end_date'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Agenda Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        return $agenda;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return $agenda;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agenda = Agenda::find($id);
        $agenda->update([
            'agenda_head'           => $request['agenda_head'],
            'agenda_description'    => $request['agenda_description'],
            'start_date'            => $request['start_date'],
            'end_date'            => $request['end_date'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Agenda Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Agenda::destroy($id);
    }
}
