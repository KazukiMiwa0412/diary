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
        <div class="picture">
            <h1>ファイルアップロード</h1>
            @if (session('success'))
                <p>{{ session('success') }}</p>
            @endif
            <form action="{{ route('pictures.store') }}" method="post" enctype="multipart/form-data" class="store">
                @csrf
                <label>画像選択<br><input type="file" name="img" accept=".png,.jpg,.jpeg,image/png,image/jpg"></label>
                <br>
                <input type="text" value="商品名" name="pic_name">
                <input type="hidden" value="{{ $diary->id }}" name="diary_id">
                <br>
                <input type="submit" value="送信">
            </form>
        </div>
        
        
        <div class='diary'>
            <h3>{{ $diary->title }}</h3>
            <h3>{{ $diary->user->name }}</h3>
            <p class='body'>{{ $diary->text }}</p>
            <p>{{ $diary->date }}</p>
        </div>
        
        @foreach ($diary->pictures as $picture)
            <div class="picture">
                <img src="{{ '../storage/image/' . $picture->file_name }}"  width="128" height="128">
            </div>
        @endforeach
        
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
    </body>
</html>
@endsection