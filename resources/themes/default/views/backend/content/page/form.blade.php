@extends('layouts.backend')
@section('title',$page->id->value() ? $page->title : 'Създай нова страница')

<?php $data = $page->toArray(); ?>
@section('content')
	<a href="{{route('backend.content.page.index')}}" class="btn btn-success"><strong>Назад</strong></a>

	<br />

    {!! Form::model($page, [
		'method'=>$page->id->value()?'put':'post',
		'route'=>$page->id->value()?[fr('backend.content.page.update'),$page->id->value()]:[fr('backend.content.page.store')]
    ]) !!}
    <div class="form-group">
        {!! Form::label('title', 'Заглавие') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('uri','URI') !!}
        {!! Form::text('uri',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Име') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group row">
        <div class="col-md-12">{!! Form::label('template', 'Шаблон') !!}</div>
        <div class="col-md-4">
            {!! Form::select('template',$templates,null,['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">{!! Form::label('order', 'Ред') !!}</div>
        <div class="col-md-2">{!! Form::select('order',[
        ''=>'',
        'before'=>'преди',
        'after'=>'след',
        'childOf'=>'дете'
        ],null,['class'=>'form-control']) !!}</div>
        <div class="col-md-5">
            {!! Form::select('orderPage',$paddedPageTitleDropdownOptions,null,['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('content', 'Съдържание') !!}
        {!! Form::textarea('content',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::submit($page->id->value() ? 'Запази страница' : 'Създай нова страница', ['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
    <script>
        new SimpleMDE().render();
    </script>
@endsection