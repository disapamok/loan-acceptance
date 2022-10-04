<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function documentation()
    {
        return view('documentation.index');
    }

    public function testingIntro()
    {
        return view('testing.index');
    }
}
