/***
 *  Create the options for single upload dropzone
 *  The return value is an object containing the options
 * */
function SingleUploadDropZoneOptions(dropzoneNode) {

    //Fetch the data for the designated Node for control
    var infoNode = dropzoneNode.parent().find('.dz-nodeInfo');

    var table = infoNode.attr('belongsTo');
    var id = infoNode.attr('entryId');
    //var foreignTable = infoNode.attr('foreignTable');
    //var foreignKey = infoNode.attr('foreignKey');
    var fieldName = infoNode.attr('fieldName');
    //var dir = infoNode.attr('dir');

    var _nodeId = table + id + fieldName;

    //Do the necssary setting
    var sendSingleDropzoneUrlTo = '/coverPhoto/' + table + '/' + id;
    var imgId = 'dz-photo-' + _nodeId;
    var loadingMessageId = 'dz-loading-' + _nodeId;
    var delBtnId = 'dz-deleteBtn-' + _nodeId;

    var options =
    {
        url: sendSingleDropzoneUrlTo,
        maxFiles: 1,
        paramName: 'coverPhoto_file',
        maxFilesize: 5, //3M
        acceptedFiles: '.jpg, .jpeg, .png, .bmp',
        dictDefaultMessage: "上傳圖片",
        dictRemoveFile: '刪除圖片',
        addRemoveLinks: true,
        init: function () {
            this.on("sending", function (file, xhr, data) {
                data.append("_token", $('input[name=_token]').val());
                //data.append("foreignTable", foreignTable);
                //data.append("foreignKey", foreignKey);
                data.append("fieldName", fieldName);
                data.append("dir", fieldName);
                loadStart(loadingMessageId);
            });
            this.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);
            });
            this.on("removedfile", function (file) {
            });
        },
        success: function (file, response) {

            //回傳新建 filename name
            var newFilename = (typeof(response) == 'object') ? response[0] : response;

            //the dir should be modified
            var newImageSrc = '/assets/images/cover/' + newFilename;
            loadStop(loadingMessageId);
            $('#' + imgId).attr('src', newImageSrc);
            $('#' + delBtnId).css('display', 'inline');
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        },
        accept: function (file, done) {
            done();
        }
    };

    return options;
}


/*************coverPhoto Handler__start******************/
function deleteCoverPhoto(elem) {

    var yesDeletePhoto = confirm('確定刪除圖片?');
    if (!yesDeletePhoto) {
        return false;
    }

    var infoNode = elem.parentNode.querySelector('.dz-nodeInfo');

    //Config next step setting
    var id = infoNode.getAttribute('entryId');
    var block_id = infoNode.getAttribute('blockId');
    var associatedTable = infoNode.getAttribute('belongsTo');
    var fieldName = infoNode.getAttribute('fieldName');

    //url for ajax
    var sendCommandTo
        = "/coverPhoto/" + associatedTable + '/' + id + '/' + fieldName;

    //image holder for the deleted node
    var imgId = 'dz-photo-' + block_id;
    var delBtnId = 'dz-deleteBtn-' + block_id;

    $.ajax(
        {
            url: sendCommandTo,
            type: 'DELETE',
            data: {
                '_token': $('input[name=_token]').val()
            },
            success: function (result) {
                setCoverPhotoToDefault(imgId, delBtnId);
            },
            error: function (responseTxt, statusTxt, xhr) {
                alert("Error: " + xhr.status + ": " + xhr.statusText);
            }
        }
    );
}

function setCoverPhotoToDefault(imgId, delBtnId) {
    $('#' + imgId).attr('src', '/assets/images/cover/coverPhoto.jpg');
    $('#' + delBtnId).css('display', 'none');
}


function loadStart(loadingMessageId) {
    $('#' + loadingMessageId).show();
}
function loadStop(loadingMessageId) {
    $('#' + loadingMessageId).hide();
}


$(function () {
    /***photo handler __start  DropZone  ***/
    /*** The dropzone instance should be initiated after the document  is ready***/
    //Dropzone upload for ONLY one file at the same time
    var singleUploadDropzone = $('.dz-SingleUpload');
    var i;
    for (i = 0; i < singleUploadDropzone.length; i++) {
        var dropzoneNode = $('#' + singleUploadDropzone[i].id);
        dropzoneNode.dropzone(SingleUploadDropZoneOptions(dropzoneNode));
    }
});
/*************coverPhoto Handler__end******************/

