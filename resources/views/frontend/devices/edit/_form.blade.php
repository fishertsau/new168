<div class="content-block">

    <div>
        <span class="text-danger">* 為必填項目</span>
    </div>
    @include('frontend.devices.edit._basicInfo')
    <div>
        {{--設備狀況--}}
        @include('frontend.devices.edit._condition')

        {{--價格--}}
        @include('frontend.devices.edit._price')

        {{--交易方式--}}
        @include('frontend.devices.edit._transaction')

        {{--運送方式--}}
        @include('frontend.devices.edit._transportation')


        {{--設備相片--}}
        @include('frontend.devices.edit._photos')

        {{--設備規格--}}
        @include('frontend.devices.edit._spec')


        {{--其他說明--}}
        @include('frontend.devices.edit._note')


        {{--設備地點--}}
        @include('frontend.devices.edit._address')

        {{--聯絡資訊--}}
        @include('frontend.devices.edit._contactInfo')
    </div>
</div>


