
@section('content')

                    <div class="panel-body form-horizontal">

                                <div class="alert alert-danger hidden"></div>
                                <div class="alert alert-success hidden"></div>
                                <input  type="hidden" id="id_user" value="{{ isset($user_edit->id) ? $user_edit->id : '' }}"/>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Имя</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ isset($user_edit->name) ? $user_edit->name  : old('name') }}" required autofocus>
        
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail адрес</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ isset($user_edit->email) ? $user_edit->email  : old('login') }}" required>
        
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Пароль</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password">
        
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Повторите пароль</label>
        
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="role_id" class="col-md-4 control-label">Роль</label>
                                    
                            			<div class="col-md-6">
                            			
                            				{!! Form::select('role_id', $roles, (isset($user_edit)) ? $user_edit->roles()->first()->id : null,['class' => 'form-control']) !!}
                            			 </div>
                                </div>
                                
                                @if(isset($user_edit->id))
     			                    <input id="_method" type="hidden" name="_method" value="PUT">		
      		                    @endif
                            
                            
                            </div>
@endsection