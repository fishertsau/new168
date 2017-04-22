<template>
    <div class="thumbnail" style="background: white">
        <a :href="'/devices/'+item.id">
            <img :src="filePath(item.coverphoto)" alt=""
                 style="height:120px">
        </a>

        <div class="caption">
            <h4 class="text-danger">{{ item.title }}</h4>
            <h4>價格:<span class="text-warning">{{ item.price|currency}}</span></h4>

            <p class="text-primary">瀏覽人次: &nbsp;{{ item.reads }}</p>

            <p class="text-primary">{{ item.created_date }}刊登
                <a :href="'/devices/'+item.id">
                        <span class="pull-right text-danger">查看&nbsp;
                            <i class="fa fa-caret-right" aria-hidden="true"></i></span>
                </a>
                <a :href="'/devices/'+item.id+'/edit'" v-if="this.editable">
                    <span class="pull-right text-danger">編輯&nbsp;
                            <i class="fa fa-caret-right" aria-hidden="true"></i></span>
                </a>
            </p>
        </div>
    </div>
</template>


<script>
    import appSetting from  '../appSetting.js'
    import helpers from  '../helpers.js'

    /***Filter**********/
    Number.prototype.formatMoney = function (decPlaces, thouSeparator, decSeparator) {
        var n = this,
                decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                decSeparator = decSeparator == undefined ? "." : decSeparator,
                thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
                sign = n < 0 ? "-" : "",
                i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
        return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
    };

    function formatDollar(num) {
        num = Number(num);
        return num.formatMoney(0, ',', 0);
    }

    Vue.filter('currency', formatDollar);

    /** Default Setting*/
    var defaultPhotoPath = appSetting.defaultDevicePhotoPath;

    export default {
        props: {
            device: {
                type: Object,
                required: true
            },
            editable: {
                type: Boolean,
                required: false
            }
        },
        data: function () {
            return {item: {}, allowEdit: false}
        },
        methods: {
            filePath: function (obj) {
                return helpers.filePath(obj, defaultPhotoPath);
            }
        },
        beforeMount: function () {
            this.item = this.device;
        }
    }
</script>