<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $title = 'FAQ';
        return view('faq.index', compact('title'));
    }
}
