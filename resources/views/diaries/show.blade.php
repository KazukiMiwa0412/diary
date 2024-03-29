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
            
            .diary p{
                display:inline-block;
                margin:5.5% auto 5.5%;
                border: 2mm ridge rgba(253,204,255,0.6);
                font-size:1.25rem;
                padding:4% 10%;
            }
            .text{
                white-space: pre-wrap;
                text-align:left;
            }
            #btn_action button{
                width:5rem;
                height:5rem;
                display: inline-block;
                line-height: 30px;
                text-align: center;
                box-shadow: 0 5px 0 black;
                border-radius: 10px;
                cursor: pointer;
                position: fixed;
                
                padding: 6px 40px;
            }
            #btn_action button:hover{
                opacity: 0.9;
            }
            #btn_action button:active{
                opacity: 0.5;
                transform: translateY(5px);
                box-shadow: none;
            }
            #edit_btn{
                bottom: 5%; 
                right: 1%;
                z-index: 3; 
            }
            #delete_btn{
                bottom: 22%; 
                right: 1%;
                z-index: 3; 
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
            #edit_discription{
                position: fixed;
                font-size:1.25rem;
                display:none;
                right: 8%;
                bottom:3%;
                border:solid;
                border-width: thin;
                padding:0.7% 5.6%;
                background-color:#CBFFD3;
                opacity: 0.7;
                z-index: 2; 
            }
            #delete_discription{
                position: fixed;
                font-size:1.25rem;
                display:none;
                right: 8%;
                bottom:18%;
                border:solid;
                border-width: thin;
                padding:0.7% 5.6%;
                background-color:#FFABCE;
                opacity: 0.7;
                z-index: 2; 
            }
            #twitter_btn{
                z-index:21;
                position:fixed;
                top:2%;
                right:30%;
            }
        </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        
        
    </head>
    <body>
        <button type="button" id="back_btn" class="btn btn-primary rounded-circle p-0" onclick="location.href='{{ route("diaries.index") }}'"><i class="fas fa-arrow-left fa-2x"></i></button>
        <div id="twitter_btn">
            <a href="https://twitter.com/intent/tweet?text=タイトル：{{ $diary->title }}%0a日付：{{ $diary->date }}%0a{{ str_repeat("=",15) }}%0a{{ $diary->text }}" target="blank_">
                <i class="fa fa-twitter fa-3x" aria-hidden="true"></i>
            </a>
            <p>Twitterに投稿する</p>
        </div>
        <div class="mx-auto">
            <div class='diary w-75 mx-auto'>
                <h1>タイトル</h1>
                <p>{{ $diary->title }}</p>
                <h1>日にち</h1>
                <p>{{ $diary->date }}</p>
                @if(count($diary->pictures)>0)
                    <h1>画像</h1>
                    <div class="mx-auto d-block p-3 ">
                        @foreach ($diary->pictures as $picture)
                            <div class="d-inline-flex mx-1">
                                <img class="mx-auto" src="{{ '../storage/image/' . $picture->file_name }}"  width="64" height="64">
                            </div>
                        @endforeach
                    </div>
                @endif
                <h1 class="mt-3">本文</h1>
                <p class='text'>{{ $diary->text }}</p>
            </div>
            
            <div class="row w-25 mx-auto" id="btn_action">
                <button type="button" id="edit_btn" class="btn btn-success rounded-circle p-0" onclick="location.href='{{ route('diaries.edit',$diary->id) }}'"><i class="far fa-edit fa-2x"></i></button>
                <p id="edit_discription">編集</p>
                <form action="{{ route('diaries.destroy',$diary->id ) }}" method="POST" class="col-6" name="deleteform">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="delete_btn" class="btn btn-danger rounded-circle p-0" onClick="delete_alert(event);return false;"><i class="far fa-trash-alt fa-2x"></i></button>
                    <p id="delete_discription">削除</p>
                </form>
            </div>
            
        </div>
    </body>
    <script type="text/javascript">
        function delete_alert(e){
            if(!window.confirm('本当に削除しますか？')){
                return false;
            }
           
           document.deleteform.submit();
        };
        document.getElementById("edit_btn").addEventListener("mouseover", function(){
        	document.getElementById("edit_discription").style.display = 'block';
        }, false);
        
        document.getElementById("edit_btn").addEventListener("mouseout", function(){
        	document.getElementById("edit_discription").style.display = 'none';
        }, false);
        document.getElementById("delete_btn").addEventListener("mouseover", function(){
        	document.getElementById("delete_discription").style.display = 'block';
        }, false);
        
        document.getElementById("delete_btn").addEventListener("mouseout", function(){
        	document.getElementById("delete_discription").style.display = 'none';
        }, false);
        
    </script>
</html>
@endsection
