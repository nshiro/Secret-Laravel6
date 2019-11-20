<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 管理者画面TOPを表示
     */
    public function index()
    {
        return view('admin.index');
    }
}
