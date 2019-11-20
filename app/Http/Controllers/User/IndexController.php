<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * ユーザー画面TOPを表示
     */
    public function index()
    {
        return view('user.index');
    }
}
