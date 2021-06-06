@extends('layouts.layout')
@section('child')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Styles -->
        <style>
            
        </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        
        
    </head>
    <body>
        
        <div class="w-50 mx-auto">
            <div class='diary'>
                <h3>{{ $diary->title }}</h3>
                <h3>{{ $diary->user->name }}</h3>
                <p class='body'>{{ $diary->text }}</p>
                <p>{{ $diary->date }}</p>
            </div>
            
            <div class="w-50 mx-auto overflow-auto">
                @foreach ($diary->pictures as $picture)
                    <div class="d-inline-flex">
                        <img class="mx-auto" src="{{ '../storage/image/' . $picture->file_name }}"  width="128" height="128">
                    </div>
                @endforeach
            </div>
            
            <p class="edit"><a href="{{ route('diaries.edit',$diary->id) }}">編集</a></p>
            <td>
                <form action="{{ route('diaries.destroy',$diary->id ) }}" method="POST">
                    @csrf
                    @method('DELETE')
            
                    <button type="submit" class="btn btn-danger">
                        削除
                    </button>
                </form>
            </td>
            <div class="back">[<a href="{{ route('diaries.index',) }}">back</a>]</div>
        </div>
    </body>
</html>
@endsection
