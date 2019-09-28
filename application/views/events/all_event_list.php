<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css') ?>">
<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins//jquery-ui-1.12.1/jquery-ui.css') ?>">


<style type="text/css" rel="stylesheet">

    .row > div {
        margin: 4px 0 12px 0;
    }

    .event_four_button_backgroundCol_display {

        display: inline-block;
        background-color: #FFF;
    }

    .event_four_button_backgroundCol_display button.active {

        color: #fff;
        background-color: #515151;
    !important;

    }

    .text_checkbox {

        font-size: x-small;
        color: #595959;
    }

    .slide_range {
        color: #f6931f;
        font-weight: bold;
        margin-left: 15px;
        text-align: center;
        margin-bottom: 30px;
        border: none;
    }

    .no {

        width: 50%;
        background-color: #515151;
        color: #fff;
    }

    .yes {

        width: 50%;
        background-color: #35C9A7;
        color: #fff;
    }

    .btn-load-more {
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }

    .modal-header {
        background-color: #34CAA7;
        color: white;
        text-align: center;
    }

    .img-product {
        width: 100%;
    }

    .clip-board-text {
        width: 100%;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 2px solid #34CAA7;
        outline: none;
    }

    .clip-board-btn {
        color: black;
        text-decoration: none;
        border-bottom: 1px solid black;
    }

    .clip-board-btn:hover {
        color: black;
        text-decoration: none;
    }

    .btn-md-circle {
        height: 35px;
        width: 35px;
        border-radius: 22px;
        border: none;
    }


</style>


<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('all_event')?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>

    <a href="<?php echo site_url('create_event') ?>" class="btn-common" style="float: right;"><?php echo $this->lang->line('create_event')?></a>


    <div class="margin_msg_event_button_">

        <div class="event_four_button_backgroundCol_display mb-5">
            <select id="event_list_type" name="event_list_type" class="btn-paste px-2">
                <option value="0"><?php echo $this->lang->line('all')?></option>
                <option value="1"><?php echo $this->lang->line('on_going')?></option>
                <option value="2"><?php echo $this->lang->line('up_coming')?></option>
            </select>
        </div>
    </div>

    <div>

        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped text-center" id="table_event">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line('image')?></th>
                        <th><?php echo $this->lang->line('title')?></th>
                        <th><?php echo $this->lang->line('start_date_time')?></th>
                        <th><?php echo $this->lang->line('end_date_time')?></th>
                        <th><?php echo $this->lang->line('location')?></th>
                        <th><?php echo $this->lang->line('action')?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($events AS $event) { ?>
                        <tr>
                            <td><img class="table-img"
                                     src="<?php if ($event['events_images_location'] == '') echo 'http://placehold.it/75x75&text=Event'; else echo site_url($event['events_images_location']); ?>">
                            </td>
                            <td><?php echo $event["events_title"] ?></td>
                            <td><?php echo ($event['events_starting_date_time']!='')?date_format(new DateTime($event['events_starting_date_time']), 'd F Y'):''; ?></td>
                            <td><?php echo ($event['events_ending_date_time']!='')?date_format(new DateTime($event['events_ending_date_time']), 'd F Y'):''; ?></td>
                            <td><?php echo $event['events_location']; ?></td>
                            <td>
                                <a href="<?php echo site_url('event_details/' . $event['events_id']) ?>"
                                   class="action action-view"><i class="fas fa-eye"></i></a>
                                <a href="<?php echo site_url('edit_event/' . $event["events_id"]) ?>"
                                   class="action action-edit"><i class="far fa-edit"></i></a>
                                <a href="#" onclick='DELETE_EVENT(<?php echo $event["events_id"] ?>,event)'
                                   class="action action-delete"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php } ?>



                    <!---->
                    <!---->
                    <!--                 <tr>-->
                    <!--                    <td><img class="table-img" src= "http://placehold.it/75x75&text=Event"></td>-->
                    <!--                    <td>EID FEST 2018</td>-->
                    <!--                    <td>13 April 2018</td>-->
                    <!--                    <td>12 May 2018</td>-->
                    <!--                    <td>Mirput, Dhaka</td>-->
                    <!--                    <td>-->
                    <!--                        <a href="#" class="action action-view"><i class="fas fa-eye"></i></a>-->
                    <!--                        <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>-->
                    <!--                        <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>-->
                    <!--                    </td>-->
                    <!--                </tr>-->


                    </tbody>
                </table>
            </div>
            <div class="col-12 text-center mt-1 div-load-more">
                <button class="text-paste btn-load-more"><i class="fas fa-angle-down"></i></button>
                <label style="font-size: small; color: #35C9A7;display: block;" class="text-center"><?php echo $this->lang->line('more')?></label>
            </div>

        </div>

        <div class="modal fade bd-example-modal-lg" id="delete_modal" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-sm">
                    <div class="modal-header">
                        <h5 class="dialog_header text-align-center " id="exampleModalLongTitle">
                            <center><?php echo $this->lang->line('delete_event')?>!!!</center>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: #fff">&times;</span>
                        </button>
                    </div>

                    <div class="dialog_margin">


                        <div class="news_details_text" style="overflow: hidden">
                            <p class="text-justify text-center text-small py-3">
                                <?php echo $this->lang->line('do_you_want_to_delete_event')?>?
                            </p>

                            <div class="row">
                                <button class="no btn py-1 col-6" data-dismiss="modal" aria-label="Close"><?php echo $this->lang->line('no')?></button>
                                <a href="#" id="delete_event" class="yes btn  py-1 col-6"><?php echo $this->lang->line('yes')?></a>
                            </div>


                        </div>
                    </div>
                </div>
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


        function DELETE_EVENT(id,event) {
            event.preventDefault();
            $('#delete_event').attr('href', '<?php echo site_url('delete_event/')?>' + id);
            $('#delete_modal').modal('show');
        }

        all_event_list_starting_limit=<?php echo DEFAULT_DATA_LIMIT?>;

        $("#event_list_type").change(function () {
            var event_list_type=$(this).val();
            $('#table_event').find('tbody').empty();
            if(event_list_type==0)
            {
                all_event_list_starting_limit=-1;
                $('.div-load-more').css('display','block');
                $('.btn-load-more').trigger('click');
            }
            else
            {
                $('.div-load-more').css('display','none');
                $.ajax({
                    url: '<?php echo site_url("all_ongoing_or_upcoming_event")?>',
                    type: 'POST',
                    data: {event_type:event_list_type},
                    success:function (result) {
                        var events=$.parseJSON(result);
                        var total_event=events.length;
                        for (var i=0;i<total_event;i++){
                            var event_image="http://placehold.it/75x75&text=Event";
                            if(events[i]['events_images_location']!='')
                            {
                                event_image="<?php echo site_url()?>"+events[i]['events_images_location'];
                            }
                            $('#table_event').find('tbody').append(" <tr>\n" +
                                "                                        <td><img class='table-img' src= '"+event_image+"'></td>\n" +
                                "                                        <td>"+events[i]['events_title']+"</td>\n" +
                                "                                        <td>"+events[i]['events_starting_date_time']+"</td>\n" +
                                "                                        <td>"+events[i]['events_ending_date_time']+"</td>\n" +
                                "                                        <td>"+events[i]['events_location']+"</td>\n" +
                                "                                        <td>\n" +
                                "                                            <a href='<?php echo site_url('event_details/')?>"+events[i]['events_id']+"' class='action action-view'><i class='fas fa-eye'></i></a>\n" +
                                "                                            <a href='<?php echo site_url('edit_event/')?>"+events[i]['events_id']+"' class='action action-edit'><i class='far fa-edit'></i></a>\n" +
                                "                                            <a href='#' onclick='DELETE_EVENT("+events[i]['events_id']+",event)' class='action action-delete'><i class='far fa-trash-alt'></i></a>\n" +
                                "                                        </td>\n" +
                                "                                    </tr>");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        });

        $('.btn-load-more').click(function () {
            $.ajax({
                url: '<?php echo uri_string()?>',
                type: 'POST',
                data: {event_starting_limit:all_event_list_starting_limit},
                success:function (result) {
                    var events=$.parseJSON(result);
                    var total_event=events.length;
                    for (var i=0;i<total_event;i++){
                        var event_image="http://placehold.it/75x75&text=Event";
                        if(events[i]['events_images_location']!='')
                        {
                            event_image="<?php echo site_url()?>"+events[i]['events_images_location'];
                        }
                        $('#table_event').find('tbody').append(" <tr>\n" +
                            "                                        <td><img class='table-img' src= '"+event_image+"'></td>\n" +
                            "                                        <td>"+events[i]['events_title']+"</td>\n" +
                            "                                        <td>"+events[i]['events_starting_date_time']+"</td>\n" +
                            "                                        <td>"+events[i]['events_ending_date_time']+"</td>\n" +
                            "                                        <td>"+events[i]['events_location']+"</td>\n" +
                            "                                        <td>\n" +
                            "                                            <a href='<?php echo site_url('event_details/')?>"+events[i]['events_id']+"' class='action action-view'><i class='fas fa-eye'></i></a>\n" +
                            "                                            <a href='<?php echo site_url('edit_event/')?>"+events[i]['events_id']+"' class='action action-edit'><i class='far fa-edit'></i></a>\n" +
                            "                                            <a href='#' onclick='DELETE_EVENT("+events[i]['events_id']+",event)' class='action action-delete'><i class='far fa-trash-alt'></i></a>\n" +
                            "                                        </td>\n" +
                            "                                    </tr>");
                    }
                    if(all_event_list_starting_limit==-1){
                        all_event_list_starting_limit=<?php echo DEFAULT_DATA_LIMIT ?>;
                    }
                    else {
                        all_event_list_starting_limit=parseInt(all_event_list_starting_limit)+<?php echo DEFAULT_DATA_LIMIT ?>;
                    }

                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

    </script>
