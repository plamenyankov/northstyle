@extends('layouts.backend')
@section('title','Blog posts')


@section('content')
    <a href="{{route('backend.blog.create')}}" class="btn btn-primary">Create new blog post</a>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Author</th>
            <th>Published</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(!$posts->isEmpty())
        @foreach($posts as $post)
            <tr class="{{$post->published_highlight}}">
                <td><a href="{{route('backend.blog.edit',$post->id)}}">{{$post->title}}</a></td>
                <td>{{$post->slug}}</td>
                <td>{{$post->author !== null?$post->author->name:'unknown'}}</td>
                <td>{{$post->published_date}}</td>
                <td><a href="{{route('backend.blog.edit',$post->id)}}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td><a href="{{lr('/backend/blog/'.$post->id.'/confirm')}}">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a></td>
            </tr>
        @endforeach
            @endif
        </tbody>
    </table>
    {{--{!! $posts->render() !!}--}}
@endsection