<input type="text" class="hidden" id="userDevices"
       value="{{$userDevices}}">
<br>
<div class="content-block">
    <h4 class="text-danger">您目前輸入的設備 &nbsp;({{count($userDevices)}}項)</h4>
    <hr class="line-dark">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-xs-6"
             v-for="item in userDevices">
            <device-block :device="item" editable="true"></device-block>
        </div>
    </div>
</div>