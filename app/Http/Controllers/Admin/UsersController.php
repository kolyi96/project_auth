<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Repositories\UsersRepository;
use App\Repositories\RolesRepository;
use Gate;
use App\User;
use Mail;
use Validator;
use Form;
use View;

class UsersController extends AdminController
{
    protected $us_rep;
    protected $rol_rep;
    
    public function __construct(UsersRepository $user_rep,RolesRepository $rol_rep)
    {
        parent::__construct();
        
        $this->rol_rep= $rol_rep;
        $this->us_rep = $user_rep; 
    }
    
    //***INDEX***//
    public function index(){
        $this->canUseClass();
        
        $this->title = "Пользователи";
        $users = $this->getUsers(); 
        if(view()->exists('admin.users')){
            return view('admin.users')->with(['users'=>$users])->withTitle($this->title);
        }
    }
    public function getUsers()
    {
        $users = $this->us_rep->get();
        return $users;
    }
    
    //***ADD**//
    public function create(){
        
        if($this->canUseClass('ajax'))
            return response()->json(array('status'=>'error','msg'=> "У Вас нет прав"),200);
            
        $this->title = "Создание нового пользователя";  
        
        $roles = $this->getRoles()->reduce(function($returnRoles,$role){
            $returnRoles[$role->id] = $role->name;
            return $returnRoles; 
        },[]);
        //return view('admin.user_create')->with('roles',$roles)->render();
        //$view = view('admin.user_create')->with('roles', $roles)->render();
        //return view('admin.user_create', ['roles'=>$roles])->renderSections()['content'];
        
        $view = View::make('admin.user_create')->with('roles', $roles);
        $sections = $view->renderSections(); 
         return json_encode($sections); 
    }
    
    public function getRoles(){
        return \App\Role::all();
    }
    
    /*
    public function store(UserRequest $request){
        $result = $this->us_rep->addUser($request);
        
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('admin/users')->with($result);
    }
    */
    public function store(Request $request){
        if($this->canUseClass('ajax'))
            return response()->json(array('status'=>'error','msg'=> "У Вас нет прав"),200);
            
        $validator =$this->validationData($request->all(),null);
        
        if ($validator->fails()){
            $arr_er = '';
            foreach ($validator->errors()->all() as  $value) {
                 $arr_er.=$value.'<br/>';
            }
            return response()->json(array('status'=>'error','msg'=> $arr_er),200);
        }
        
        $result = $this->us_rep->addUser($request);
        
        if(is_array($result) && !empty($result['error'])){
            return response()->json(array('status'=>'error','msg'=> $result),200);
        }
        
        return response()->json(array('status'=>'ok','msg'=> 'Пользователь добавлен'), 200);
    }
    
    //***EDIT**//
    public function edit(User $user){
        if($this->canUseClass('ajax'))
            return response()->json(array('status'=>'error','msg'=> "У Вас нет прав"),200);
            
        $this->title = 'Редактирование пользователя - '.$user->name;
        $roles = $this->getRoles()->reduce(function($returnRoles,$role){
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        },[]);
        //return view('admin.user_create')->withTitle($this->title)->with(['roles'=>$roles,'user_edit'=>$user])->render(); 
        
        
        $view = View::make('admin.user_create')->with(['roles'=> $roles,'user_edit'=>$user]);
        $sections = $view->renderSections(); 
         return json_encode($sections); 
    }
    
    /*public function update(UserRequest $request,User $user){
        $result = $this->us_rep->updateUser($request,$user);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('admin/users')->with($result);
    }*/
    
    public function update(Request $request,User $user){
         if($this->canUseClass('ajax'))
            return response()->json(array('status'=>'error','msg'=> "У Вас нет прав"),200);
            

        $validator =$this->validationData($request->all(),$user->id);
        
        if ($validator->fails()){
            $arr_er = '';
            foreach ($validator->errors()->all() as  $value) {
                 $arr_er.=$value.'<br/>';
            }
            return response()->json(array('status'=>'error','msg'=> $arr_er),200);
        }
        $result = $this->us_rep->updateUser($request,$user);
        if(is_array($result) && !empty($result['error'])){
            return response()->json(array('status'=>'error','msg'=> ''), 200);
        }
        
        return response()->json(array('status'=>'ok','msg'=> 'Пользователь изменен'), 200);
    }
    
    
    //***DELETE**//
    
    public function destroy(User $user){
        $result = $this->us_rep->deleteUser($user);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return response()->json(array('status'=>'ok','msg'=> 'Пользователь удален'), 200);
    }
    
    //////////**************************************************
    public function validationData($input, $user_id){
        $message = [
             'name.required' => 'Поле Имя должно быть заполнено',
             'name.max' => 'Поле Имя должно иметь не больше 255 символов',
             'role_id.required' => 'Поле Роль должно быть заполнено',
             'role_id.integer' => 'Поле Роль должно содержать только целые числа',
             'email.required' => 'Поле Email должно быть заполнено',
             'email.max' => 'Поле Имя должно иметь не больше 255 символов',
             'email.unique' => 'Такой email адрес уже существует',
             'email.email' => 'Поле email не похоже на нормальный email адрес',
             'password.required' => 'Поле Пароль должно быть заполнено',
             'password.min' => 'Поле Пароль должно иметь больше 6 символов',
             'password.confirmed' => 'Поля паролей должны совпадать',
        ];
        if(isset($user_id)){
            
            $validator = Validator::make($input, [
                 'name' => 'required|max:255',
    			 'role_id' => 'required|integer',
                 'email' => 'required|email|max:255|unique:users,email,'.$user_id
            ],$message);
            $validator->sometimes('password', 'required|min:6|confirmed', function($input){
    			if(!empty($input->password)) {
    				return TRUE;
    			}
    			return FALSE;
    	    });
            return $validator;
        }
        else{
            return Validator::make($input, [
                 'name' => 'required|max:255',
    			 'role_id' => 'required|integer',
                 'email' => 'required|email|max:255|unique:users,email,',//.$id
                 'password'=> 'required|min:6|confirmed'
            ],$message);
        }
    }
    
    public function canUseClass($method=""){
        if($method == 'ajax' && Gate::denies('EDIT_USERS')){
            return false;
        }
        else if(Gate::denies('EDIT_USERS')){
            abort(403);
        }
    }
    
    public function getRolesForPage($id = false){
        if($id){
            $user_edit = Auth::find($id);
        }
        
        $roles = $this->getRoles()->reduce(function($returnRoles,$role){
            $returnRoles[$role->id] = $role->name;
            return $returnRoles; 
        },[]);
       
       $ar_roles = ''; $i=1;
        foreach($roles as $role){
            $ar_roles.='<option value="'.$i.'">'.$role.'</option>'; 
            $i++;
        }
        return response()->json(array('status'=>'ok','content'=> $ar_roles), 200);
    }
    
    public function getTableUsers(){
        $this->canUseClass();
        
        $users = $this->getUsers(); 
        
        $view = View::make('admin.users_content')->with(['users'=>$users]);
        $sections = $view->renderSections(); 
         return json_encode($sections); 
    }
    
    
}

