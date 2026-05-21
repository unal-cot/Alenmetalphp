<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\SiteConfig;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'services' => Service::where('active', true)->orderBy('order')->get(),
            'projects' => Project::with('images')->where('active', true)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function services()
    {
        return view('pages.hizmetler', [
            'services' => Service::where('active', true)->orderBy('order')->get(),
        ]);
    }

    public function about()
    {
        return view('pages.kurumsal');
    }

    public function gallery()
    {
        return view('pages.galeri', [
            'projects' => Project::with('images')->where('active', true)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function privacy()
    {
        return view('pages.gizlilik-politikasi');
    }

    public function terms()
    {
        return view('pages.kullanim-kosullari');
    }
}
