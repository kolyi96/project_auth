<?php

namespace App\Http\Controllers\Admin;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends AdminController
{
    public function __construct(){
        parent:: __construct();
        
    }
    
    public function index(){
        if(Gate::denies('VIEW_ADMIN')){
            abort(403);
        }
        //dump(\App\Role::all()->firstWhere('name', 'Гость'));
        
        $this->title = 'Панель администратора';
        if(view()->exists('admin.index')){
            return view('admin.index')->withTitle($this->title);
        }
    }
}
