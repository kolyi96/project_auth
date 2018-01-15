<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionsRepository;
use App\Repositories\RolesRepository;
use Gate;

class PermissionsController extends AdminController
{
    protected $perm_rep;
    protected $rol_rep;
    
    public function __construct(PermissionsRepository $perm_rep,RolesRepository $rol_rep)
    {
        parent::__construct();
        
        $this->perm_rep = $perm_rep;
        $this->rol_rep = $rol_rep;
        
    }
    public function canUseClass(){
        if(Gate::denies('EDIT_PERMISSIONS')){
            abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $this->canUseClass();
        $this->title = "Менеджер прав";
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();
        return view('admin.permissions')->with(['roles'=>$roles,'perm'=>$permissions])->withTitle($this->title)->render();
    }
    
    public function getRoles()
    {
        $roles = $this->rol_rep->get();
        return $roles;
    }
    
    public function getPermissions()
    {
        $permissions = $this->perm_rep->get();
        return $permissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->perm_rep->changePermissions($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        
        return back()->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
