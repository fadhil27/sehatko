<?php

namespace App\Providers;

use App\Model\Category;
use App\Model\Contact;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        View::composer([
        'home.pages.about',
        'home.pages.agenda',
        'home.pages.blog_list',
        'home.pages.blog',
        'home.pages.core_team',
        'home.pages.gallery',
        'home.pages.home',
        'home.pages.organizer',
        'home.pages.single_blog',
        'home.pages.youtube',
        'home.pages.contact_us',
        'home.pages.scholarship'], function($view){
            $activeCategories = Category::has('blogs')->get();
            $view->with('blogCategories', $activeCategories);
        });

        View::composer([
        'home.pages.about',
        'home.pages.agenda',
        'home.pages.blog_list',
        'home.pages.blog',
        'home.pages.core_team',
        'home.pages.gallery',
        'home.pages.home',
        'home.pages.organizer',
        'home.pages.single_blog',
        'home.pages.youtube',
        'home.pages.contact_us',
        'home.pages.scholarship'], function($view){
            $contact = Contact::first();
            $view->with('contact', $contact);
        });
    }
}
