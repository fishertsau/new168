<div class="panel panel-warning">
    <div class="panel-heading">
        <h3 class="panel-title">設備地點</h3>
    </div>
    <div class="panel-body">
        <address-input
                :city="formInput.city"
                :zip="formInput.zip"
                :street="formInput.street"
                >
        </address-input>
        <div class="form-group">
            <div class="col-sm-offset-2">
                <span class="text-danger">*地址只要寫街道名稱即可</span>
            </div>
        </div>
    </div>
</div>