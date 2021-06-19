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
            
            #content_area img{
                margin:30% 20% 20% 20%;
            }
            
            #content_area p{
                font-size:0.5rem;
                padding:5% 3%;
                color:white;
                background-color:red;
                border:solid;
                border-width: thin;
                font-weight:900;
                box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.8);
            }
            #update_btn{
                width:5rem;
                height:5rem;
                display: inline-block;
                line-height: 30px;
                text-align: center;
                box-shadow: 0 5px 0 black;
                border-radius: 10px;
                cursor: pointer;
                position: fixed;
                font-size:1.25rem;
                font-weight:bold;
                right: 2%;
                bottom:5%;
                padding:0.7% 5.6%;
                z-index: 3; 
            }
            #update_btn:hover{
                opacity: 0.9;
            }
            #update_btn:active{
                opacity: 0.5;
                transform: translateY(5px);
                box-shadow: none;
            }
            #update_discription{
                position: fixed;
                font-size:1.25rem;
                display:none;
                right: 8%;
                bottom:3%;
                border:solid;
                border-width: thin;
                padding:0.7% 5.6%;
                background-color:#DDDDDD;
                opacity: 0.7;
                z-index: 2; 
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
        <button type="button" id="back_btn" class="btn btn-primary rounded-circle p-0" onclick="location.href='{{ route("diaries.show",$diary->id) }}'"><i class="fas fa-arrow-left fa-2x"></i></button>
        <h1>編集画面</h1>
        
        <form action="{{ route('diaries.update' , $diary->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div>
                <div class="form-group">
                    <h2>日付</h2>
                    <i class="fa fa-calendar fa-lg "></i> 
                    <input name="diary[date]" type="text" id="datepicker" value="{{$diary->date}}" class="w-25 mx-auto" >
                    @error('diary.date')
                        <p class="title__error" style="color:red">日付は必ず指定してください</p>
                    @enderror
                  </div>
            </div>
            <div class="title mb-5">
                <h2>Title</h2>
                <i class="fa fa-pencil fa-lg"></i> 
                <input type="text" name="diary[title]" value="{{$diary->title}}" class="w-25 mx-auto"/>
                @error('diary.title')
                    <p class="title__error" style="color:red">タイトルは必ず入力してください</p>
                @enderror
            </div>
            
            <i class="fas fa-paperclip fa-2x"></i>
            <label for="filename" >
                <span class="browse_btn">アップロード</span><input type="file" id="filename" name="pic[]" multiple />
            </label>
            <br>
            
            <div id="content_area"  class="w-75 mx-auto">
                <?php $i=0; ?>
                @foreach ($diary->pictures as $picture)
                    <div id="div_{{ $i }}" class="d-inline-block">
                        <img class="d-block mx-3" src="{{ 'https://diaryiamge.s3.ap-northeast-1.amazonaws.com/' . $picture->file_name }}"  width="64" height="64">
                        <p onClick="pic_delete(this);" class="delete_mark{{ $i }} d-block mx-2" name="delete_button">削除</p>
                    </div>
                    <?php $i++; ?>
                @endforeach
            </div>
            
            <div class="text mt-3">
                <h2>Text</h2>
                <textarea id="text" class="form-control w-75 mx-auto" name="diary[text]"  rows="15">{{$diary->text}}</textarea>
            </div>
            
            <button type="submit" id="update_btn" class="btn btn-secondary rounded-circle p-0" onclick="location.href='{{ route('diaries.show' , $diary->id) }}'" >
                <i class="fas fa-check fa-2x"></i>
            </button>
            <p id="update_discription">更新</p>
        </form>
        
        <div id="deleteforms">
            <?php $i=0; ?>
            @foreach ($diary->pictures as $picture)
                <form action="{{ route('pictures.destroy',$picture->id) }}" method="POST"  name="deleteform" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" onClick="delete_alert(event);return false;" id="delete_button_{{ $i }}" style="display:none;"></button>
                    <input type="hidden" value="{{ $diary->id }}" name="diaries_id">
                    <input type="hidden" value="diaries.edit" name="route">
                </form>
                <?php $i++; ?>
            @endforeach
        </div>
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
            var fileCount =e.target.files.length;
            var childElementCount =document.getElementById("content_area").childElementCount;
            for ( var i = 0; i < fileCount; i++ ){
                var file = e.target.files[i];
                
                //divタグ追加
                var div = document.createElement('div');
                div.id = `div_${childElementCount}`;
                div.className = "d-inline-block";
                var content_area = document.getElementById("content_area");
                content_area.appendChild(div);
                var div_area = document.getElementById(div.id);
        
                //画像を表示
                var blobUrl = window.URL.createObjectURL(file);
                var img_element = document.createElement('img');
                img_element.src = blobUrl;
                img_element.width = 64; // 横サイズ（px）
                img_element.height = 64; // 縦サイズ（px）
                img_element.className = "d-block mx-3";
                var content_area = document.getElementById("content_area");
                div_area.appendChild(img_element);
                
                //削除ボタンを表示
                var p = document.createElement('p');
                const text = document.createTextNode("削除");
                p.className = `delete_mark${childElementCount} d-block mx-2`;
                p.onclick = function(){deleteAddPicture(this);return false;}
                p.appendChild(text);
                div_area.appendChild(p);
                childElementCount++;
            }
        });
        
        function delete_alert(e){
            if(!window.confirm('本当に削除しますか？')){
                return false;
            }
           
           document.deleteform.submit();
        };
        function deleteAddPicture(e){
            var div = document.getElementById(`div_${e.parentNode.id.substr(4)}`);
            div.remove();
        };
        
        document.getElementById("update_btn").addEventListener("mouseover", function(){
        	document.getElementById("update_discription").style.display = 'block';
        }, false);
        
        document.getElementById("update_btn").addEventListener("mouseout", function(){
        	document.getElementById("update_discription").style.display = 'none';
        }, false);
        function pic_delete(e) {
            document.getElementById(`delete_button_${e.parentNode.id.substr(4)}`).click();
        };
        
        
        
    </script>
</html>
@endsection


