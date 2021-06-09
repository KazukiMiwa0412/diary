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
                padding: 6px 40px;
                border-radius: 8px;
                font-weight: bold;
                font-weight: bold;
                font-size:25px;
            }
            
            #content_area img{
                margin:20px;
            }
            
            #content_area p{
                color:white;
                background-color:red;
                padding:10px;
                border:solid;
                border-width: thin;
                margin:5px;
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
                font-size:20px;
                font-weight:bold;
                right: 2%;
                bottom:5%;
                padding: 6px 40px;
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
                font-size:20px;
                display:none;
                right: 8%;
                bottom:3%;
                border:solid;
                border-width: thin;
                padding:10px 80px;
                background-color:#DDDDDD;
                opacity: 0.7;
                z-index: -1; 
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
                    <p class="title__error" style="color:red">{{ $errors->first('diary.date') }}</p>
                  </div>
            </div>
            <div class="title mb-5">
                <h2>Title</h2>
                <i class="fa fa-pencil fa-lg"></i> 
                <input type="text" name="diary[title]" value="{{$diary->title}}" class="w-25 mx-auto"/>
                <p class="title__error" style="color:red">{{ $errors->first('diary.title') }}</p>
            </div>
            
            <i class="fas fa-paperclip fa-2x"></i>
            <label for="filename" >
                <span class="browse_btn">アップロード</span><input type="file" id="filename" name="pic[]" multiple />
            </label>
            <br>
            
            <div id="content_area"  class="w-50 d-inline-flex justify-content-center" >
                <?php $i=0; ?>
                @foreach ($diary->pictures as $picture)
                
                <div id="div_{{ $i }}">
                    <img class="" src="{{ '/storage/image/' . $picture->file_name }}"  width="64" height="64" style="margin:20px;">
                    <p onClick="pic_delete(this);" class="delete_mark{{ $i }}" name="delete_button">削除</p>
                </div>
                <?php $i++; ?>
                @endforeach
            </div>
            
            <div class="text mt-3">
                <h2>Text</h2>
                <textarea class="form-control w-25 mx-auto" name="diary[text]" placeholder="" rows="10">{{$diary->text}}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('diary.text') }}</p>
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
            todayHighlight : true
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
                var content_area = document.getElementById("content_area");
                content_area.appendChild(div);
                var div_area = document.getElementById(div.id);
        
                //画像を表示
                var blobUrl = window.URL.createObjectURL(file);
                var img_element = document.createElement('img');
                img_element.src = blobUrl;
                img_element.width = 64; // 横サイズ（px）
                img_element.height = 64; // 縦サイズ（px）
                img_element.style.margin = "20px";
                var content_area = document.getElementById("content_area");
                div_area.appendChild(img_element);
                
                //削除ボタンを表示
                var p = document.createElement('p');
                const text = document.createTextNode("削除");
                p.className = `delete_mark${childElementCount}`;
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
            var div = document.getElementById(`div_${e.className.substr(11)}`);
            div.remove();
        };
        
        document.getElementById("update_btn").addEventListener("mouseover", function(){
        	document.getElementById("update_discription").style.display = 'block';
        }, false);
        
        document.getElementById("update_btn").addEventListener("mouseout", function(){
        	document.getElementById("update_discription").style.display = 'none';
        }, false);
        function pic_delete(e) {
            document.getElementById(`delete_button_${e.className.substr(11)}`).click();
        };
        
        // function deleteTextSubmit(){
        //     document.deleteForm.mode.value = "deleteText";
        //     document.deleteForm.submit();
        // }
        
    </script>
</html>
@endsection
