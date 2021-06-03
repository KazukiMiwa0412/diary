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
        <h1>編集画面</h1>
        <form action="{{ route('diaries.update' , $diary->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="diary[title]" value="{{$diary->title}}"/>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="diary[text]" placeholder="">{{$diary->text}}</textarea>
            </div>
            <input type="submit" value="更新"/>
        </form>
        <div class="back">[<a href="{{ route('diaries.show' , $diary->id) }}">back</a>]</div>
    </body>
</html>
@endsection