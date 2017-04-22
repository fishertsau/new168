<div class="form-horizontal content-block" id="control-panel">
    <div class="form-group zero-margin">
        <div class="col-sm-4  col-xs-4" style="padding-right:5px">
            <button class="btn btn-default full-width" type="submit">
                儲存預覽
            </button>
        </div>

        <div class="col-sm-4 col-xs-4">
            <button class="btn btn-default full-width"
                    @click.prevent="deleteDevice">
                                    <span class="glyphicon glyphicon-remove-circle"
                                          aria-hidden="true"></span>&nbsp;刪除
            </button>
        </div>

        <div class="col-sm-4 col-xs-4">
            <a href="/" class="btn btn-default full-width">取消</a>
        </div>
    </div>
</div>