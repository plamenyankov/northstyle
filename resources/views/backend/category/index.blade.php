@extends('layouts.backend')
@section('title','Категории')


@section('content')
    <a href="{{route('backend.category.create')}}" class="btn btn-primary">Създай нова категория</a>
    <table class="table table-hover">
        <thead>
        <tr>
            <td>Категория</td>
            {{--<td>URI</td>--}}
            {{--<td>Name</td>--}}
            {{--<td>Template</td>--}}
            <td>Промени</td>
            <td>Изтрии</td>
        </tr>
        </thead>
        <tbody>
        @if($category->isEmpty())
            <tr>
                <td colspan="5" align="center">Няма намерени категории.</td>
            </tr>
        @else
            @foreach($category as $page)
                <tr>
                    <td>
                        {!! $linkToPaddedTitle($page, route('backend.content.page.edit',$page->id->value())) !!}
                    </td>
                    <td><a href="{{route('backend.category.edit',$page->id)}}">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a></td>
                    <td><a href="{{lr('/backend/category/'.$page->id.'/confirm')}}">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a></td>

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection