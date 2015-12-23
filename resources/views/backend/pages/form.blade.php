@extends('layouts.backend')
@section('title',$page->exists?$page->title:'Create new page')


@section('content')
    {!! Form::model($page,[
    'method'=>$page->exists?'put':'post',
    'route'=>$page->exists?['backend.pages.update',$page->id]:['backend.pages.store']
    ]) !!}
    <div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('uri','URI') !!}
        {!! Form::text('uri',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group row">
        <div class="col-md-12">{!! Form::label('template') !!}</div>
        <div class="col-md-4">
            {!! Form::select('template',$templates,null,['class'=>'form-control']) !!}
        </div>
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
            {!! Form::select('orderPage',[''=>'']+$orderPages->lists('padded_title','id')->toArray(),null,['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('content') !!}
        {!! Form::textarea('content',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::submit($page->exists?'Save page':'Create new page',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
    <script>
        new SimpleMDE().render();
    </script>
@endsection