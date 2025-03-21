<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $title = 'Menu';
        return view('menu.index', compact('title'));
    }
}
