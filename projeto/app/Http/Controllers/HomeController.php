<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pessoa;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qtde = [
            'usuarios'=> User::count(),
            'pessoas' => Pessoa::count()
        ];
        return view('home', compact('qtde'));
    }
}
