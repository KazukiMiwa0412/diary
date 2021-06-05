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
                border:solid;
                padding:20px;
                margin-top:10px;
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
                bottom: 10px; 
                right: 30px;
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
        </style>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        
        
    </head>
    <body>
        <div class="w-50 mx-auto">
            <form action="{{ route('diaries.search') }}" method="get" class="w-50 mx-auto">
                <div class="input-group">
                	<input type="text" class="form-control" placeholder="">
                	<span class="input-group-btn">
                		<button type="submit" class="btn btn-primary"><i class="fas fa-search pr-1"></i></button>
                	</span>
                </div>
                @error('search')
                    <span class="" role="alert" style="color:red;">
                        <strong><br>{{ $message }}</strong>
                    </span>
                @enderror
            </form>
            @isset($search_result)
                <h5>{{ $search_result }}</h5>
            @endisset
            @foreach ($diaries as $diary)
                <div class='diary'>
                    <h3><a href="{{ route('diaries.show' ,$diary->id)}}">{{ $diary->title }}</a></h3>
                    <h3>{{ $diary->user_id }}</h3>
                    <p class=''>{{ $diary->text }}</p>
                    <p>{{ substr($diary->date,5,2)}}/{{substr($diary->date,8,2) }}</p>
                    <div class="overflow-auto d-flex justify-content-center" style="height:150px;">
                        @foreach ($diary->pictures as $picture)
                            <div class="picture mx-2">
                                <img src="{{ '../storage/image/' . $picture->file_name }}"  width="128" height="128">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach 
            <button type="button" id="create_btn" class="btn btn-primary rounded-circle p-0" ><i class="fa fa-pencil fa-2x"></i> </button>
            
            <div class='paginate'>
                @if(isset($search_query))
                    {{ $diaries->appends(['search' =>$search_query])->links('vendor.pagination.sample-pagination') }}
                @else
                    {{ $diaries->links('vendor.pagination.sample-pagination') }}
                @endif
            </div>
        </div>
    </body>
    
</html>

@endsection