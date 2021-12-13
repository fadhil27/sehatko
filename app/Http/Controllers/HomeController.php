<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgendaHomeResource;
use App\Model\Agenda;
use App\Model\Blog;
use App\Model\Category;
use App\Model\Gallery;
use App\Model\Inbox;
use App\Model\Jumbotron;
use App\Model\Organizer;
use App\Model\Scholarship;
use App\Model\Testimony;
use App\Model\Youtube;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $jumbotrons = Jumbotron::all();
        $latestBlog = Blog::skip(0)->take(2)->orderBy('id','DESC')->get();
        $latestVideo = Youtube::skip(0)->take(4)->orderBy('id','DESC')->get();
        $latestImage = gallery::skip(0)->take(4)->orderBy('id','DESC')->get();

        return view('home.pages.home', [
            'jumbotrons'    => $jumbotrons,
            'latestBlog'    => $latestBlog,
            'latestImage'    => $latestImage,
            'latestVideo'   => $latestVideo,
            'title'         => 'Sehatko | Home'
        ]);
    }

    public function about(){
        $testimonies = Testimony::orderBy('id','desc')->get();
        return view('home.pages.about',[
            'title'         => 'Sehatko | About Us',
            'testimonies'   => $testimonies
        ]);
    }

    public function coreTeam(){
        $chief = Organizer::where('team_category', 'presidium')->skip(0)->take(1)->get();
        $presidium = Organizer::where('team_category', 'presidium')->skip(1)->take(Organizer::count())->get();

        $divisions = Organizer::where('team_category', 'division')->get();

        return view('home.pages.core_team', [
            'chief'         => $chief,
            'presidium'     => $presidium,
            'divisions'      => $divisions,
            'title'         => 'Sehatko | Core-team'
        ]);
    }

    public function gallery(){
        $galleries = Gallery::orderBy('id','desc')->get();

        return view('home.pages.gallery', [
            'galleries'     => $galleries,
            'title'         => 'Sehatko | Gallery'
        ]);
    }

    public function agenda(){
        // $agendas = AgendaHomeResource::collection(Agenda::all()); 
        // return response()->json($agendas);
        return view('home.pages.agenda',[
            'title'         => 'Sehatko | Agenda'
        ]);
    }

    public function agendaList(){
        $agendas = AgendaHomeResource::collection(Agenda::all()); 
        return response()->json($agendas);
    }

    public function youtube(){
        $youtubes = Youtube::orderBy('id','desc')->get();
        
        return view('home.pages.youtube', [
            'youtubes'      => $youtubes,
            'title'         => 'Sehatko | Videos'
        ]);
    }

    public function blogList($category){
        $checkExistCategory = Category::where('category_name', $category)->first();
        if($checkExistCategory == NULL){
            abort(404);
        }
        // $count = Blog::whereHas('category', function($query) use($category){
        //     return $query->where('category_name', $category);
        // })->count();

        // $mainBlog = Blog::whereHas('category', function($query) use($category){
        //     return $query->where('category_name', $category);
        // })->skip(0)->take(1)->first();

        $blogList = Blog::whereHas('category', function($query) use($category){
            return $query->where('category_name', $category);
        })->orderBy('id', 'DESC')->paginate(6);

        // dd($mainBlog, $blogList);
        return view('home.pages.blog_list', [
            // 'mainBlog'  => $mainBlog,
            'blogList'  => $blogList,
            'category'  => ucfirst($category),
            'title'         => 'Sehatko | Blog List'
        ]);
    }

    public function blogListAll(){
        $blogList = Blog::orderBy('id','DESC')->paginate(6);
        return view('home.pages.blog_list', [
            'blogList'  => $blogList,
            'category'  => 'Semua Kategori',
            'title'         => 'Sehatko | Blog List'
        ]);
    }

    public function singleBlog($category, $title){
        $checkExistCategory = Category::where('category_name', $category)->first();
        $checkExistTitle = Blog::where('title', $title)->first();
        if($checkExistCategory == NULL || $checkExistTitle == NULL){
            abort(404);
        }
        $blog = Blog::whereHas('category', function($query) use($category){
            return $query->where('category_name', $category);
        })->where('title',$title)->first();
        $relatedBlog = Blog::whereHas('category', function($query) use($category){
            return $query->where('category_name', $category);
        })->where('id','!=',$blog->id)->orderBy('id','DESC')->skip(0)->take(2)->get();

        return view('home.pages.blog',[
            'blog'          => $blog,
            'relatedBlogs'   => $relatedBlog,
            'title'         => 'Sehatko | ' . $blog->title
        ]);
    }

    public function contactUs(){
        return view('home.pages.contact_us',[
            'title'         => 'Sehatko | Contact Us'
        ]);
    }

    public function sendMessage(Request $request){
        Inbox::create([
            'name'              => $request['name'],
            'email'             => $request['email'],
            'phone_number'      => $request['phone_number'],
            'message_content'   => $request['message_content'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message has been sent, please wait for a reply soon 😃'
        ]);
    }

    public function scholarship(){
        $scholarship = Scholarship::find(1);
        return view('home.pages.scholarship', [
            'scholarship'   => $scholarship,
            'title'         => 'Sehatko | Gallery'
        ]);
    }
}
