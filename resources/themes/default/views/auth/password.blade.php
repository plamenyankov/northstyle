
@extends('layouts.auth')
@section('title','Забравена парола')
@section('heading','Моля сложете вашия емайл за да подновим паролата');

@section('content')
    {!! Form::open() !!}
    <div class="form-group">
        {!! Form::label('email') !!}
        {!! Form::text('email',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::submit('Изпрати Линк',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@endsection

