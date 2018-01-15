@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title }}</div>

                <div class="panel-body">
                    
                    
                    
                    <div id="content-page" class="content group">
				            <div class="hentry group">
                                
                                <div class="short-table white">
                                	<table style="width: 100%" cellspacing="0" cellpadding="0" class="table-striped text-center table-bordered">
                                	<tr>
                                		<th class="text-center">ID</th>
                                		<th class="text-center">Имя</th>
                                		<th class="text-center">Email</th>
                                		<th class="text-center">Пользователь</th>
                                        <th class="text-center">ID реферала</th>
                                        <th class="text-center">Соц. сети</th>
                                		<th class="text-center">Действие</th>
                                	</tr>
                                	@if($users)
                                		
                                		
                                		@foreach($users as $user)
                                		<tr>
                                			<td>{{ $user->id }}</td>
                                			<td><a onclick="editUser({{$user->id}})" id="user-{{$user->id}}" style="cursor: pointer;">{{$user->name}}</a></td>
                                			<td>{{ $user->email }}</td>
                                			<td>{{ $user->roles->implode('name', ', ') }}</td>
                                            <td>
                                                @if($user->friend_id)
                                                    {{$user->friend_id}}
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            
                                            <td>
                                                @if($user->socialProviders())
                                                    @foreach($user->socialProviders()->get() as $social)
                                                        {{$social->provider}}<br>
                                                    @endforeach
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            
                                			<td>
                                			
                                                <button class="btn btn-link" onclick="deleteUser({{$user->id}})" style="cursor: pointer;">Удалить</button>
                                			</td>
                                		</tr>										
                                		@endforeach
                                		
                                	@endif
                                	</table>
                                	</div>
                                    <br />
                                    <button class="btn btn-success" class="testClass" id="user-modal" style="float: left;" onclick="addUser(1)">Добавить  пользователя </button> <div id="loadImgAddUser" class="loadImg hidden"></div>
                                	
                            </div>
                        </div>
                    <!------>
                                
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close_form">Отменить</button>
        <button type="button" class="btn btn-primary" id="send_form">Сохранить</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal two -->
<div id="myModalRemove" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-danger">Внимание!</h4>
      </div>
      <div class="modal-body text-danger">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close_form">Отменить</button>
        <button type="button" class="btn btn-primary" id="agreeRemoveUser">Да</button>
      </div>
    </div>

  </div>
</div>
@endsection