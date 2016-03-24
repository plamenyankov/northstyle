@extends('layouts.backend')
@section('title','Потвърждение за изтриване на страница')


@section('content')
    {!! Form::open(['method'=>'delete','route'=>[fr('backend.content.page.destroy'),$page->id]]) !!}
    <div class="alert alert-danger">
        <strong>Внимание!</strong> Страницата ще бъде изтрита. Това действие е крайно. Сигурни ли сте?
    </div>
    {!! Form::submit('Да, трий!',['class'=>'btn btn-danger']) !!}
    <a href="{{route('backend.content.page.index')}}" class="btn btn-success"><strong>Не</strong></a>
    {!! Form::close() !!}
@endsection