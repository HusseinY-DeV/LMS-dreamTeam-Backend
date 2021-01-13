<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function allSections(Request $request)
    {
    }

    public function oneSection(Request $request, $id)
    {
        return $id;
    }

    public function oneStudent(Request $request, $id)
    {
        return -1;
    }
}
