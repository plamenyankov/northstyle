@extends('layouts.backend')
@section('title','Delete '.$category->title)


@section('content')
    {!! Form::open(['method'=>'delete','route'=>[fr('backend.category.destroy'),$category->id]]) !!}
    <div class="alert alert-danger">
        <strong>Внимание!</strong> Ти си напът да изтриеш категория? Това действие е необратимо?
    </div>
    {!! Form::submit('Да, изтрии тази категория!',['class'=>'btn btn-danger']) !!}
    <a href="{{route('backend.category.index')}}" class="btn btn-success"><strong>Не, махам се от тук!</strong></a>
    {!! Form::close() !!}
@endsection