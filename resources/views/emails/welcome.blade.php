@extends('emails.layouts.default')

<h4>{{$user->name}}&nbsp;歡迎您加入我們:</h4>

@include('emails.partials._emailConfirmationContent')

@include('auth._companyInfo')
