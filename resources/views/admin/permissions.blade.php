@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ Session::pull('status', 'default') }}
                        </div>
                    @endif
                    
                    <div id="content-page" class="content group">
                        <div class="hentry group">
                            <form action="{{ route('permissions') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="short-table white">
                                    <table style="width: 100%;">
                                        <thead>
                                            <th>Привилегии</th>
                                            @if(!$roles->isEmpty())
                                                @foreach($roles as $item)
                                                    <th>{{ $item->name}}</th>
                                                @endforeach
                                            @endif
                                        </thead>
                                        <tbody>
                                            @if(!$perm->isEmpty())
                                                @foreach($perm as $val)
                                                    <tr>
                                                        <td>{{$val->name}}</td>
                                                        @foreach($roles as $role)
                                                            <td>
                                                                @if($role->hasPermission($val->name))
                                                                    <input checked name="{{$role->id}}[]" type="checkbox" value="{{$val->id}}"/>
                                                                @else
                                                                    <input name="{{$role->id}}[]" type="checkbox" value="{{$val->id}}"/>
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                        
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <input class="btn btn-primary" type="submit" value="Обновить"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection