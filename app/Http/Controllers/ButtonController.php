<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ButtonController extends Controller
{
    public function index()
    {
        return view('button');
    }

    public function route1()
    {
        return "This is Route 1";
    }

    public function route2()
    {
        return "This is Route 2";
    }

    public function route3()
    {
        return "This is Route 3";
    }

    public function searchPage()
    {
        return view('search');
    }
}
