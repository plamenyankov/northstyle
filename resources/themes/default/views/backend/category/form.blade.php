@extends('layouts.backend')
@section('title',$category->exists?$category->title:'Създай нова категория')


@section('content')
    {!! Form::model($category,[
    'method'=>$category->exists?'put':'post',
    'route'=>$category->exists?[fr('backend.category.update'),$category->id]:[fr('backend.category.store')]
    ]) !!}
    <div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>


    <div class="for-group row">
        <div class="col-md-12">{!! Form::label('order') !!}</div>
        <div class="col-md-2">{!! Form::select('order',[
        ''=>'',
        'before'=>'before',
        'after'=>'after',
        'childOf'=>'childOf'
        ],null,['class'=>'form-control']) !!}</div>
        <div class="col-md-5">
            {!! Form::select('orderCategory',[''=>'']+$orderCategory->lists('padded_title','id')->toArray(),null,['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('content') !!}
        {!! Form::textarea('content',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::submit($category->exists?'Запази категория':'Създай нова категория',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
    <script>
        new SimpleMDE().render();
    </script>
@endsection