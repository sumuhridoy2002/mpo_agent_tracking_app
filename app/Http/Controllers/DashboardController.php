<?php

namespace App\Http\Controllers;

use App\Traits\AuthUserTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use AuthUserTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'superadmin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard', ['authUser' => $this->AuthUser()]);
    }
}
