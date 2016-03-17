@extends('layouts.backend')
@section('title','Потвърждение за изтриване на магазин')

@section('content')
    {!! Form::open(['method'=>'delete','route'=>[fr('backend.shop.store.destroy'),$item->id]]) !!}
    <div class="alert alert-danger">
        <strong>Внимание!</strong> Този магазин ще бъде изтрит. Това действие е крайно. Сигурни ли сте?
    </div>
    {!! Form::submit('Да, трий!',['class'=>'btn btn-danger']) !!}
    <a href="{{route('backend.shop.store.index')}}" class="btn btn-success"><strong>Не</strong></a>
    {!! Form::close() !!}
@endsection