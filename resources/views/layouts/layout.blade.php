<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日記</title>
        
        <style>
            * {
                box-sizing: border-box;
                margin :0px;
                padding: 0px;
            }
            @media screen and (min-width: 769px) {
                html {
                    font-size: 120%;
                }
                header {
                    width: 100%;
                    height:15%;
                    background-color: pink;
                    position:fixed;
                    top:0;
                    z-index:10;
                    box-shadow: 0 0 10px -5px rgba(0, 0, 0, 0.8);
                }
            }
            @media screen and (max-width: 768px) {
                html {
                    font-size: 75%;
                }
                header {
                    width: 100%;
                    height:10%;
                    background-color: pink;
                    position:fixed;
                    top:0;
                    z-index:10;
                    box-shadow: 0 0 10px -5px rgba(0, 0, 0, 0.8);
                }
            }
            @media screen and (max-width: 544px) {
                html {
                    font-size: 50%;
                }
                header {
                    width: 100%;
                    height:10%;
                    background-color: pink;
                    position:fixed;
                    top:0;
                    z-index:10;
                    box-shadow: 0 0 10px -5px rgba(0, 0, 0, 0.8);
                }
            }
            
            .app_title{
                font-size:3.125rem;
            	position:relative;
            	top:15%;
            	left:5%;
            	font-weight:bold;
            	color: #FFF;
            	text-shadow: 0 0 0.2em rgba(0,0,0,1);
            }
            
            .contents{
                width:80%;
                margin:auto;
                margin-top:15%;
                margin-bottom:12%;
                text-align:center;
            }
            
            
        </style>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        
        <!-- Bootstrap -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- Bootstrap-datepicker -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.ja.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        
        
    </head>
    <body>
        <header>
            <h1 class="app_title">日記</h1>
        </header>
        <div class="contents" >
            @yield('child')
        </div>
    </body>
</html>
