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
            @media screen { #filename { display: none; } }
            
            .browse_btn {
                background-color: #d3d3d3;
                padding: 6px;
                border-radius: 8px;
                font-weight: bold;
            }
            @media screen { #filename { display: none; } }
            
            .browse_btn {
                background-color: #d3d3d3;
                padding: 6px;
                border-radius: 8px;
                font-weight: bold;
            }
            
            #content_area img{
                margin:20px;
            }
            
            #back_btn{
                width:5rem;
                height:5rem;
                display: inline-block;
                line-height: 30px;
                text-align: center;
                box-shadow: 0 5px 0 black;
                border-radius: 10px;
                cursor: pointer;
                position: fixed;
                font-size:20px;
                font-weight:bold;
                right: 2%;
                bottom:5%;
                padding: 6px 40px;
            }
            #back_btn:hover{
                opacity: 0.9;
            }
            #back_btn:active{
                opacity: 0.5;
                transform: translateY(5px);
                box-shadow: none;
            }
            
        </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        
        
    </head>
    <body>
        
        <h1>編集画面</h1>
        <form action="{{ route('diaries.update' , $diary->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div>
                <div class="form-group">
                    <h2>日付</h2>
                    <i class="fa fa-calendar fa-lg "></i> 
                    <input name="diary[date]" type="text" id="datepicker" value="{{$diary->date}}" class="w-25 mx-auto" >
                  </div>
            </div>
            <div class="title">
                <h2>Title</h2>
                <i class="fa fa-pencil fa-lg"></i> 
                <input type="text" name="diary[title]" value="{{$diary->title}}" class="w-25 mx-auto"/>
                <p class="title__error" style="color:red">{{ $errors->first('diary.title') }}</p>
            </div>
            <div class="text">
                <h2>Text</h2>
                <textarea class="form-control w-25 mx-auto" name="diary[text]" placeholder="" rows="10">{{$diary->text}}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('diary.text') }}</p>
            </div>
            <i class="fas fa-paperclip"></i>
            <input id="dummy_file" type="text" name="pic_name">
            <label for="filename" >
                <span class="browse_btn">アップロード</span><input type="file" id="filename" name="pic[]" multiple />
            </label>
            <button type="submit" id="back_btn" class="btn btn-secondary rounded-circle p-0" onclick="location.href='{{ route('diaries.show' , $diary->id) }}'">更新</button>
        </form>
        <div id="content_area" class="d-inline-flex w-50 overflow-auto">
            @foreach ($diary->pictures as $picture)
                <img class="mx-auto" src="{{ '/storage/image/' . $picture->file_name }}"  width="128" height="128" >
            @endforeach
        </div>
        
        
        
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
                img_element.style.margin = "auto";
                var content_area = document.getElementById("content_area");
                content_area.appendChild(img_element);
                
            }
            document.getElementById("dummy_file").value = fileName;
        });
    </script>
</html>
@endsection