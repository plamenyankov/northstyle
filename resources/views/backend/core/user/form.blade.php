@extends('layouts.backend')
@section('title',$user->id->value()?'Edit':'Create new user')


@section('content')
{!! Form::model($user,[
	'method'=>$user->id->value()?'put':'post',
	'route'=>$user->id->value()?[fr($base . 'update'),$user->id]:[fr($base . 'store')]
]) !!}
<div class="form-group">
    {!! Form::label('name', 'Име') !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email') !!}
    {!! Form::text('email',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password', 'Парола') !!}
    {!! Form::password('password',['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', 'Потвърди Парола') !!}
    {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
</div>
{!! Form::submit($user->id->value()?'Запази Потребител':'Създай Нов Потребител',['class'=>'btn btn-primary']) !!}

{!! Form::close() !!}
@endsection