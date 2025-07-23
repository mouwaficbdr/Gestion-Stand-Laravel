<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stand;

class StandController extends Controller
{
    public function index()
    {
        $stands = Stand::all();
        return view('stands.index', compact('stands'));
    }
}
