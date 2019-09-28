<style type="text/css" rel="stylesheet">

    .div-user-list {
        height: 5px;
    }

    .chat-box, .div-user-list {
        height: 500px;
        overflow-y: scroll;
        /*position: relative;*/
    }

    .ul-heading {
        background-color: #35C9A8;
        text-align: center;
        color: white;
        font-size: large;
        padding: 10px;
        position: absolute;
        z-index: 800;
    }

    .search-box {
        background-color: white;
        border: none;
        width: 100%;
        height: 40px;
    }

    .ul-ul-list {
        list-style-type: none;
        padding: 0;
        width: 100%;
    }

    .img-user {
        height: 50px;
        width: 50px;
        border-radius: 30px;
        display: inline-block;

    }

    .ul-ul-list > li {
        padding-top: 15px;
        width: 100%;
        border-bottom: 2px solid #6B6B6B;
    }

    .label-user {
        width:;
    }

    .box-lemon {
        background-color: #D5F4ED;
    }

    .user-chats {
        margin-top: 150px;
    }

    .from-user {
        text-align: left;
        display: block;
        min-height: 74px;
    }

    .from-user > label {
        background-color: #E2E2E2;
        padding: 5px;
        border-radius: 5px;
    }

    .from-me {
        text-align: right;
        display: block;
        min-height: 74px;
    }

    .from-me > img {
        float: right;
    }

    .from-me > label {
        background-color: #35C9A8;
        padding: 5px;
        border-radius: 5px;
    }

    .btn-ul-list {
        display: none;
    }

    .chat-user {
        text-decoration: none;
        color: black;
    }

    ul > li > a:hover {
        text-decoration: none;
        color: black;
        cursor: pointer;
    }

    .input-chat {
        display: block;
        font-size: large;
        padding: 10px;
        position: absolute;
        z-index: 800;
        bottom: -70px;

    }

    .ul-search {
        position: absolute;
        margin-top: 50px;
        z-index: 800;
    }

    .user-list {
        margin-top: 100px;
    }

    ul > li > a > label:hover {
        cursor: pointer;
    }

    /*.users{*/
    /*font-size: 7px;*/
    /*}*/
    @media screen and (min-width: 200px ) and (max-width: 767px) {
        .chats {
            display: none;
        }

        .btn-ul-list {
            display: block;
        }
    }

    @media screen and (min-width: 200px) and (max-width: 320px) {
        .users {
            font-size: x-small;
        }
    }

    @media screen and (min-width: 768px) and (max-width: 1086px) {
        .users {
            font-size: 6px;
        }
    }
</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>
    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('chat')?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 users">
            <div class="row box-off-white div-user-list p-0">
                <div class="col-12 ul-heading">
                    <label><?php echo $this->lang->line('back')?></label>
                </div>
                <div class="col-12 p-0 ul-search">
                    <input type="text" class="search-box" placeholder="<?php echo $this->lang->line('search_here')?>....">
                </div>
                <div class="col-12 user-list">
                    <ul class="ul-ul-list">
                        <?php if (isset($chat_users)) { ?>
                            <?php foreach ($chat_users AS $chat_user) { ?>
                                <li>
                                    <a href="#" onclick='selected_user(<?php echo json_encode($chat_user,JSON_HEX_APOS) ?>, event)'
                                       class="chat-user"
                                       content="<?php echo $chat_user['ref_chat_downloaded_user_id'] ?>">
                                        <img class="img-user mb-4"
                                             src="<?php echo base_url('assets/images/product/product_view.png') ?>">
                                        <label class="label-user"><?php echo $chat_user['downloaded_user_first_name'] . ' ' . $chat_user['downloaded_user_last_name'] ?>
                                            <br/>
                                            <span class="last-message"><?php echo $chat_user['chat_message'] ?></span>
                                        </label>
                                        <span class="float-right"
                                              id="<?php echo $chat_user['ref_chat_downloaded_user_id'] ?>_active_time"><?php $diff = date_diff(date_create($chat_user['chat_sending_date_time']), date_create(date('Y-m-d h:i:sa')));
                                            echo $diff->format('%h h %i m'); ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-7 ml-lg-4 ml-md-4 ml-sm-0 chats">
            <div class="row box-lemon chat-box" id="chat_box">
                <div class="col-12 ul-heading">
                    <label class="label-block"
                           id="user_name"><?php if(isset($chat_users)){echo $chat_users[0]['downloaded_user_first_name'] . ' ', $chat_users[0]['downloaded_user_last_name'];} else echo 'No user Found'; ?></label>
                    <p id="active_name"><?php echo $this->lang->line('active_for_minutes')?></p>
                    <button class="btn btn-sm float-right btn-ul-list"><i class="fas fa-users"></i></button>
                </div>
                <div class="user-chats col-12" id="chat_box_message">
                    <?php if (isset($last_user_chat)) { ?>
                        <?php foreach ($last_user_chat AS $item) { ?>
                            <div class="<?php echo ($item['chat_message_from_app_admin'] == 1) ? 'from-me' : 'from-user' ?>">
                                <img class="img-user mb-4"
                                     src="<?php echo base_url('assets/images/product/product_view.png') ?>"><label
                                        class="p-2"><?php echo $item['chat_message'] ?></label>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>
                <div class="input-chat col-12">
                    <form id="form_message" name="form_message" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-8">
                                <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('type_your_message_here')?>..."
                                       aria-describedby="basic-addon" id="text_message" name="text_message">
                                <input type="hidden" id="chat_user" name="chat_user"
                                       value="<?php if(isset($chat_users)){echo $chat_users[0]['ref_chat_downloaded_user_id'];} else echo ''?>">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-block btn-paste " id="btn_message_send" type="button"><i
                                            class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript" rel="script">
    $('.btn-ul-list').click(function () {
        $('.users').css('display', 'block');
        $('.chats').css('display', 'none');
    });
    $('body').on('click', '.chat-user', function (event) {
        event.preventDefault();
        if ($(window).width() < 768) {
            $('.users').css('display', 'none');
            $('.chats').css('display', 'block');
        }

    });

    ///****************************************************start chat box-*****************************************************************************//
    selected_user_id =<?php if(isset($chat_users))echo $chat_users[0]['ref_chat_downloaded_user_id']; else echo '-1'?>;
    last_message_id =<?php  if(isset($chat_users))echo $chat_users[0]['chat_id'];else echo '-1';?>;

    function selected_user(user, event) {
        event.preventDefault();
        selected_user_id = user['ref_chat_downloaded_user_id'];
        $('#user_name').html(user['downloaded_user_first_name'] + " " + user['downloaded_user_last_name']);

        $('#chat_box_message').empty();
        $('#chat_user').val(user['ref_chat_downloaded_user_id']);
        last_message_id = -1;

    }

    function refresh_chat_box() {
//       alert(selected_user_id);
        $.ajax({
            url: '<?php echo site_url('refresh_chat_box')?>',
            type: 'POST',
            data: {chat_user_id: selected_user_id},
            success: function (result) {
//                alert(result);
                var messages = $.parseJSON(result);
                var total_msg_num = messages.length;
//                console.log(total_msg_num);
                var temp_last_chat_id = last_message_id;
                for (var i = 0; i < total_msg_num; i++) {
                    if (parseInt(messages[i]['chat_id'], 10) > temp_last_chat_id) {
                        var message_from = 'from-user';
                        if (messages[i]['chat_message_from_app_admin'] == 1) {
                            message_from = 'from-me';
                        }
                        $('#chat_box_message').append('<div class="' + message_from + '">\n' +
                            '<img class="img-user mb-4" src="<?php echo base_url('assets/images/product/product_view.png')?>"><label class="p-2">' + messages[i]["chat_message"] + '</label>\n' +
                            ' </div>');
                        temp_last_chat_id = messages[i]['chat_id'];
                    }
                }
                if (temp_last_chat_id != last_message_id) {
                    var element = document.getElementById("chat_box");
                    element.scrollTop = element.scrollHeight;
                    last_message_id = temp_last_chat_id;
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }


    $('#btn_message_send').click(function () {
        var msg = $('#text_message').val();
        if (msg != '') {
            var form = $("#form_message")[0];
            var data = new FormData(form);
            $.ajax({
                url: '<?php echo base_url('new_message');?>',
                type: "POST",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                data: data,
                error: function (error) {
                    console.log(error);
                    alert(error);
                },
                success: function (result) {

                    console.log(result);
                    $('#text_message').val('');

                }
            });
        }
    });


    $(document).keypress(function (event) {

        if (event.which == 13) {

            $('#btn_message_send').trigger('click');

            return false;

        }

    });

    setInterval(function () {
        refresh_chat_box();
    },500);

    //*********************************************************for scrolling div first time loading*******************///
    var element = document.getElementById("chat_box");
    element.scrollTop = element.scrollHeight;


    //****************************************************for refresh user list*****************************************///

    current_user_list_length= <?php echo DEFAULT_DATA_LIMIT ?>;

    function refresh_user_list() {
        $.ajax({
           url: '<?php echo site_url("refresh_user_list")?>',
           type: 'POST',
           data: {total_display_user: current_user_list_length} ,
            success: function (result) {
//                alert(result);

                var users=$.parseJSON(result);
                var total_user=users.length;
                $('.ul-ul-list').empty();
                for(var i=0;i<total_user;i++)
                {
                    $('.ul-ul-list').append("<li><a href='#' onclick='selected_user("+JSON.stringify(users[i])+", event)' class='chat-user'><img class='img-user mb-4' src='<?php echo base_url('assets/images/product/product_view.png')?>'\n" +
                        "><label class='label-user'>"+users[i]['downloaded_user_first_name']+' '+users[i]['downloaded_user_last_name']+" <br/><span class='last-message'>"+users[i]['chat_message']+"</span></label><span class='float-right'>10min ago</span></a></li>");


                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    $('.div-user-list').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            current_user_list_length=parseInt(current_user_list_length)+<?php echo DEFAULT_DATA_LIMIT ?>;
            refresh_user_list();
        }
    });
    setInterval(function () {
        refresh_user_list();
    },15000);
</script>



