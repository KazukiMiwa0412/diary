<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>日記</title>
        
        <style>
            * {
                box-sizing: border-box;
            }
            
            header {
                width: 100%;
                padding: 30px 4% 30px;
                background-color: pink;
                position:fixed;
                top:0;
                z-index:10;
                box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.8);
            }
            .app_title{
                font-size:5em;
            	line-height:0.95em;
            	font-weight:bold;
            	color: #FFF;
            	text-shadow: 0 0 0.2em rgba(0,0,0,1);
            }
            .contents{
                width:60%;
                margin:auto;
                margin-top:200px;
                text-align:center;
            }
            .menu-btn {
                position: fixed;
                top: 30px;
                right: 10px;
                display: flex;
                height: 60px;
                width: 60px;
                justify-content: center;
                align-items: center;
                z-index: 90;
                background-color: #3584bb;
            }
            .menu-btn span,
            .menu-btn span:before,
            .menu-btn span:after {
                content: '';
                display: block;
                height: 3px;
                width: 25px;
                border-radius: 3px;
                background-color: #ffffff;
                position: absolute;
            }
            .menu-btn span:before {
                bottom: 8px;
            }
            .menu-btn span:after {
                top: 8px;
            }
            #menu-btn-check:checked ~ .menu-btn span {
                background-color: rgba(255, 255, 255, 0);/*メニューオープン時は真ん中の線を透明にする*/
            }
            #menu-btn-check:checked ~ .menu-btn span::before {
                bottom: 0;
                transform: rotate(45deg);
            }
            #menu-btn-check:checked ~ .menu-btn span::after {
                top: 0;
                transform: rotate(-45deg);
            }
            #menu-btn-check {
                display: none;
            }
            .menu-content ul {
                padding: 70px 50px 0;
            }
            .menu-content ul li {
                border-bottom: solid 1px #ffffff;
                list-style: none;
                display: inline;
            }
            .menu-content ul li a {
                display: block;
                width: 20%;
                font-size: 15px;
                box-sizing: border-box;
                color:#ffffff;
                text-decoration: none;
                padding: 9px 0 10px 0;
                position: relative;
            }
            .menu-content ul li a::before {
                content: "";
                width: 7px;
                height: 7px;
                border-top: solid 2px #ffffff;
                border-right: solid 2px #ffffff;
                transform: rotate(45deg);
                position: absolute;
                right: 11px;
                top: 16px;
            }
            .menu-content {
                width: 100%;
                height: 100%;
                position: fixed;
                top: 0;
                left: 100%;/*leftの値を変更してメニューを画面外へ*/
                z-index: 80;
                background-color: #3584bb;
                transition: all 0.5s;/*アニメーション設定*/
            }
            #menu-btn-check:checked ~ .menu-content {
                left: 70%;/*メニューを画面内へ*/
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
            <div class="hamburger-menu">
                <!-- チェックボックス -->
                <input type="checkbox" id="menu-btn-check">
                <!-- ハンバーガーメニュー -->
                <label for="menu-btn-check" class="menu-btn"><span></span></label>
                <div class="menu-content">
                    <ul>
                        <li>
                            <h2 class="login_user">{{ Auth::user()->name }}</h2>
                        </li>
                        <li>
                            <a href="{{ route('diaries.index') }}">topへ</a>
                        </li>
                        <li>
                            <a href="{{ route('diaries.create') }}">新規作成</a>
                        </li>
                        <li>
                            <div class="" aria-labelledby="navbarDropdown">
                                <a class="" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('ログアウト') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="contents" >
            @yield('child')
        </div>
    </body>
</html>
