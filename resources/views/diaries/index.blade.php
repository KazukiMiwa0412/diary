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
        
            .diary{
                background-color:#FFFAFA;
                padding:2%;
                margin-top:3%;
                box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.8);
            }
            .date {
                height:10%;
                margin:0 2% 2% 0;
                padding:2%;
                border:solid;
                border-width: thin;
                background-color:#FFFACD;
                box-shadow: 0px 0px 10px -5px rgba(0, 0, 0, 0.8);
            }
            .date *{
                color:red;
                font-weight:bold;
                text-align:right;
                text-shadow:0px 0px 2px #FFF, 4px 4px 2px rgba(0,0,0,0.3);
            }
            .input-group{
                margin:auto;
                width:50%;
                position:fixed;
                top:3%;
                left:30%;
                z-index:20;
            }
            .form-control{
                height:100%;
            }
            
            @media screen and (max-width: 544px){
                .input-group{
                    top:2%;
                }
            }
            .error_message{
                position:fixed;
                top:2%;
                left:32%;
                z-index:20;
            }
            #text{
                height:100%;
                display: -webkit-box;
            	-webkit-line-clamp: 4;
            	-webkit-box-orient: vertical;
            	overflow: hidden;
            }
            #create_btn{
                width:6rem;
                height:6rem;
                display: inline-block;
                line-height: 30px;
                text-align: center;
                box-shadow: 0 5px 0 black;
                border-radius: 10px;
                cursor: pointer;
                position: fixed;
                bottom: 5%; 
                right: 1%;
                padding: 6px 40px;
                z-index: 3; 
            }
            #create_btn:hover{
                opacity: 0.9;
            }
            #create_btn:active{
                opacity: 0.5;
                transform: translateY(5px);
                box-shadow: none;
            }
            #create_discription{
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
        </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        
        
    </head>
    <body>
        <div class="text-left">
            @isset($search_result)
                <h5>{{ $search_result }}</h5>
            @endisset
            @foreach ($diaries as $diary)
                <div class='diary' onclick="DivFrameClick({{ $diary->id }});">
                    <div class="d-flex">
                        <div class="date" >
                            <h2 class="time">{{ substr($diary->date,5,2)}}/{{substr($diary->date,8,2) }}</h2>
                            <p class="year">{{ substr($diary->date,0,4) }}</p>
                        </div>
                        <div class="d-flex flex-column">
                            <h3 id="title">{{ $diary->title }}</h3>
                            <p id="text" class='' style="">{{ $diary->text }}</p>
                        </div>
                    </div>
                    <div class="overflow-auto d-flex " style="height:10%;">
                        @foreach ($diary->pictures as $picture)
                            <div class="picture mx-2">
                                <img src="{{ '../storage/image/' . $picture->file_name }}"  width="64" height="64">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach 
            <button type="button" id="create_btn" class="btn btn-primary rounded-circle p-0" onclick="location.href='{{ route('diaries.create') }}'"><i class="fa fa-pencil fa-2x"></i></button>
            <p id="create_discription">新規作成</p>
            <div class='paginate'>
                @if(isset($search_query))
                    {{ $diaries->appends(['search' =>$search_query])->links('vendor.pagination.sample-pagination') }}
                @else
                    {{ $diaries->links('vendor.pagination.sample-pagination') }}
                @endif
            </div>
        </div>
        
    </body>
    <script type="text/javascript">
        document.getElementById("create_btn").addEventListener("mouseover", function(){
        	document.getElementById("create_discription").style.display = 'block';
        }, false);
        
        document.getElementById("create_btn").addEventListener("mouseout", function(){
        	document.getElementById("create_discription").style.display = 'none';
        }, false);
        function DivFrameClick(id) {
          document.location.href = `/diaries/${id}`;
        }
        
        
        window.addEventListener("DOMContentLoaded",function(){
            var img_elements = document.querySelectorAll("img");
            for (var i=0; i<img_elements.length; i++){
                img_elements[i].addEventListener('load', function(e) {
                    var diaryHeight = e.target.parentNode.parentNode.parentNode.firstElementChild.clientHeight;
                    e.target.width = diaryHeight;
                    e.target.height = diaryHeight;
                   
                });
            }
        });
    </script>
</html>

@endsection