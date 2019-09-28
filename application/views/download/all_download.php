<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css')?>">
<style type="text/css" rel="stylesheet">
    .box-white{
        background-color: white;
        display: block;
    }
    .logo-lg{
        font-size: 50px;
    }

    .row>div{
        margin: 4px 0 12px 0;
    }


    .img-product{
        width: 120px;
        height: 120px;
    }


    .news_details_text{

        font-weight: bold;
        font-size: small;
        font-weight: bold;
        color: #595959;

    }

    .downloader_id_visibilty{

        visibility: hidden;
    }
    .operation_button{

        border: none;
        background-color: transparent;
    }


    @media only screen and (min-width: 200px) and (max-width: 320px){
        .news_details_text{
            font-size: x-small;
        }
    }

</style>
<div class="content">

    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading font-color"><?php echo $this->lang->line('app_installed_user_list');?>   </label>
            <a href="<?php echo base_url('home')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i><?php echo $this->lang->line('back');?></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
            <div class="box-white text-center p-5">
                <i class="fas fa-download logo-lg font-color"></i>
                <p class="my-2 font-weight-bold font-color"><?php echo $this->lang->line('total_download');?> </p>
                <h4 class="text-paste"><?php echo sizeof($downloads)?></h4>
                <p class="my-2 font-weight-bold font-color"><?php echo $this->lang->line('times');?></p>
            </div>
        </div>
<!--        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3 p-2">-->
<!--            <div class="box-white text-center p-5">-->
<!--                <i class="fas fa-mobile-alt logo-lg font-color"></i>-->
<!--                <p class="my-2 font-weight-bold font-color">--><?php //echo $this->lang->line('installed');?><!--</p>-->
<!--                <h4 class="text-paste">--><?php //echo $this->lang->line('total_installed_num');?><!--</h4>-->
<!--                <p class="my-2 font-weight-bold font-color">--><?php //echo $this->lang->line('times');?><!--</p>-->
<!--            </div>-->
<!--        </div>-->
        <?php
        $total_registered=0;
        foreach ($downloads AS $download)
        {
            if($download['downloaded_user_first_name']!='' && $download['downloaded_user_last_name']!='')
            {
                $total_registered=$total_registered+1;
            }
        }
        ?>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
            <div class="box-white text-center p-5">
                <i class="fas fa-user logo-lg font-color"></i>
                <p class="my-2 font-weight-bold font-color"><?php echo $this->lang->line('registered');?></p>
                <h4 class="text-paste"><?php echo $total_registered?></h4>
                <p class="my-2 font-weight-bold font-color"><?php echo $this->lang->line('people');?></p>
            </div>
        </div>
<!--        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3 p-2">-->
<!--            <div class="box-white text-center p-5">-->
<!--                <i class="fas fa-ban logo-lg font-color"></i>-->
<!--                <p class="my-2 font-weight-bold font-color">--><?php //echo $this->lang->line('un_install');?><!--</p>-->
<!--                <h4 class="text-paste">--><?php //echo $this->lang->line('total_un_installed_num');?><!--</h4>-->
<!--                <p class="my-2 font-weight-bold font-color">--><?php //echo $this->lang->line('people');?><!--</p>-->
<!--            </div>-->
<!--        </div>-->

    </div>

    <div class="row my-3">
        <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 py-2">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="<?php echo $this->lang->line('search');?>" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 py-2">
            <input type="text" class="date-time-picker form-control" placeholder="<?php echo $this->lang->line('select_date');?>">
        </div>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped" id="product_table">
                <thead>

                <tr>
                    <th><?php echo $this->lang->line('name');?></th>
                    <th><?php echo $this->lang->line('device');?></th>
                    <th><?php echo $this->lang->line('status');?></th>
                    <th><?php echo $this->lang->line('operation');?></th>
                </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($downloads as $download) {  ?>
                    
                <tr>
                    <td class="<?php echo ($download['downloaded_user_active']==0) ? "text-danger" : ''?>"> <?php echo $download['downloaded_user_first_name'] . " " . $download['downloaded_user_last_name']; ?></td>
                    <td><?php echo $download['device_type_name'] ?></td>
                    <td><?php echo $download['downloaded_user_first_name'] !=null ? 'REGISTERED' : 'NOT REGISTERED' ?></td>
                     <td>
                        <a href="#" onclick='user_details_view(<?php echo json_encode($download,JSON_HEX_APOS);?>,event)' class="action-view px-2"><i class="fas fa-eye "></i></a>
                       <button name="send_user_message" id="send_user_message" onclick='user_message(<?php echo json_encode($download,JSON_HEX_APOS);?>,event)' class="operation_button action-edit px-2"><i class="fas fa-envelope "></i></button>
                        <button  id="block_user" onclick='user_band(<?php echo json_encode($download,JSON_HEX_APOS);?>,event)' class="action-edit px-2 operation_button"> <i class="fas fa-ban"></i></button>
                    </td>
                </tr>

                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal send Message-->
<form id="message_send" method="POST">
<div class="modal fade" id="modal_send_msg" tabindex="-1" role="dialog" aria-labelledby="modal_send_msg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('user_message');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
               <div class="row box-off-white p-0 m-0">
                   <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                       <img class="img-product" src="<?php echo base_url('assets/images/product/product_view.png')?>" width="100%">
                   </div>


                   <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <input type="text" class="downloader_id_visibilty" name="downloader_id" id="downloader_id" value="">
                       <label class="label-block mt-4 font-weight-bold"><span id="user_message_fname"></span><span> </span> <span id="user_message_lname"></span></label>
                       <label class="label-block font-weight-bold"><?php echo $this->lang->line('user_id');?><span id="user_message_userID"></span></label>
                   </div>

               </div>

               
                <div class="row p-4">
                    <p class="text-center font-color"><?php echo $this->lang->line('you_can_send_message_individual_person_please_write_your_message_title_and_full_message');?></p>
                    <div class="col-12 my-2">
                        <input type="text" name="message_title" id="message_title" class="form-control">
                    </div>
                    <div class="col-12 my-2">
                        <textarea name="message_description" id="message_description"></textarea>
                    </div>
                    <div class="col-12 my-2">
                        <input type="checkbox" name="push_notification" id="push_notification"> <label><?php echo $this->lang->line('send_push_notification');?></label>
                    </div>
                    <div class="col-12 my-2">
                        <input type="submit" name="send_message" id="send_message" class="btn-paste btn-block py-2" value="<?php echo $this->lang->line('send');?>">
                    </div>
                </div> 

           
        </div>

        </div>
    </div>
</div>

</form>


<!-- Modal USER BAND-->
<form id="block_user_button"  method="POST">
<div class="modal fade" id="modal_user_band" tabindex="-1" role="dialog" aria-labelledby="modal_user_band" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('block_user');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="row box-off-white p-0 m-0">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <img class="img-product" src="<?php echo base_url('assets/images/product/product_view.png')?>" width="100%">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <input type="text" class="downloader_id_visibilty" name="downloader_block_id" id="downloader_block_id" value="">
                        <label class="label-block mt-4 font-weight-bold"><span id="user_band_fname"></span><span> </span> <span id="user_band_lname"></span></label>
                        <label class="label-block font-weight-bold"><?php echo $this->lang->line('user_id');?><span id="user_band_userID"></span></label>
                    </div>

                </div>

                 
                <div class="row p-4">
                    <div class="col-12 text-center my-2">
                       
                        <img class="img-product" src="<?php echo base_url('assets/images/download/block.png')?>" >
                    </div>
                    <p class="text-center font-color px-3"><?php echo $this->lang->line('you_can_use_app_but_there_will_be_no_option_to_give_any_kind_of');?><span class="text-paste"><?php echo $this->lang->line('feedback_or_message');?></span><?php echo $this->lang->line('to_admin_when_we_unblock_user_then_they_can_send_feedback_or_message_aggain');?></p>
                    <div class="col-12 my-2">
                        <label><?php echo $this->lang->line('blocking_reason');?><span class="font-color small px-2"><?php echo $this->lang->line('only_admin_can_see');?></span></label>
                    </div>
                    <div class="col-12 my-2">
                        <input type="text" name="block_user" id="block_user" class="form-control">
                    </div>
                    <div class="col-12 my-2">
                        <input type="submit" name="block_user_button" id="submit" class="btn-paste btn-block py-2" value="BLOCK">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</form>




<!-- unblock model -->
<form  method="POST">
<div class="modal fade" id="modal_user_unblock" tabindex="-1" role="dialog" aria-labelledby="modal_user_unblock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('block_user');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="row box-off-white p-0 m-0">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <img class="img-product" src="<?php echo base_url('assets/images/product/product_view.png')?>" width="100%">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <input type="text" class="downloader_id_visibilty" name="downloader_unblock_id" id="downloader_unblock_id" value="">
                        <label class="label-block mt-4 font-weight-bold"><span id="user_unblock_fname"></span><span> </span> <span id="user_unblock_lname"></span></label>
                        <label class="label-block font-weight-bold"><?php echo $this->lang->line('user_id');?><span id="user_unblock_userID"></span></label>
                    </div>

                </div>

                 
                <div class="row p-4">
                    <div class="col-12 text-center my-2">
                       
                        <img class="img-product" src="<?php echo base_url('assets/images/download/block.png')?>" >
                    </div>
                    <p class="text-center font-color px-3"><?php echo $this->lang->line('you_can_use_app_but_there_will_be_no_option_to_give_any_kind_of');?><span class="text-paste"><?php echo $this->lang->line('feedback_or_message');?></span><?php echo $this->lang->line('to_admin_when_we_unblock_user_then_they_can_send_feedback_or_message_again');?></p>
                    
                    <div class="col-12 my-2">
                        <input type="submit" name="unblock_user_button" id="unblock_user_button" class="btn-paste btn-block py-2" value="UNBLOCK">
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>
</form>





<!--modal view-->
<div class="modal fade bd-example-modal-lg" id="user_details" tabindex="-1" role="dialog" aria-labelledby="user_details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="dialog_header" id="exampleModalLongTitle"><center><?php echo $this->lang->line('user_details');?></center></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff">&times;</span>
                </button>
            </div>


                <div class="row box-off-white p-0 m-0">

                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">

                        <img class="" src="<?php echo base_url('assets/images/product/product_view.png')?>"  width ="100%">

                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">

                        <div class="row">

                            <div class="col-12 text-weight-bold"><label><?php echo $this->lang->line('user_name');?></label ><label ><span class="p-2">:</span ><span id="user_details_view_userFName"> </span><span> </span><span id="user_details_view_userLName"></span></label></div>
                            <div class="col-12"><label><?php echo $this->lang->line('device_type');?></label><label><span class="p-2">:</span><span id="user_details_view_deviceType"></span></label></div>
                        </div>


                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">

                        <div class="row">
                            <div class="col-12 text-weight-bold"><label><?php echo $this->lang->line('user_id');?></label><label><span class="p-2">:</span><span id="user_details_view_userID"></span></label></div>
                            <div class="col-12"><label><?php echo $this->lang->line('installing_date');?></label><label><span class="p-2">:</span><span id="user_details_view_installingDate"></span></label></div>
                        </div>

                    </div>
                </div>

                <div class="row news_details_text light-white p-0 m-0">


                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('name_inside_model');?></label> <label><span class="p-2">:</span><span id="user_details_view_FName"> </span><span> </span><span id="user_details_view_LName"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('gender');?></label> <label><span class="p-2">:</span><span id="user_details_view_downloaded_user_gender_type"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('nationality');?></label> <label><span class="p-2">:</span><span id="user_details_view_nationality"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('date_of_birth');?></label> <label><span class="p-2">:</span><span id="user_details_view_download_user_birthdate"><?php  ?></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('occupation');?></label><label><span class="p-2">:</span><span id="user_details_view_occupation"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('status');?></label><label><span class="p-2">:</span><span id="user_details_view_status"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('email_address');?></label><label><span class="p-2">:</span><span id="user_details_view_emailAddress"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('phone');?></label><label><span class="p-2">:</span><span id="user_details_view_downloaded_user_phone_no"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('country');?></label><label><span class="p-2">:</span><span id="user_details_view_country"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('region');?></label><label><span class="p-2">:</span><span id="user_details_view_region"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('city');?></label> <label><span class="p-2">:</span><span id="user_details_view_city"></span></label></div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6"><label><?php echo $this->lang->line('zip_post_code');?></label><label><span class="p-2">:</span><span id="user_details_view_downloaded_user_post_code_no"></span></label></div>
                    <div class="col-12"><label><?php echo $this->lang->line('address');?></label> <label><span class="p-2">:</span><span id="user_details_view_downloaded_user_address"></span></label></div>

                </div>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js')?>"></script>
<script type="text/javascript" rel="script">
    $('.date-time-picker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });

  
    $('#block_user_button').validate({
        
        rules:{

            block_user:{

                required: true,
            }


        }
    });

     $('#message_send').validate({
        
        rules:{

            message_title:{

                required: true,
            },

            message_description:{

                required: true,
            }

        }
    });


    function user_message(user_array,event) {
        event.preventDefault();
        $('#user_message_fname').html("");
        $('#user_message_lname').html("");
        $('#user_message_userID').html("");

        $('#downloader_id').val(user_array['downloaded_user_id']);
        $('#user_message_fname').html(user_array['downloaded_user_first_name']);
        $('#user_message_lname').html(user_array['downloaded_user_last_name']);
        $('#user_message_userID').html(user_array['downloaded_user_unique_client_id']);
        $('#modal_send_msg').modal('show');
    }
    function user_band(user_array,event) {
        event.preventDefault();

        if(user_array['downloaded_user_active'] == 1){
        $('#user_band_fname').html("");
        $('#user_band_lname').html("");
        $('#user_band_userID').html("");

        $('#downloader_block_id').val(user_array['downloaded_user_id']);
        $('#user_band_fname').html(user_array['downloaded_user_first_name']);
        $('#user_band_lname').html(user_array['downloaded_user_last_name']);
        $('#user_band_userID').html(user_array['downloaded_user_unique_client_id']);

        
        $('#modal_user_band').modal('show');
    }

    else{

        $('#user_unblock_fname').html("");
        $('#user_unblock_lname').html("");
        $('#user_unblock_userID').html("");

        $('#downloader_unblock_id').val(user_array['downloaded_user_id']);
        $('#user_unblock_fname').html(user_array['downloaded_user_first_name']);
        $('#user_unblock_lname').html(user_array['downloaded_user_last_name']);
        $('#user_unblock_userID').html(user_array['downloaded_user_unique_client_id']);
        $('#modal_user_unblock').modal('show');

    }

    }

    function user_details_view(user_array,event) {
        event.preventDefault();
        
        var gender_type ="";
        switch(user_array['downloaded_user_gender']){

            case '0' : gender_type = "Nothing";
                       break;

            case '1' : gender_type = "Men";
                       break;

            case '2' : gender_type = "Women";
                       break;

            case '3' : gender_type = "Other";
                       break;

           
        }
         

        $('#user_details_view_userFName').html("");
        $('#user_details_view_userLName').html("");
        $('#user_details_view_userLName').html("");
        $('#user_details_view_deviceType').html("");
        $('#user_details_view_userID').html("");
        $('#user_details_view_installingDate').html("");
        $('#user_details_view_userFName').html("");
        $('#user_details_view_userLName').html("");
        $('#user_details_view_emailAddress').html("");
        $('#user_details_view_download_user_birthdate').html("");
        $('#user_details_view_downloaded_user_address').html("");
        $('#user_details_view_downloaded_user_phone_no').html("");
        $('#user_details_view_downloaded_user_post_code_no').html("");
        $('#user_details_view_downloaded_user_gender_type').html("");
        $('#user_details_view_nationality').html("");
        $('#user_details_view_occupation').html("");
        $('#user_details_view_status').html("");
        $('#user_details_view_country').html("");
        $('#user_details_view_region').html("");
        $('#user_details_view_city').html("");


        
        $('#user_details_view_userFName').html(user_array['downloaded_user_first_name']);
        $('#user_details_view_userLName').html(user_array['downloaded_user_last_name']);
        $('#user_details_view_deviceType').html(user_array['device_type_name']);
        $('#user_details_view_userID').html(user_array['downloaded_user_unique_client_id']);
        $('#user_details_view_installingDate').html((user_array['downloaded_user_created_date_time']));
        $('#user_details_view_FName').html(user_array['downloaded_user_first_name']);
        $('#user_details_view_LName').html(user_array['downloaded_user_last_name']);
        $('#user_details_view_emailAddress').html(user_array['downloaded_user_email']);
        $('#user_details_view_download_user_birthdate').html(user_array['downloaded_user_birth_date']);
        $('#user_details_view_downloaded_user_address').html(user_array['downloaded_user_address']);
        $('#user_details_view_downloaded_user_phone_no').html(user_array['downloaded_user_phone']);
        $('#user_details_view_downloaded_user_post_code_no').html(user_array['downloaded_user_post_code']);
        $('#user_details_view_downloaded_user_gender_type').html(gender_type);
        $('#user_details_view_nationality').html(user_array['countries_name']);
        $('#user_details_view_occupation').html(user_array['occupation_list_name']);
        $('#user_details_view_status').html(user_array['marital_status_name']);
        $('#user_details_view_country').html(user_array['countries_name']);
        $('#user_details_view_region').html(user_array['states_name']);
        $('#user_details_view_city').html(user_array['cities_name']);


        $('#user_details').modal('show');
    }


</script>