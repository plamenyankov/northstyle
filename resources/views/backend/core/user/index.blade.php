@extends('layouts.backend')
@section('title','Потребители')

@section('content')
    <a href="{{route($base . 'create')}}" class="btn btn-primary">Създай нов потребител</a>

	@if (count($users))
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Име</th>
            <th>E-mail</th>
            <th>Редактирай</th>
            <th>Изтрий</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="{{route($base . 'edit',$user->id->value())}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td><a href="{{route($base . 'edit',$user->id->value())}}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td>
                    <a href="{{route($base . 'confirm_delete', $user->id->value())}}">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
	
	{!! $paginate->render() !!}

	@else 
		<div class="alert-info">Няма съществуващи потребители.</div>
	@endif
@endsection