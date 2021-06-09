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
                padding:20px;
                margin-top:30px;
                box-shadow: 0px 0px 30px -5px rgba(0, 0, 0, 0.8);
            }
            .date {
                margin:0 20px 20px 0;
                padding:20px;
                border:solid;
                border-width: thin;
                height:100px;
                background-color:#FFFACD;
                box-shadow: 0px 0px 10px -5px rgba(0, 0, 0, 0.8);
            }
            .date *{
                color:red;
                font-weight:bold;
                text-align:right;
                text-shadow:0px 0px 2px #FFF, 4px 4px 2px rgba(0,0,0,0.3);
            }
            #text{
                font-size:medium;
                height:75px;
                
            }
            .input-group{
                margin:auto;
                width:30%;
                position:fixed;
                top:40px;
                left:35%;
                z-index:500;
                box-shadow: 0px 10px 10px -5px rgba(0, 0, 0, 0.8);
            }
            .error_message{
                position:fixed;
                top:30px;
                left:40%;
                z-index:500;
            }
            #create_btn{
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
                padding: 6px 40px;
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
                font-size:20px;
                display:none;
                right: 8%;
                bottom:3%;
                border:solid;
                border-width: thin;
                padding:10px 80px;
                background-color:#CCFFFF;
                opacity: 0.7;
                z-index: -1; 
            }
        </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        
        
    </head>
    <body>
        <div class="text-left">
            <form action="{{ route('diaries.search') }}" method="get" class="">
                <div class="input-group">
                	<input type="text" name="search" class="form-control" placeholder="">
                	<span class="input-group-btn">
                		<button type="submit" class="btn btn-primary"><i class="fas fa-search pr-1"></i></button>
                	</span>
                </div>
                @error('search')
                    <span class="error_message" role="alert" style="color:red;">
                        <strong><br>検索した文字を入力してください</strong>
                    </span>
                @enderror
            </form>
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
                            <p id="text" class='overflow-auto'>{{ $diary->text }}</p>
                        </div>
                    </div>
                    <div class="overflow-auto d-flex " style="height:120px;">
                        @foreach ($diary->pictures as $picture)
                            <div class="picture mx-2">
                                <img src="{{ '../storage/image/' . $picture->file_name }}"  width="100" height="100">
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
    </script>
</html>

@endsection