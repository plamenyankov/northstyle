@extends('layouts.auth')
@section('title','Нова парола')
@section('heading','Запишете вашата нова парола')

@section('content')
    {!! Form::open() !!}
    {!! Form::hidden('token',$token) !!}
    <div class="form-group">
        {!! Form::label('email') !!}
        {!! Form::text('email',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation') !!}
        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
    </div>
    {!! Form::submit('Поднови парола',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@endsection

