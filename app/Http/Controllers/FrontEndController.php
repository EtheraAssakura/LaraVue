<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class FrontEndController extends Controller
{
    public function index()
    {
        return Inertia::render('FrontEnd/Index');
    }

    public function detail()
    {
        return Inertia::render('FrontEnd/Detail');
    }
}
