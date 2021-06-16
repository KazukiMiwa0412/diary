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
                font-size: 1.25rem;
                line-height: 1.9375rem;
                padding: 1.9375rem;
                
                /* テキストエリアに陰をつける */
                box-shadow: 0.2em 0.2em 0.5em black;
            
                /* 罫線描画（各ブラウザ対応）*/
                background-image: -webkit-linear-gradient(left, white 0.625rem, transparent 0.625rem), -webkit-linear-gradient(right, white 0.625rem, transparent 0.625rem), -webkit-linear-gradient(white 1.875rem, #ccc 1.875rem, #ccc 1.9375rem, white 1.9375rem);
                background-image: -moz-linear-gradient(left, white 0.625rem, transparent 0.625rem), -moz-linear-gradient(right, white 0.625rem, transparent 0.625rem), -moz-linear-gradient(white 1.875rem, #ccc 1.875rem, #ccc 1.9375rem, white 1.9375rem);
                background-image: -ms-linear-gradient(left, white 0.625rem, transparent 0.625rem), -ms-linear-gradient(right, white 0.625rem, transparent 0.625rem), -ms-linear-gradient(white 1.875rem, #ccc 1.875rem, #ccc 1.9375rem, white 1.9375rem);
                background-image: -o-linear-gradient(left, white 0.625rem, transparent 0.625rem), -o-linear-gradient(right, white 0.625rem, transparent 0.625rem), -o-linear-gradient(white 1.875rem, #ccc 1.875rem, #ccc 1.9375rem, white 1.9375rem);
                background-image: linear-gradient(left, white 0.625rem, transparent 0.625rem), linear-gradient(right, white 0.625rem, transparent 0.625rem), linear-gradient(white 1.875rem, #ccc 1.875rem, #ccc 1.9375rem, white 1.9375rem);
                background-size: 100% 100%, 100% 100%, 100% 1.9375rem;
                /* 淡いグレーで枠線を囲む */
                border: 0.0625rem solid #ccc;
            }
            @media screen { #filename { display: none; } }
            
            .browse_btn {
                background-color: #d3d3d3;
                padding: 6px 30px;
                border-radius: 8px;
                font-weight: bold;
                font-weight: bold;
                font-size:1.5rem;
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
                left: 2%;
                padding:1% 3%;
            }
            #back_btn:hover{
                opacity: 0.9;
            }
            #back_btn:active{
                opacity: 0.5;
                transform: translateY(5px);
                box-shadow: none;
            }
            #store_btn{
                width:5rem;
                height:5rem;
                display: inline-block;
                line-height: 30px;
                text-align: center;
                box-shadow: 0 5px 0 black;
                border-radius: 10px;
                cursor: pointer;
                position: fixed;
                bottom: 5%; 
                right: 1%;
                padding:1% 3%;
                z-index: 3; 
            }
            #store_btn:hover{
                opacity: 0.9;
            }
            #store_btn:active{
                opacity: 0.5;
                transform: translateY(5px);
                box-shadow: none;
            }
            #store_discription{
                position: fixed;
                font-size:1.25rem;
                display:none;
                right: 8%;
                bottom:3%;
                border:solid;
                border-width: thin;
                padding:0.7% 5.6%;
                background-color:#CCFFFF;
                opacity: 0.7;
                z-index: 2; 
            }
            .class-sunday {
                color: red !important;
            }
            .class-saturday {
                color: blue !important;
            }

            </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <button type="button" id="back_btn" class="btn btn-primary rounded-circle p-0" onclick="location.href='{{ route("diaries.index") }}'"><i class="fas fa-arrow-left fa-2x"></i></button>
        <h1 class="mb-4 font-weight-bold">日記作成</h1>
        <form  action="{{ route("diaries.store") }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div>
                <div class="form-group">
                    <h2 class="mt-4">日付</h2>
                    <i class="fa fa-calendar fa-lg "></i> 
                    <input name="diary[date]" type="text" id="datepicker" placeholder="日付を選択してください" class="w-50 mx-auto mb-4" >
                    @error('diary.date')
                        <p class="title__error" style="color:red">日付は必ず指定してください</p>
                    @enderror
                  </div>
            </div>
            
            <div class="title mb-5">
                <h2>タイトル</h2>
                <i class="fa fa-pencil fa-lg"></i> 
                <input  maxlength="20" type="text" name="diary[title]" placeholder="タイトルを入力してください" class="w-50 mx-auto mb-4"/>
                @error('diary.title')
                    <p class="title__error" style="color:red">タイトルは必ず入力してください</p>
                @enderror
            </div>
            
            <i class="fas fa-paperclip fa-2x"></i>
            <input id="dummy_file" type="hidden" name="pic_name">
            <label for="filename" >
                <span class="browse_btn">画像アップロード</span><input type="file" id="filename" name="pic[]" multiple />
            </label>
            <div id="content_area" class="mx-auto"></div>
            
            <div class="text mt-5">
                <h2>本文</h2>
                <textarea class="form-control w-50 mx-auto" name="diary[text]" placeholder="" rows="15"></textarea>
            </div>
            
            <input type="hidden" name="diary[user_id]" value="{{ Auth::user()->id }}">
            
            <button type="submit" id="store_btn" class="btn btn-primary rounded-circle p-0">
                <i class="fas fa-plus fa-2x"></i>
            </button>
            <p id="store_discription">保存</p>
        </form>
        
    </body>
    
    <script type="text/javascript">
        $('#datepicker').datepicker({
            language:'ja',
            showAnim: 'show',
            autoclose: true,
            todayHighlight : true,
            
            beforeShowDay: function(date) {
                var myDate = new Object();
                if (date.getDay() == 0) {
                  myDate.enabled = true;
                  myDate.classes = 'class-sunday';
                  myDate.tooltip  = '日曜日';
                } else if　(date.getDay() == 6) {
                  myDate.enabled = true;
                  myDate.classes = 'class-saturday';
                  myDate.tooltip  = '土曜日';
                } else {
                  myDate.enabled = true;
                  myDate.classes = 'class-weekday';
                  myDate.tooltip  = '平日';
                }
                return myDate;
            }
        });
        
        
        $('#filename').on('change', function (e) {
            var fileList = e.files;
            console.log(fileList);
            var fileCount =e.target.files.length;
            let fileName = document.getElementById("dummy_file").value;
            
            for ( var i = 0; i < fileCount; i++ ){
                //ファイル名表示
                var file = e.target.files[i];
                fileName += file.name;
                fileName += " ";
                
                //画像を表示
                var blobUrl = window.URL.createObjectURL(file);
                var img_element = document.createElement('img');
                img_element.src = blobUrl;
                img_element.width = 64; // 横サイズ（px）
                img_element.height = 64; // 縦サイズ（px）
                img_element.style.margin = "20px";
                var content_area = document.getElementById("content_area");
                content_area.appendChild(img_element);
                
            }
            document.getElementById("dummy_file").value = fileName;
        });
        document.getElementById("store_btn").addEventListener("mouseover", function(){
        	document.getElementById("store_discription").style.display = 'block';
        }, false);
        
        document.getElementById("store_btn").addEventListener("mouseout", function(){
        	document.getElementById("store_discription").style.display = 'none';
        }, false);
        
    </script>
</html>

@endsection