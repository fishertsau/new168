{{--How to Use--}}

{{--css--}}
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css" rel="stylesheet">--}}

{{--js}}
<!-- DropZone js-->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone4.2.0.js"></script>--}}
{{--<script type="text/javascript" src="{{ asset('assets/js/admin/myDropZoneControl.js')}}"></script>--}}

{{--Usage--}}
{{--@include('partials._coverPhotoDropzone' ,[--}}
{{--'id'=>$user->id,--}}
{{--'path' =>$user->avatar,--}}
{{--'associatedTable'=>'users',--}}
{{--'fieldName'=>'avatar'])--}}
{{--'fieldName':  The photoPath for the corresponding table--}}

<?php $hasPhoto = (isset($path) and ($path != ''));
$path = !$hasPhoto ? "coverPhoto.jpg" : $path; ?>

<?php
$field = (isset($fieldName) ? $fieldName : '');
$block_id = $associatedTable . $id . $field;

//table
//id
//field_name
//dir
//old filename
?>

<div class="dz-photo_block full-width"
     id="dz-photo_block-{{$block_id}}"
     style="position: relative;">

    {{--View--}}
    <img class="dz-photo"
         id="dz-photo-{{$block_id}}"
         src="{{URL::asset('assets/images/cover')}}/{{ $path }}"
         style="max-width: 100%; margin-bottom:10px">

    <div class="dz-loading"
         id="dz-loading-{{$block_id}}"
         style="position: absolute;left:0px; top:0px; width: 100%;height:100%;
            display:none;
            background-color:white;
            z-index:10">
        <span style="position: absolute;left:30%;top:30%;">
            <i class="fa fa-spinner fa-pulse fa-5x"></i> <br/>檔案上傳中
        </span>
    </div>

    {{--Dropzone Input Control--}}
    <div class="{{--dropzone--}} dz-SingleUpload"
         id="dz-SingleUpload-{{$block_id}}"
         style="
         position: absolute;
         left:0;top:0;z-index:400;
         width: 100%; height:100%;
         opacity:0;
         cursor:pointer"
            >
    </div>

    {{--Control Button--}}
    <span class="dz-deleteBtn btn btn-danger"
          id="dz-deleteBtn-{{$block_id}}"
          onclick="deleteCoverPhoto(this)"
          style="position: absolute;
                  top:5px;left:5px; z-index:500;
          {{  !$hasPhoto ?'display:none' :''}}">
                    <i class="fa fa-trash-o"></i>&nbsp;刪除圖片
    </span>

    {{--Control Data--}}
    <div class="dz-nodeInfo hidden"
         id="coverPhotoInfo-{{$block_id}}"
         data-url="/coverPhoto/{{$associatedTable}}/{{$id}}"
         belongsTo="{{$associatedTable}}"
         entryId="{{$id}}"
         blockId="{{$block_id}}"
            {{--foreignTable="{{(isset($foreignTable))?$foreignTable:''}}"--}}
            {{--foreignKey="{{(isset($foreignKey))?$foreignKey:0}}"--}}
         fieldName="{{$field}}"
            {{--dir="{{(isset($dir))?$dir:''}}"--}}
            >
    </div>
</div>

