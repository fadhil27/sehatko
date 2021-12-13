<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Model\Agenda;
use App\Model\Blog;
use App\Model\Organizer;
use App\Model\Youtube;
use App\Model\Gallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            // $admin = User::orderBy('id','DESC')->get();
            $admin = AdminResource::collection(User::orderBy('id','DESC')->get());
            return DataTables::of($admin)
                ->addIndexColumn()
                // ->addColumn('last_login', function($admin){
                //     return $admin->last_login_at->diffForHumans();
                // })
                // ->rawColumns(['last_login'])
                ->addColumn('action', function($admin){
                    return '<div style="text-align: center;"><button onclick="editAdmin('.$admin['id'].')"  type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button>'. ' ' . 
                        '<button onclick="deleteAdmin('.$admin['id'].')" type="button" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i></button></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.admin');
    }

    public function dashboard()
    {
        $count = [];
        $count['blog'] = count(Blog::all());
        $count['video'] = count(Youtube::all());
        $count['agenda'] = count(Agenda::all());
        $count['image'] = count(Gallery::all());
        $count['team'] = count(Organizer::all());
        return view('admin.pages.dashboard',compact('count'));
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
        User::create([
            'username'          => $request['username'],
            'password'          => Hash::make($request['password']),
            'role'              => $request['role'],
            'remember_token'    => Str::random(60)
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Admin Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($request->password == null){
            $user->update([
                'username'  => $request['username'],
                'role'      => $request['role'],
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Admin Updated'
            ]);
        }

        $user->update([
            'username'  => $request['username'],
            'role'      => $request['role'],
            'password'  => Hash::make($request['password'])
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Admin Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }

    // public function test(Request $request, $id){
    //     $user = User::find($id);
    //     if($request->password == null){
    //         $user->update([
    //             'username'  => $request['username'],
    //             'role'      => $request['role'],
    //         ]);
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Admin Updated'
    //         ]);
    //     }

    //     $user->update([
    //         'username'  => $request['username'],
    //         'role'      => $request['role'],
    //         'password'  => Hash::make($request['password'])
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Admin Updated'
    //     ]);
    // }
}
