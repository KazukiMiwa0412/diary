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
            .text textarea {
                font-size: 15pt;
                line-height: 31px;
                padding: 31px;
            
                /* テキストエリアに陰をつける */
                box-shadow: 0.2em 0.2em 0.5em black;
            
                /* 罫線描画（各ブラウザ対応）*/
                background-image: -webkit-linear-gradient(left, white 10px, transparent 10px), -webkit-linear-gradient(right, white 10px, transparent 10px), -webkit-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
                background-image: -moz-linear-gradient(left, white 10px, transparent 10px), -moz-linear-gradient(right, white 10px, transparent 10px), -moz-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
                background-image: -ms-linear-gradient(left, white 10px, transparent 10px), -ms-linear-gradient(right, white 10px, transparent 10px), -ms-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
                background-image: -o-linear-gradient(left, white 10px, transparent 10px), -o-linear-gradient(right, white 10px, transparent 10px), -o-linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
                background-image: linear-gradient(left, white 10px, transparent 10px), linear-gradient(right, white 10px, transparent 10px), linear-gradient(white 30px, #ccc 30px, #ccc 31px, white 31px);
                background-size: 100% 100%, 100% 100%, 100% 31px;
                /* 淡いグレーで枠線を囲む */
                border: 1px solid #ccc;
            }
            @media screen { #filename { display: none; } }
            
            .browse_btn {
                background-color: #d3d3d3;
                padding: 6px;
                border-radius: 8px;
                font-weight: bold;
            }
            
            </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        
        
    </head>
    <body>
        <h1>日記作成</h1>
        <form  action="{{ route("diaries.store") }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div>
                <div class="form-group">
                    <h2>日付</h2>
                    <i class="fa fa-calendar fa-lg "></i> 
                    <input name="diary[date]" type="text" id="datepicker" placeholder="日付を選択してください" class="w-25 mx-auto" >
                  </div>
            </div>
            <div class="title">
                <h2>Title</h2>
                <i class="fa fa-pencil fa-lg"></i> 
                <input type="text" name="diary[title]" placeholder="タイトル" class="w-25 mx-auto"/>
                
                <p class="title__error" style="color:red">{{ $errors->first('diary.title') }}</p>
            </div>
            <div class="text">
                <h2>本文</h2>
                <textarea class="form-control w-25 mx-auto" name="diary[text]" placeholder="" rows="10"></textarea>
                <p class="body__error" style="color:red">{{ $errors->first('diary.text') }}</p>
            </div>
            <i class="fas fa-paperclip"></i>
            <input id="dummy_file" type="text" name="pic_name">
            <label for="filename" >
                <span class="browse_btn">アップロード</span><input type="file" id="filename" name="pic[]" multiple />
            </label>
            <input type="hidden" name="diary[user_id]" value="{{ Auth::user()->id }}">
            <br>
            <input type="submit" class="btn btn-outline-primary" value="保存"/>
        </form>
        
        <div id="content_area" class="mx-auto"></div>
        <a class="btn btn-primary  active" role="button" href="{{ route("diaries.index") }}" style="margin-top:30px;">back</a>
    </body>
    <script type="text/javascript">
        $('#datepicker').datepicker({
            language:'ja',
            showAnim: 'show',
            autoclose: true,
            todayHighlight : true
        });
        
        
        $('#filename').on('change', function (e) {
            var fileList = e.files;
            console.log(fileList);
            var fileCount =e.target.files.length;
            let fileName = document.getElementById("dummy_file").value;
            console.log(fileName);
            for ( var i = 0; i < fileCount; i++ ){
                //ファイル名表示
                var file = e.target.files[i];
                fileName += file.name;
                fileName += " ";
                
                //画像を表示
                var blobUrl = window.URL.createObjectURL(file);
                var img_element = document.createElement('img');
                img_element.src = blobUrl;
                img_element.width = 128; // 横サイズ（px）
                img_element.height = 128; // 縦サイズ（px）
                img_element.style.margin = "20px";
                var content_area = document.getElementById("content_area");
                content_area.appendChild(img_element);
                
            }
            document.getElementById("dummy_file").value = fileName;
        });
    </script>
</html>

@endsection