@extends('emails/layouts/default')

@section('content')
    <p>您好!</p>

    <p>您在金豪買刊登了設備販賣: {{$title}}</p>
    <p>有人要與您聯絡.</p>
    <br/>

    <hr>
    <p>連絡資訊:</p>
    <p>名稱:{{$sender}}</p>
    <p>電話:{{$tel}}</p>
    <p>電子信箱:{{$email}}</p>
    <br>
    <p>內容:</p>
    <p>{{$content}}</p>
@stop
