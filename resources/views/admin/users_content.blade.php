@section('table_users')
<div class="hentry group">
                                
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
@endsection