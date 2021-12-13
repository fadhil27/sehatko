<?php

namespace App\Http\Controllers;

use App\Http\Resources\InboxResource;
use App\Model\Inbox;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $inbox = InboxResource::collection(Inbox::orderBy('id','DESC')->get());
            return DataTables::of($inbox)
                ->addIndexColumn()
                ->addColumn('action', function($inbox){
                    return '<div style="text-align: center;"><button onclick="viewInbox('.$inbox['id'].')" type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i></button>' . ' ' . '
                    <button onclick="deleteInbox('.$inbox['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.inbox');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inbox = Inbox::findOrFail($id);

        return $inbox;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Inbox $inbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inbox $inbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inbox::destroy($id);
    }
}
