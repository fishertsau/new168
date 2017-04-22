<form class="navbar-form navbar-left" role="search" style="color: white;margin: 0px;"
      action="\admin\occasions\list\paginated" method="get"
      id="searchForm">

    <div class="form-group">
        <select name="active" id="active" title="請選擇狀態" class="form-control" style="color: black;">
            <option value="">所有狀態</option>
            <option value="1" @if($queryTerm['active']) selected @endif>正常</option>
            <option value="0" @if(!$queryTerm['active']) selected @endif>停用</option>
        </select>
    </div>

    <div class="form-group hidden">
        <select name="keyword_by" id="keyword_by" title="查詢依據" class="form-control" style="color: black;">
            <option value="title" @if($queryTerm['keyword_by']=='title') selected @endif>名稱</option>
        </select>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="關鍵字" name="keyword" id="keyword"
               @if(isset($queryTerm['keyword']) && $queryTerm['keyword'] !=='%')
               value="{{$queryTerm['keyword']}}"
                @endif>
        <button class="btn btn-success" @click.prevent="resetQuery">重設</button>
    </div>
    <button class="btn btn-warning" name="newSearchBtn" id="newSearchBtn"

            @click.prevent="doNewSearch">搜尋
    </button>
</form>