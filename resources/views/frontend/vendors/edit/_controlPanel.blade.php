<div class="form-group" style="border:none">
    <div class="col-sm-3 col-xs-6 zero-padding">
        <button class="btn btn-default full-width" type="submit"
                v-show="!item.active"
                @click.prevent="toggleItemActive"
                >
            發佈/續刊
        </button>
        <button class="btn btn-default full-width" type="submit"
                v-show="item.active"
                @click.prevent="toggleItemActive">
            <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
            下架
        </button>
    </div>

    <div class="col-sm-3  col-xs-6 zero-padding">
        <a :href="'/orgs/'+item.id+'/edit'">
            <button class="btn btn-default full-width" type="submit">
                繼續編輯
            </button>
        </a>
    </div>

    <div class="col-sm-2 col-xs-4 zero-padding">
        <form :action="'/orgs/'+item.id" method="post" onsubmit="return confirm('資料刪除後無法還原\n是否確定刪除?');">
            {{csrf_field()}}
            {{method_field('delete')}}
            <button class="btn btn-default full-width">
                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> 刪除
            </button>
        </form>
    </div>
    <div class="col-sm-2 col-xs-4 zero-padding">
        <a href="/">
            <button class="btn btn-default full-width"> 取消</button>
        </a>
    </div>

    <div class="col-sm-2  col-xs-4 zero-padding">
        <a href="/orgs/create">
            <button class="btn btn-default full-width">
                刊登更多
            </button>
        </a>
    </div>
</div>



