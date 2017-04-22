<template>
    <div class="full-width"
         style="position:relative;">

        <input type="file"
               style="
                position:absolute;top:0;left:0;
                z-index:400;opacity:0;"
               @change="handleFileChanged"
               :style="{height:imgSize.height+'px',width:imgSize.width+'px'}">

        <img :src="photoPath" class="full-width"
             :id="imgId"
             @load="handleImgLoad">

        <div v-show="fileLoading"
             style="
             position: absolute;left:0px; top:0px; width: 100%;height:100%;
            background-color:white;
            z-index:10">
            <span style="position: absolute;left:30%;top:30%;">
                <i class="fa fa-spinner fa-pulse fa-5x"></i> <br/>檔案上傳中
            </span>
        </div>

        <span class="btn btn-danger btn-xs"
              @click="handlePhotoDelete"
              style="position: absolute;
                      top:5px;left:5px; z-index:450;"
              v-show="hasPhoto">
            <i class="fa fa-trash-o"></i>&nbsp;刪除圖片
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            model: {
                type: String,
                required: true
            },
            id: {
                required: true
            },
            filepath: {
                type: String,
                required: false
            },
            field: {
                type: String,
                required: false
            }
        },
        data: function () {
            return {
                photo: {
                    model: '',
                    id: '',
                    field: '',
                    filepath: ''
                },
                photoDir: '\\images\\companyInfo\\',
                fileLoading: false,
                imgSize: {
                    height: 0,
                    width: 0
                },
                imgId: ''
            }
        },
        methods: {
            handleImgLoad: function () {
                adjustImgSize(this);
            },
            handleFileChanged: function (e) {
                e.preventDefault();
                var files = e.target.files;
                //if there is file selected
                if (files.length > 0) {
                    doFileUpload(this, files);
                }
            },
            handlePhotoDelete: function () {
                if (confirm('確定刪除圖片?')) {
                    doPhotoDelete(this);
                }
            },
        },
        computed: {
            photoPath: function () {
                return this.photo.filepath == '' ?
                        (this.photoDir + 'mainPhoto.jpg') :
                        this.photo.filepath;
            },
            hasPhoto: function () {
                return !this.photo.filepath == '';
            },
        },
        mounted: function () {
            //some protection should be taken if no preliminary data is given

            this.photo.model = this.model;
            this.photo.id = this.id;
            this.photo.field = this.field;
            this.photo.filepath = (this.filepath) ? this.filepath : '';
            this.imgId = 'img-' + new Date().getTime();
        }
    }

    function generateFormData() {
        var data = new FormData();
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        return data;
    }

    function adjustImgSize(component) {
        var imgEl = $('#' + component.imgId);
        component.imgSize.height = imgEl.height();
        component.imgSize.width = imgEl.width();
    }

    function doFileUpload(component, files) {
        component.fileLoading = true;
        var data = generateFormData();
        data.append('photofile', files[0]);

        var successCallback = function (response) {
            component.photo.filepath = response.body.filepath;
            component.fileLoading = false;
        }.bind(this);

        var errorCallback = function (response) {
            component.fileLoading = false;
            alert(response);
        }.bind(this);

        var url = '/photo/store/' +
                component.photo.model +
                '/' + component.photo.id +
                '/' + component.photo.field;

        component.$http.post(url, data)
                .then(successCallback, errorCallback);
    }

    function doPhotoDelete(component) {
        var data = generateFormData();

        var successCallback = function (response) {
            component.photo.filepath = '';
        }.bind(this);

        var errorCallback = function (response) {
            alert(response);
        }.bind(this);

        var url = '/photo/delete/' + component.photo.filepath;

        component.$http.post(url, data)
                .then(successCallback, errorCallback);
    }
</script>