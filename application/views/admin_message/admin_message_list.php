<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css') ?>">
<style type="text/css" rel="stylesheet">

    .row > div {
        margin: 4px 0 12px 0;
    }

    .btn-load-more {
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }

    .dialog_box_message_title {

        margin-left: 10px;
        margin-right: 5px;
        margin-top: 10px;
        font-weight: bold;
        float: left;
    }

    .message_details_text {

        font-weight: bold;
        font-size: small;
        font-weight: bold;
        color: #595959;

    }

</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('message'); ?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i
                        class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back'); ?></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box"
                       placeholder="<?php echo $this->lang->line('search'); ?>" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="col-12 table-responsive">
            <table class="table table-striped text-center" id="table_message">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('date'); ?></th>
                    <th><?php echo $this->lang->line('title'); ?></th>
                    <th><?php echo $this->lang->line('type'); ?></th>
                    <th><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>

                <?php foreach ($message as $msg) {

                    ?>

                    <tr>
                        <td><?php echo date_format(new DateTime($msg['message_last_edited_date_time']), 'd F Y'); ?></td>
                        <td><?php echo $msg['message_title'] ?></td>
                        <td><?php echo ($msg['ref_message_target_type_id'] == 1) ? $this->lang->line('general') : (($msg['ref_message_target_type_id'] == 2) ? $this->lang->line('target') : $this->lang->line('personal')); ?></td>
                        <td>
                            <a href="#" class="action action-view"
                               onclick='MessageDetails(<?php echo json_encode($msg, JSON_HEX_APOS); ?>,event)'><i
                                        class="fas fa-eye"></i></a>
                            <a href="<?php echo site_url('edit_message/' . $msg["message_id"]) ?>"
                               class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"
                               onclick='delete_message(<?php echo $msg["message_id"] ?>,event)'><i
                                        class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>

                <?php } ?>

            </table>

        </div>

        <div class="col-12 text-center mt-1">
            <button class="text-paste btn-load-more"><i class="fas fa-angle-down"></i></button>
            <label style="font-size: small; color: #35C9A7;display: block;"
                   class="text-center"><?php echo $this->lang->line('more'); ?></label>
        </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="message_modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title dialog_header"
                        id="exampleModalLongTitle"><?php echo $this->lang->line('message_details'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #fff">&times;</span>
                    </button>
                </div>

                <div class="row" id="div_msg_details">
                    <div class="col-12">
                        <label class="dialog_box_message_title  text-medium" id="message_title"></label>
                    </div>

                    <div class="col-12 message_details_text">
                        <p class="text-justify ml-3" id="message_details"></p>
                    </div>
                    <div class="col-12">
                        <div class="row" id="msg_condition">
                        </div>
                    </div>

                    <!--                        <div class="col-12 ml-3"><label style="color: #35C9A7;">-->
                    <?php //echo $this->lang->line('who_get_message');?><!--</label></div>-->
                    <!---->
                    <!--                        <div class="col-12 ml-3">-->
                    <!--                        <div><label style="font-size: small;">-->
                    <?php //echo $this->lang->line('gender');?><!--<span> :</span><span class="p-1 " id="genderType"></span></label></div>-->
                    <!--                    </div>-->
                    <!---->
                    <!--                    <div class="col-12 ml-3" ><label class="text-small" >-->
                    <?php //echo $this->lang->line('age');?><!--<span id="age_end_limit"></span> -->
                    <?php //echo $this->lang->line('user_feedback');?><!--TO <span id="age_start_limit"></span></label></div>-->

                </div>

            </div>
        </div>
    </div>


    <!-- delete section -->
    <div class="modal fade" id="delete_message_modal" tabindex="-1" role="dialog" aria-labelledby="delete_message_modal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLongTitle"><?php echo $this->lang->line('delete_message'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo site_url('d') ?>">

                    <div class="modal-body">
                        <?php echo $this->lang->line('are_you_sure_to_delete_this_message'); ?>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-danger"
                           id="btn_delete_message"><?php echo $this->lang->line('delete'); ?></a>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" rel="script"
            src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js') ?>"></script>


    <script type="text/javascript" rel="script">
        $('.date-time-picker').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
        });


        function MessageDetails(msg_array, event) {

            console.log(msg_array);

            $('#msg_condition').empty();
            var gender = "";
            switch (msg_array['condition_gender']) {
                case '1':
                    gender = "<?php echo $this->lang->line('user_feedback');?>Men";
                    break;
                case '2':
                    gender = "<?php echo $this->lang->line('user_feedback');?>Women";
                    break;
                case '4':
                    gender = "<?php echo $this->lang->line('user_feedback');?>Men Women";
                    break;
            }


            event.preventDefault();
            $('#message_title').html("");
            $('#message_details').html("");


            $('#message_title').html(msg_array['message_title']);
            $('#message_details').html(msg_array['message_details']);

            if(msg_array['ref_message_target_type_id']==2)
            {
                var conditions='';
                if(msg_array['is_condition_gender']==1)
                {
                    conditions=conditions+'<div class="col-12 ml-3">Gender: '+gender+'</div>'
                }
                if(msg_array['is_condition_occupation']==1)
                {
                    conditions=conditions+'<div class="col-12 ml-3">Occupation: '+msg_array["occupation_list_name"]+'</div>'
                }
                if(msg_array['is_condition_city']==1)
                {
                    conditions=conditions+'<div class="col-12 ml-3">City: '+msg_array["cities_name"]+'</div>'
                }
                if(msg_array['is_condition_age_range']==1)
                {
                    conditions=conditions+'<div class="col-12 ml-3">Age Range: '+msg_array["condition_starting_age"]+'-'+msg_array['condition_ending_range']+'year</div>'
                }
                if(msg_array['is_condition_birth_date']==1)
                {
                    conditions=conditions+'<div class="col-12 ml-3">Dob: '+msg_array["condition_birth_date"]+'</div>'
                }
                if(msg_array['is_condition_marital_status']==1)
                {
                    conditions=conditions+'<div class="col-12 ml-3">Gender: '+msg_array["marital_status_name"]+'</div>'
                }

                $('#msg_condition').append(conditions);

            }


            $('#message_modal').modal('show');
        }

        function delete_message(message_id, event) {
            event.preventDefault();
            $('#btn_delete_message').attr('href', '<?php  echo site_url('delete_message/')?>' + message_id);
            $('#delete_message_modal').modal("show");
        }

        var stating_message_list = '<?php echo DEFAULT_DATA_LIMIT ?>';

        $('.btn-load-more').click(function () {
            $.ajax({
                type: 'POST',
                url: '<?php echo uri_string()?>',
                data: {offer_start_limit: stating_message_list},
                success: function (result) {
                    message = $.parseJSON(result);
                    total_message = message.length;
                    for (var i = 0; i < total_message; i++) {

                        $('#table_message').find('tbody').append("<tr>\n" +
                            "                    <td>" + message[i]['message_last_edited_date_time'] + "</td>\n" +
                            "                    <td>" + message[i]['message_title'] + "</td>\n" +
                            "                    <td>" + message[i]['ref_message_target_type_id'] + "</td>\n" +

                            "                    <td>\n" +
                            "                        <a href='#' onclick='MessageDetails(" + JSON.stringify(message[i]) + ",event)' class='action action-view'><i class='fas fa-eye'></i></a>\n" +
                            "                        <a href='<?php echo site_url('edit_message/')?>" + message[i]['message_id'] + "' class='action action-edit'><i class='far fa-edit'></i></a>\n" +
                            "                        <a href='#' onclick='delete_message(" + message[i]['message_id'] + ",event)' class='action action-delete'><i class='far fa-trash-alt'></i></a>\n" +
                            "                    </td>\n" +
                            "                </tr>");

                    }
                    stating_message_list = parseInt(stating_message_list, 10) +<?php echo DEFAULT_DATA_LIMIT?>;
                },
                error: function (error) {
                    alert(error);
                }
            });

        });


    </script>
