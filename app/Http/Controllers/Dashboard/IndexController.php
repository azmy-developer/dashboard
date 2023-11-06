<?php

namespace App\Http\Controllers\Dashboard;
use App;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    protected function index(){

        return view('dashboard.home');
    }


    public function changeLanguage()
    {
        $lang = request()->query('locale');
        App::setLocale($lang);
        Session::put('locale', $lang);
        LaravelLocalization::setLocale($lang);
        $url = LaravelLocalization::getLocalizedURL(App::getLocale(), \URL::previous());
        return Redirect::to($url);
    }



}
