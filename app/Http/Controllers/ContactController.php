<?php

namespace App\Http\Controllers;

use App\Model\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $contact = Contact::find(1);
            return response()->json([
                'contact'  => $contact
            ]);
        }
        return view('admin.pages.contact');
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
     * @param  \App\Model\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->update([
            'secretariat'   => $request['secretariat'],
            'youtube'       => $request['youtube'],
            'instagram'     => $request['instagram'],
            'email'         => $request['email'],
            'podcast'       => $request['podcast'],
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Contact Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }

    public function test(Request $request, $id){
        $contact = Contact::find($id);
        $contact->update([
            'secretariat'   => $request['secretariat'],
            'youtube'       => $request['youtube'],
            'instagram'     => $request['instagram'],
            'email'         => $request['email'],
            'podcast'       => $request['podcast'],
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Contact Updated'
        ]);
    }
}
