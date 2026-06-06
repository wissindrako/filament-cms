<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing', [
            'settings'     => SiteSetting::pluck('value', 'key'),
            'services'     => Service::published()->get(),
            'projects'     => Project::published()->get(),
            'testimonials' => Testimonial::published()->get(),
        ]);
    }
}
