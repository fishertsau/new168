<div class="content-block" id="discussion">
    <h4 class="text-danger">留言區</h4>
    <hr class="line-dark">
    {{--留言輸入--}}
    <div class="media"
         style="border: 1px solid lightgray;padding:5px"
         v-show="!item.isSeller"
            >
        <div class="media-left">
            <a href="#">
                <img class="media-object"
                     src="/images/temp/man-icon.jpg"
                     alt="大頭照"
                     style="max-width:25px">
            </a>
        </div>
        <div class="media-body">
            <textarea class="form-control"
                      name="discussion-content"
                      id="discussion-content"
                      v-model="newDiscussionContent"
                      placeholder="輸入給賣家的留言"
                    >
            </textarea>

            <div style="margin-top: 5px">
                <div class="text-danger">
                    &ndash;&nbsp;向賣家提出您的問題 &nbsp;&ndash;
                </div>
                <button class="btn btn-success btn-xs pull-right"
                        @click.prevent="raiseDiscussion"
                        v-show="isLegalUser"
                        >送出留言
                </button>
                &nbsp;
                <a href="/login">
                    <button class="btn btn-primary btn-xs pull-right"
                            v-show="!isLegalUser">
                        登入會員
                    </button>
                </a>
                &nbsp;
            </div>
        </div>

    </div>

    {{--留言歷史--}}
    <div class="media" style="border: 1px solid lightgray;padding:5px"
         v-for="discussion in discussions">
        <div class="media-left">
            <a href="#">
                <img class="media-object"
                     src="/images/temp/man-icon.jpg" alt="大頭照"
                     style="max-width:25px">
            </a>
        </div>
        <div class="media-body">
            <p>@{{discussion.created_at}}</p>

            <p class="media-heading">@{{ discussion.content }} </p>
            <button class="btn btn-danger btn-xs pull-right"
                    @click.prevent="ceaseDiscussion(discussion)"
                    v-if="discussion.user_id == user.id"
                    >
                刪除留言
            </button>
            &nbsp;

            {{--討論對話--}}
            <div class="media" style="border-top: 1px solid lightgray;padding:5px"
                 v-for="dialogue in discussion.dialogues">
                <div class="media-body">
                    <p>賣家答覆 &nbsp; @{{ dialogue.created_at }}</p>

                    <p class="media-heading">
                        <span class="text-primary">@{{ dialogue.content }}</span><br>
                        <button class="btn btn-danger btn-xs pull-right"
                                v-if="dialogue.user_id==user.id"
                                @click.prevent="leaveDiscussion(dialogue)">
                            刪除回答
                        </button>
                        &nbsp;
                    </p>
                </div>
            </div>

            <div class="media"
                 v-if="item.isSeller">
                <div class="media-body">
                     <textarea class="form-control"
                               placeholder="輸入留言回答"
                               :id="discussionPrefix+discussion.id">
                     </textarea>

                    <div style="margin-top: 0.5em;">
                        <button class="btn btn-success btn-xs pull-right"
                                @click.prevent="joinDiscussion(discussion.id)"
                                >
                            送出回答
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>