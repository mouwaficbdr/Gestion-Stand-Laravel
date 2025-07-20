<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stands = Stand::with(['user', 'products'])
            ->where('status', 'active')
            ->whereHas('user', function ($query) {
                $query->where('status', 'approved');
            })
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact('stands'));
    }

    public function stands()
    {
        $stands = Stand::with(['user', 'products'])
            ->where('status', 'active')
            ->whereHas('user', function ($query) {
                $query->where('status', 'approved');
            })
            ->paginate(12);

        return view('stands.index', compact('stands'));
    }

    public function showStand(Stand $stand)
    {
        if ($stand->status !== 'active' || !$stand->user->isApproved()) {
            abort(404);
        }

        $stand->incrementViews();
        $stand->load(['user', 'products']);

        return view('stands.show', compact('stand'));
    }
}