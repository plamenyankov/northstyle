@extends('layouts.backend')
@section('title','Потребители')


@section('content')
    <a href="{{route('backend.users.create')}}" class="btn btn-primary">Create new user</a>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="{{route('backend.users.edit',$user->id)}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td><a href="{{route('backend.users.edit',$user->id)}}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td>
                    <a href="{{lr('/backend/users/'.$user->id.'/confirm')}}">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>
            </tr>
        @endforeach    
        </tbody>
    </table>
    {!! $users->render() !!}
@endsection