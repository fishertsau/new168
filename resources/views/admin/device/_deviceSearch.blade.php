<form class="navbar-form navbar-left" role="search" style="color: white;margin: 0px;"
      action="\admin\occasions\list\paginated" method="get"
      id="searchForm">

    <div class="form-group">
        <select name="cat_id" id="cat_id" title="請選擇使用場合" class="form-control" style="color: black;">
            <option value="">所有類別</option>
            @for ($i = 1; $i <= 100; $i++)
                <option value="{{$i}}">{{$i}}th Item</option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <select name="occasion[]" id="occasion" title="請選擇使用場合" class="form-control" style="color: black;" multiple>
            <option value="">所有場合</option>
            @foreach($occasion_list as $key=>$occasion)
                <option value="{{$key}}">{{$occasion}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <select name="price_range" id="price_range" title="請選擇價格" class="form-control" style="color: black;"
                v-model="price_range">
            <option value="">所有金額</option>
            <option value="0">5,000元以下</option>
            <option value="1">5,000元 - 1萬元</option>
            <option value="2">1萬-2萬元</option>
            <option value="3">2萬-3萬元</option>
            <option value="4">3萬-5萬元</option>
            <option value="5">5萬元以上</option>
        </select>
        <input type="number" class="hidden" v-model="price_lower" name="price_lower">
        <input type="number" class="hidden" v-model="price_upper" name="price_upper">
    </div>

    <div class="form-group">
        <select name="voltage" id="voltage" title="請選擇電壓" class="form-control" style="color: black;">
            <option value="">所有電壓</option>
            <option value="110V">110V</option>
            <option value="220V">220V</option>
            <option value="三向220V">三向220V</option>
        </select>
    </div>

    <div class="form-group">
        <select name="order_by"
                id="order_by"
                class="form-control"
                style="color: black;">
            <option value="">排序依據</option>
            <option value="price">金額</option>
        </select>
    </div>
    <div class="form-group">
        <select name="order_sequence"
                id="order_sequence"
                class="form-control"
                style="color: black;">
            <option value="">排序順序</option>
            <option value="asc">由小到大</option>
            <option value="desc">由大到小</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text"
               class="form-control"
               placeholder="關鍵字"
               name="keyword"
               id="keyword"
               @if(isset($queryTerm['keyword']) && $queryTerm['keyword'] !=='%')
               value="{{$queryTerm['keyword']}}"
                @endif>
        <button class="btn btn-success" @click.prevent="resetQuery">重設</button>
    </div>
    <button class="btn btn-warning" name="newSearchBtn" id="newSearchBtn"
            @click.prevent="doNewSearch">搜尋
    </button>
</form>