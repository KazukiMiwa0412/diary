@extends('layouts.layout')
@section('child')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Styles -->
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        
        
    </head>
    <body>
        
        <form action="{{ route('diaries.search') }}" method="get">
            <input type="text" name="search" placeholder="入力" value="">
            <button type="submit">検索</button>
            
            @error('search')
                <span class="" role="alert" style="color:red;">
                    <strong><br>{{ $message }}</strong>
                </span>
            @enderror
        </form>
        @isset($search_result)
            <h5>{{ $search_result }}</h5>
        @endisset
        @foreach ($diaries as $diary)
            <div class='diary'>
                <h3><a href="{{ route('diaries.show' ,$diary->id)}}">{{ $diary->title }}</a></h3>
                <h3>{{ $diary->user_id }}</h3>
                <p class='body'>{{ $diary->text }}</p>
                <p>{{ $diary->date }}</p>
                @foreach ($diary->pictures as $picture)
                    <div class="picture">
                        <img src="{{ '../storage/image/' . $picture->file_name }}"  width="128" height="128">
                    </div>
                @endforeach
            </div>
        @endforeach 
        <h1><a href="{{ route('diaries.create') }}">新規作成</a></h1>
        
        <div class='paginate'>
            @if(isset($search_query))
                {{ $diaries->appends(['search' =>$search_query])->links('vendor.pagination.sample-pagination') }}
            @else
                {{ $diaries->links('vendor.pagination.sample-pagination') }}
            @endif
        </div>
    </body>
    
</html>

@endsection