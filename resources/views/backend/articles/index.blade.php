@extends('layouts.backend')
@section('title','Артикали')


@section('content')
    <a href="{{route('backend.articles.create')}}" class="btn btn-primary">Създай нов артикъл</a>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Име</th>
            <th>Автор</th>
            <th>Публикуван</th>
            <th>Редактирай</th>
            <th>Изтрии</th>
        </tr>
        </thead>
        <tbody>
        @if(!$articles->isEmpty())
        @foreach($articles as $article)
            <tr class="{{$article->published_highlight}}">
                <td><a href="{{route('backend.articles.edit',$article->id)}}">{{$article->title}}</a></td>

                <td>{{$article->author !== null?$article->author->name:'unknown'}}</td>
                <td>{{$article->published_date}}</td>
                <td><a href="{{route('backend.articles.edit',$article->id)}}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td><a href="{{lr('/backend/articles/'.$article->id.'/confirm')}}">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a></td>
            </tr>
        @endforeach
            @endif
        </tbody>
    </table>
    {{--{!! $articles->render() !!}--}}
@endsection