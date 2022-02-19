<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        return view('site.index');
    }

    public function news()
    {
        return view('site.index');
    }

    public function newsDetail($news)
    {
        return view('site.index');
    }

    public function organizationProfile()
    {
        return view('site.index');
    }

    public function organizationRule()
    {
        return view('site.index');
    }

    public function organizationReport()
    {
        return view('site.index');
    }

    public function memberList()
    {
        return view('site.index');
    }

    public function memberRegister()
    {
        return view('site.index');
    }

    public function memberConstribution()
    {
        return view('site.index');
    }

    public function contact()
    {
        return view('site.contact');
    }
}
