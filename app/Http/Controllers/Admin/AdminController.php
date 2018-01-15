<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class AdminController extends Controller
{
    protected $user;
    protected $template;
    protected $content = false;
    protected $title;
    protected $vars;
    
    public function __construct(){
        /*$this->user = Auth::user();
        if(!$this->user){
            abort(403);
        }*/
        $this->middleware('auth');
    }
}
