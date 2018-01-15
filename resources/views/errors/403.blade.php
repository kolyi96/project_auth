@extends('layouts.app')

@section('content')
<style>
.error-template {padding: 40px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template text-center">
                <h1>
                    Оопс!</h1>
                <h2>
                    403 Нет прав</h2>
                <div class="error-details">
                    Простите, у Вас нет прав просматривать эту страницу...
                </div>
                <div class="error-actions">
                    <br />
                    <a href="{{ route('index') }}" class="btn btn-primary btn-lg">Go home </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection