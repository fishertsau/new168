$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//Fisher addition,  notify the server about the sidebar open/close
$("[data-toggle='offcanvas']").click(function(){

    var _show_status;

    if ($(window).width() <= 992) {
        _show_status = $('#wrapper').hasClass('relative')? 'yes' : 'no';
    } else {
        _show_status = $('#wrapper-right-side').hasClass('strech')? 'no' : 'yes';
    }

    $.ajax(
        {
            url: "/admin/ajax/leftMenuVisibility/1",
            type: 'post',
            data: {
                //'_token': $('input[name=_token]').val(),
                'left_menu_show': _show_status
            },

            success: function (result) {
                console.log(result);
            },
            error: function (responseTxt, statusTxt, xhr) {
                alert("Error: " + xhr.status + ": " + xhr.statusText);
            }
        }
    );
});



/**
 * Created by Fisher on 2015/11/10.
 */
var i = 0;
var blockCounter = 0;

/***
 * 把項目順序更新
 *
 * */
function renewItemRank(item) {

    //set the value for targeting elements
    var itemBlock = '.' + item + 'Block';
    var itemRank = '.' + item + 'Rank';

    var listLength = $(itemBlock).length;

    //get the first item in the list
    var targetItem = $(itemBlock).first();

    //put appropriate ranking to each item
    var j = 1;
    while (j <= listLength) {
        var rank = targetItem.find(itemRank).first();
        rank.html(j);
        targetItem = targetItem.next();
        j++;
    }
}


function fewerItem(elem, category) {

    var categoryBlock = '.' + category + 'Block';

    var targetId = elem.closest(categoryBlock).getAttribute('id');

    var itemNum = $(categoryBlock).length;

    //項目最少有2項 才能刪除
    if (itemNum > 1) {

        $('#' + targetId).remove();

        renewItemRank(category);
    }
}


/**
 * Removed one more block when called
 * @param class name
 * @return void
 * */
function fewerBlock(elem, targetClass) {
    var targetBlock = '.' + targetClass;
    var itemNum = $(targetBlock).length;

    //項目最少有2項 才能刪除
    if (itemNum > 1) {
        var doNext = confirm('確定刪除?');

        if (doNext) {
            elem.closest(targetBlock).remove();
        }
    }
}


/**
 * Add one more block when called
 * @param class name
 * @return void
 * */
function moreBlock(targetClass) {

    var targetBlock = '.' + targetClass;

    //get the first service block for cloning
    var newBlock = $(targetBlock).first().clone();

    //setId
    newBlock.attr('id', 'new-' + targetClass + blockCounter);

    //set all the input or text fields to '' for new entry
    newBlock.find(targetBlock + '-input').val('');
    newBlock.find(targetBlock + '-text').html('');

    //insert the new block after the last elemens in this block series
    newBlock.insertAfter($(targetBlock).last());

    blockCounter++;
}


$(function () {
    /****Set today string, and could be utilized in global scope. *** */
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    /****Set today string, and could be utilized in global scope. *** */
});

