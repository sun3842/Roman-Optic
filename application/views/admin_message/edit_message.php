<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.css') ?>">
<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins/jquery-ui-1.12.1/jquery-ui.css') ?>">


<style type="text/css" rel="stylesheet">

    .row > div {
        margin: 4px 0 12px 0;
    }

    .target_general_message {

        display: inline-block;
        background-color: #A1A1A1;
    }

    .target_general_message button.active {

        color: #fff;
        background-color: #515151;
    !important;

    }

    .message_button {

        background-color: transparent;
        font-size: small;
        text-align: center;
        border: none;
        cursor: pointer;
    }

    .margin_tar_gen_button {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .text_checkbox {

        font-size: 12px;
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


</style>


<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>


    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('message');?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i><?php echo $this->lang->line('back');?></a>
        </div>
    </div>

    <label class="page-heading"><?php echo $this->lang->line('create_message');?></label>


    <div class="margin_tar_gen_button">

        <div class="target_general_message">

            <button id="bu1" class=" p-2  message_button <?php if($message['ref_message_target_type_id'] ==1 ) echo 'active'?>" ><?php echo $this->lang->line('general_message');?></button>

            <button id="bu2" class="p-2   message_button <?php if($message['ref_message_target_type_id'] == 2 ) echo 'active'?>" ><?php echo $this->lang->line('target_message');?></button>

        </div>
    </div>

    <form id="message_form" method="POST">


            <div class="row">
                <div class="col-12">
                    <label class="text-small"><?php echo $this->lang->line('message_title');?><span class="text-red">*</span></label>
                    <input type="text" name="message_title" id="message_title" class="form-control" value="<?php echo $message['message_title'] ?>">
                </div>

                <div class="col-12">
                    <label class="text-small"><?php echo $this->lang->line('message_description');?><span class="text-red">*</span></label>
                    <textarea name="message_description" id="message_description" ><?php echo $message['message_details'] ?></textarea>
                </div>


    <div id="trMessage" <?php if($message['ref_message_target_type_id'] == 2 ) {?> style=" display: block;" <?php } else{ ?>
        style=" display: none;" <?php } ?> >

        <div class="row p-3">

            <div class="col-12">
                <level class="text-paste text-medium font-weight-bold"><?php echo $this->lang->line('who_will_get_this_message');?></level>
            </div>

            <div class="col-12 my-3">

                <label class="mr-3 text-bold"><input type="checkbox" name="gender" id="gender" <?php echo ($message['is_condition_gender']==1)?'checked':'' ?>><?php echo $this->lang->line('gender');?></label><br>
                <label class="mr-3 text_checkbox"><input type="checkbox" name="men" id="men" class="gender_type" <?php echo ($message['is_condition_gender']==1)?'':'disabled';  if($message['condition_gender'] == 1 || $message['condition_gender'] == 4 ) { echo 'checked'; } else{ echo '';}?> ><?php echo $this->lang->line('men');?></label>
                <label class="mr-3 text_checkbox"><input type="checkbox" name="women" id="women" class="gender_type" <?php echo ($message['is_condition_gender']==1)?'':'disabled'; if($message['condition_gender'] == 2|| $message['condition_gender'] == 4 ) { echo 'checked'; } else{ echo '';}?>><?php echo $this->lang->line('women');?></label>
               
            </div>
        
        
         
            
             <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
                        <label class="text-small"><input type="checkbox" id="s_city" name="is_target_city" <?php echo ($message['is_condition_city']==1)?'checked':'' ?>><?php echo $this->lang->line('select_city');?></label>
                        <select id="select_city" name="city_id" class="text-small" <?php echo ($message['is_condition_city']==1)?'':'disabled' ?>>
<!--                            --><?php //foreach ($cities as $city) { ?>
<!--                                <option value="--><?php //echo $city['cities_id'] ?><!--" --><?php //echo ($city['cities_id']==$message['condition_cities_id'])?'selected':'' ?><!-->--><?php //echo $city['cities_name'] ?><!--</option>-->
<!--                            --><?php //} ?>
                        </select>
                    </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
                        <label class="text-small"><input type="checkbox" name="is_target_occupation" id="s_occupation" <?php echo ($message['is_condition_occupation']==1)?'checked':'' ?>><?php echo $this->lang->line('select_occupation');?></label>
                        <select id="select_occupation" name="occupation_id"  class="text-small" <?php echo ($message['is_condition_occupation']==1)?'':'disabled' ?>>
                            <?php foreach ($occupation_list AS $occupation){ ?>
                                <option class="text-small" value="<?php echo $occupation['occupation_list_id']?>" <?php echo ($occupation['occupation_list_id']==$message['condition_occupation_list_id'])?'selected':''?>><?php echo $occupation['occupation_list_name']?></option>
                            <?php } ?>
                        </select>
                    </div>



            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
                        <label class="text-small"><input type="checkbox" name="is_target_marital_status" id="s_marital_status" <?php echo ($message['is_condition_marital_status']==1)?'checked':'' ?>><?php echo $this->lang->line('select_marital_status');?></label>
                        <select id="select_marital_status" name="marital_status"  class="text-small" <?php echo ($message['is_condition_marital_status']==1)?'':'disabled' ?>>
                            <?php foreach ($marital_status AS $status){ ?>
                                <option class="text-small" value="<?php echo $status['marital_status_id']?>" <?php echo ($status['marital_status_id']==$message['condition_marital_status_id'])?'checked':''?>><?php echo $status['marital_status_name']?></option>
                            <?php } ?>
                        </select>
                    </div>

         


    

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                        <label class="text-small"><input type="checkbox" id="s_age_lmit" name="select_age_lmit" <?php echo ($message['is_condition_age_range']==1)?'checked':'' ?>><?php echo $this->lang->line('choose_age_limite');?></label>
                        <input type="text" id="select_age_lmit" name="select_age_lmit" readonly class="slide_range"  <?php echo ($message['is_condition_age_range']==1)?'':'disabled' ?>>
                        <div id="slider-range"></div>
                    </div>



            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                        <label class="text-small"><input type="checkbox" id="c_birthdate" name="is_target_birthday" <?php echo ($message['is_condition_birth_date']==1)?'checked':'' ?>><?php echo $this->lang->line('choose_birthdate');?></label>
                        <input type="text" class="date-time-picker form-control" name="birthday" id="choose_birthdate" value="<?php echo $message['condition_birth_date']?>" placeholder="<?php echo $this->lang->line('select_date');?>" <?php echo ($message['is_condition_birth_date']==1)?'':'disabled' ?>>
                    </div>

</div>
 
        <div class="col-12 text-medium"><label><input type="checkbox" name="match_all_condition" id="match_all_condition" <?php 
        if($message['match_all_conditions'] == 1 ) { echo 'checked'; }?>><?php echo $this->lang->line('match_all_condition');?></label>
            </div>

        </div>



                <div class="col-12"><label class="text-medium"><input type="checkbox" name="push_notification" id="push_notification" <?php 
                if($message['message_is_push_notification'] == 1 ) { echo 'checked'; } ?> ><?php echo $this->lang->line('send_push_notification');?></label></div>


                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
                    <button type="submit" id="general_confirm" name="<?php echo ($message['ref_message_target_type_id']==1 ? "general_confirm":"target_confirm"); ?>" class="btn-common"><?php echo $this->lang->line('confirm');?></button>
                </div>   

        </div>

    <form>


  

</div>


    <script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js') ?>"></script>


    <script type="text/javascript" rel="script">
        $('.date-time-picker').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
        });


    </script>

    <script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins/jquery-ui-1.12.1/jquery-ui.js') ?>"></script>

      <script type="text/javascript" rel="script">
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 1,
                max: 100,
                values: [<?php echo ($message['condition_starting_age']=='')?25:$message['condition_starting_age']?>, <?php echo ($message['condition_ending_range']=='')?60:$message['condition_ending_range']?>],
                slide: function (event, ui) {
                    $("#select_age_lmit").val(" " + ui.values[0] + " - " + ui.values[1]);
                }
            });
            $("#select_age_lmit").val(" " + $("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1));
        });


    </script>

    <script type="text/javascript" rel="script">

        var x = document.getElementById("bu1");
        var y = document.getElementById("bu2");
        var k = document.getElementById("trMessage");

        x.addEventListener("click", tFunction);
        y.addEventListener("click", gFunction);





    

     
           $('#bu2').click(function(){
           $('#general_confirm').attr('name', 'target_confirm');
    });
       

       

          $('#bu1').click(function(){
          $('#general_confirm').attr('name', 'general_confirm');
        
    });
    


        function tFunction() {

            k.style.display = "none";
            $(this).addClass('active');
            $('#bu2').removeClass('active');

        }

        function gFunction() {

            k.style.display = "block";
            $(this).addClass('active');
            $('#bu1').removeClass('active');
        }





    $('#gender').change(function () {
        if($(this).prop('checked')==true)
        {
            $('.gender_type').prop('disabled',false);
        }
        else
        {
            $('.gender_type').prop('disabled',true);
            $('.gender_type').prop('checked',false);
        }
    });

    $('#s_city').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#select_city').prop('disabled',false);
        }
        else
        {
            $('#select_city').prop('disabled',true);
        }
    });

    $('#s_occupation').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#select_occupation').prop('disabled',false);
        }
        else
        {
            $('#select_occupation').prop('disabled',true);
        }
    });

    $('#s_marital_status').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#select_marital_status').prop('disabled',false);
        }
        else
        {
            $('#select_marital_status').prop('disabled',true);
        }
    });

    $('#s_age_lmit').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#select_age_lmit').prop('disabled',false);
        }
        else
        {
            $('#select_age_lmit').prop('disabled',true);
        }
    });

    $('#c_birthdate').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#choose_birthdate').prop('disabled',false);
        }
        else
        {
            $('#choose_birthdate').prop('disabled',true);
        }
    });



        message_city_id= <?php echo ($message['condition_cities_id']!='')?$message['condition_cities_id']:-1 ?>;
        function get_all_cities() {
            $.ajax({
                url:'<?php echo site_url('get_all_city')?>',
                type: 'GET',
                success: function (result) {
//                alert(result);
                    var cities=$.parseJSON(result);
                    var total_cities=cities.length;
                    for (var i=0;i<total_cities;i++){
                        $('#select_city').append('<option value="'+cities[i]['cities_id']+'">'+cities[i]['cities_name']+'</option>');
                    }

                    $('#select_city').val(message_city_id);
                },
                error: function (error) {
                    alert(error);
                }
            });
        }
        $(document).ready(function () {
            get_all_cities();
        });

        $('#message_form').validate({
            rules: {
                message_title: {
                    required : true,
                },
                message_description: {
                    required: true
                }
            }
        });

    </script>