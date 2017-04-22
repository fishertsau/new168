@extends('frontend.components.topHeading.topHeading')

@section('heading_content')
    <device-search :querysource="$store.state.queryTerm"
    @do-search="turnToDeviceSearch"></device-search>
@endsection