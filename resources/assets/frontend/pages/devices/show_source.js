/*** package*/
import Carousel from '../../../components/vendors/Carousel.vue'
import helpers from  '../../../components/helpers.js'


function specObj(key, description) {
    key = (key == null) ? '' : key;
    description = (description == null) ? '' : description;

    return {
        title: key,
        description: description,
    };
}


/***Filter**********/
import formatDollar from '../../../components/filters/currency.js'
Vue.filter('currency', formatDollar);

import activeText from '../../../components/filters/activeText.js'
Vue.filter('activeText', activeText)

import text from '../../../components/filters/text.js'
Vue.filter('text', text)

var userDefault;
userDefault = {
    name: '',
    email: ''
}

var defaultPhotoPath = '/assets/images/cover/coverPhoto.jpg';

/***vue begin************** *****/
var vm = new Vue({
    el: '#app',
    components: {
        Carousel: Carousel
    },
    data: {
        user: {},
        item: {title: 'DeviceTitle', dimension: {width: '', depth: '', height: ''}, cat: {title: ''}},
        itemAddress: '',
        photos: [],
        pics: [],
        discussions: '',
        newDiscussionContent: '',
        newDialogueContent: '',
        activePhoto: {},
        dir: '\\assets\\images\\cover\\',
        discussionPrefix: 'discussion-',
    },
    computed: {
        chosenPhoto: function () {
            return this.dir + this.activePhoto;
        },
        isLegalUser: function () {
            return !helpers.isEmpty(this.user);
        },
    },
    methods: {
        toggleItemActive: function () {
            var url = '/ajax/frontend/devices/toggleActive/' + this.item.id;
            var data = {
                active: this.item.active
            };
            var callback = function (data, status) {
                this.item = data;
            }.bind(this);

            $.post(url, data, callback);
        },
        updateActivePhoto: function (photo) {
            this.activePhoto = photo;
        },
        raiseDiscussion: function () {
            var content = $('#discussion-content').val();

            if (content != '') {
                var url = '/ajax/frontend/devices/raiseDiscussion/' + this.item.id;
                var data = {
                    content: content
                };
                var callback = function (data, status) {
                    this.newDiscussionContent = '';
                    this.discussions.unshift(data);
                }.bind(this);

                $.post(url, data, callback);
            }
        },
        ceaseDiscussion: function (discussion) {
            if (confirm('確定要刪除留言?')) {
                var url = '/ajax/frontend/devices/ceaseDiscussion/' + discussion.id;
                var data = {};
                var callback = function (data, status) {
                    var index = this.discussions.indexOf(discussion);
                    if (index != (-1)) {
                        this.discussions.splice(index, 1);
                    }
                }.bind(this);

                $.post(url, data, callback);
            }
        },
        joinDiscussion: function (discussionId) {
            var dialogueContentId = '#discussion-' + discussionId;
            var content = $(dialogueContentId).val();

            if (content != '') {
                var url = '/ajax/frontend/devices/joinDiscussion/' + discussionId;
                var data = {
                    content: content
                };
                var doWhenSuccess = function (data, status) {
                    //empty the dialogue input
                    $(dialogueContentId).val('');

                    //find out the designated discussion
                    //push dialogue into discussion.dialogues
                    var arrayLength = this.discussions.length;
                    for (var i = 0; i < arrayLength; i++) {
                        if (this.discussions[i].id == discussionId) {
                            this.discussions[i].dialogues.push(data);
                        }
                    }
                }.bind(this);

                $.post(url, data, doWhenSuccess);
            }
        },
        leaveDiscussion: function (dialogue) {
            if (confirm('確定要刪除留言?')) {
                var url = '/ajax/frontend/devices/leaveDiscussion/' + dialogue.id;
                var data = {};
                var callback = function (data, status) {
                    var arrayLength = this.discussions.length;
                    for (var i = 0; i < arrayLength; i++) {
                        //get the designated discussion
                        if (this.discussions[i].id == dialogue.discussion_id) {
                            //remove the dialogues from the array
                            var index = this.discussions[i].dialogues.indexOf(dialogue);
                            if (index != (-1)) {
                                this.discussions[i].dialogues.splice(index, 1);
                            }
                        }
                    }
                }.bind(this);

                $.post(url, data, callback);
            }
        },
        toggleLike: function () {
            var url = '/ajax/frontend/devices/toggleLike/' + this.item.id;
            var data = {};
            var callback = function (data, status) {
                this.item = data;
            }.bind(this);

            $.post(url, data, callback);
        },
        sendMailToSeller: function () {
            $('#emailModal').modal('hide');
            var data = $('#emailModalForm').serialize();
            var url = '/ajax/frontend/sendSellerMail/' + this.item.id;
            var doWhenSuccess = function (data, status) {
                alert('郵件已成功寄出');
            };

            $.post(url, data, doWhenSuccess)
                .fail(function () {
                    alert('郵件寄出失敗\n建議您可以直接用電話或利用其他訊息與賣家聯絡');
                });
        },
        filePath(obj){
            if (!obj) {
                return defaultPhotoPath;
            }
            return obj.filepath;
        }
    },
    beforeMount(){
        initUser(this);
        this.item = JSON.parse($('#itemInfo').val());
        this.discussions = JSON.parse($('#deviceDiscussion').val());
        //this.itemAddress = helpers.addressObjToText(this.item.address);
        //initActivePhotos(this);
        //initPics(this);
    }
});

function initPics(vm) {
    var photos = vm.item.photos;
    var length = photos.length;
    var picArray = [];
    for (var i = 0; i < length; i++) {
        picArray.push(
            {src: photos[i].filepath, alt: ''}
        )
    }
    vm.pics = picArray;
}

function initUser(vm) {
    var userInfo = $('#userInfo').val();
    vm.user = (userInfo != '') ?
        vm.user = JSON.parse(userInfo) :
        userDefault;
}

function initActivePhotos(vm) {
    vm.activePhoto = vm.item.photos[0];
}

$(document).ready(function () {
    $('#emailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-title').text('寄送郵件給賣家');
        $('#sender-name').val(vm.user.name);
        $('#sender-email').val(vm.user.email);
    })
});
/***vue end************** *****/


