<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery-3.5.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.3/umd/popper.min.js"
            type="text/javascript"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    @font-face {
        font-family: IRANSans;
        font-style: normal;

        src: url('../fonts/IRANSansWeb(FaNum).eot') format('embedded-opentype'), /* IE6-8 */ url('../fonts/IRANSansWeb(FaNum).woff2') format('woff2'), /* FF39+,Chrome36+, Opera24+*/ url('../fonts/IRANSansWeb(FaNum).woff') format('woff'), /* FF3.6+, IE9, Chrome6+, Saf5.1+*/ url('../fonts/IRANSansWeb(FaNum).ttf') format('truetype');
    }
    .body{
        font-family: IRANSans;
        direction: rtl;
    }
    .error{
        position: absolute;
        top: 50px;
        right: 20px;

    }
    .bg_login {
        background-image: url(/image/sea1.jpg);
        width: 100%;
        height: 100vh;
        background-size: cover;
        background-attachment: fixed;
    }

    .login {
        width: 400px;
        height: 540px;
        border: 2px solid #4cdfaf;
        border-radius: 8px;
        margin: auto;
        position: relative;
        top:40px;
        right: 0px;
        left: 0px;
        background: rgba(0, 0, 0, .5);
        box-shadow:  5px 20px 20px 3px;

    }

    h5 {
        font-family: IRANSans;
        font-size: 19pt;
        color: white;
        direction: rtl;
        text-align: right;
        margin-top:25px;
        margin-right: 50px;
    }

    p {
        font-size: 13pt;
        font-family: IRANSans;
        direction: rtl;
        text-align: right;
        color: white;
        margin-right: 50px;
        margin-top:15px;
    }

    .input {
        width: 81%;
        height: 40px;
        margin: auto;
        font-family: IRANSans;
        font-size: 12pt;
        border-radius: 20px;
        border: none;
        text-align: center;
        direction: rtl;
        margin-left: 40px;
        overflow: hidden;
        outline: none;
    }

    .line {
        display: block;
        width: 79%;
        height: 2px;
        background: #4cdfaf;
        border-radius: 15px;
        margin-right: 40px;
    }

    .btn2 {
        font-family: IRANSans;
        font-size: 14pt;
        text-align: center;
        direction: rtl;
        width: 150px;
        margin-top:22px;
        border-radius: 7px;
        margin-left: 125px;
    }
    .a{
        color: white;
        font-family: IRANSans;
        font-size: 14pt;
        direction: rtl;
        position:absolute;
        bottom: 10px;
        left: 130px;
        text-decoration: none!important;

    }

    َa:hover{
        color: #4cdfaf!important;
        text-decoration: none!important;
    }
</style>


<body class="body">
<div class="container-fluid  bg_login p-0 ">
    @if(count($errors)>0)
        <div class="alert col-lg-3 alert-danger text-right error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

        @if(Session::has('not_found_user'))
            <div class="alert alert-danger col-lg-3 text-right error">
                <div>{{Session('not_found_user')}}</div>
            </div>
        @endif

    <div class="login">
        <h5>بازیابی رمز عبور</h5>
        <form action="{{route('reset.pa')}}" method="post">
            @csrf
            <span class="line"></span>
            <p> ایمیل:</p>
            <input type="text" class="input" placeholder="ایمیل" name="email" value="{{ old('email') }}">
{{--            <p>رمز عبور قبلی</p>--}}
{{--            <input class="input" type="password" name="old_password" value="" placeholder="  رمز عبور قبلی">--}}

            <p>رمز عبور جدید</p>
            <input class="input" type="password" name="password" value="" placeholder="  رمز عبور جدید">

            <p>تکرار رمز عبور </p>
            <input class="input" type="password" name="password_confirmation" value="" placeholder="  رمز عبور جدید">
            <button type="submit" class=" btn2 btn btn-success">تغییر رمز عبور</button>
        </form>
    </div><!--login-->


</div><!--container-fluid-->

</body>
</html>

