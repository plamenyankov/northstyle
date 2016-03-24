@extends('layouts.backend')
@section('title','Delete '.$user->name)


@section('content')
{!! Form::open(['method'=>'delete','route'=>[fr($base . 'destroy'),$user->id]]) !!}
<div class="alert alert-danger">
    <strong>Warning!</strong> Потребителят ще бъде изтрит. Това действие не може да бъде отменено. Сигурни ли сте?
</div>
{!! Form::submit('Да!',['class'=>'btn btn-danger']) !!}
<a href="{{route($base . 'index')}}" class="btn btn-success"><strong>Не, върни ме обратно.</strong></a>
{!! Form::close() !!}
@endsection