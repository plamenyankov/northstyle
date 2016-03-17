@extends('layouts.backend')
@section('title','Страници')

@section('content')
    <a href="{{route('backend.content.page.create')}}" class="btn btn-primary">Създай нова</a>
    <table class="table table-hover">
        <thead>
        <tr>
            <td>Заглавие</td>
            <td>URI</td>
            <td>Име</td>
            <td>Шаблон</td>
            <td>Редактирай</td>
            <td>Изтрий</td>
        </tr>
        </thead>
        <tbody>
        @if(!count($pages))
            <tr>
                <td colspan="5" align="center">There are no pages.</td>
            </tr>
        @else
            @foreach($pages as $page)
                <tr>
                    <td>
                        {!! $linkToPaddedTitle($page, route('backend.content.page.edit',$page->id->value())) !!}
                    </td>
                    <td><a href="{{url($page->uri)}}">{{$page->pretty_uri}}</a></td>
                    <td>{{$page->name or 'None'}}</td>
                    <td>{{$page->template or 'None'}}</td>
                    <td><a href="{{route('backend.content.page.edit',$page->id->value())}}">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a></td>
                    <td><a href="{{route('backend.content.page.confirm_delete', $page->id->value())}}">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
					</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection