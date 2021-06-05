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
            textarea {
                background-image:
                    repeating-linear-gradient(
                    #fff,
                    #fff calc(1.5rem - 1px),
                    #ced4da calc(1.5rem - 1px),
                    #ced4da 1.5rem,
                    #fff 1.5rem
                    );
                background-origin: content-box;
                background-clip: content-box;
                background-attachment: local;
            }
            </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        
        
    </head>
    <body>
        <h1>日記作成</h1>
        <form  action="{{ route("diaries.store") }}" method="POST">
            @csrf
            <div>
                <div class="form-group">
                    <h2>日付</h2>
                    <i class="fa fa-calendar fa-lg "></i> 
                    <input name="diary[date]" type="text" id="datepicker" placeholder="日付を選択してください" >
                  </div>
            </div>
            <div class="title">
                <h2>Title</h2>
                <i class="fa fa-pencil fa-lg"></i> 
                <input type="text" name="diary[title]" placeholder="タイトル"/>
                
                <p class="title__error" style="color:red">{{ $errors->first('diary.title') }}</p>
            </div>
            <div class="body">
                <h2>本文</h2>
                <textarea class="form-control" name="diary[text]" placeholder="投稿" rows="10"></textarea>
                <p class="body__error" style="color:red">{{ $errors->first('diary.text') }}</p>
            </div>
            <input type="hidden" name="diary[user_id]" value="{{ Auth::user()->id }}">
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="{{ route("diaries.index") }}">back</a>]</div>
    </body>
    <script type="text/javascript">
        $('#datepicker').datepicker({
            language:'ja',
            showAnim: 'show'
        });
    </script>
</html>

@endsection