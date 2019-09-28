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

            <button id="bu1" class=" p-2 active message_button"><?php echo $this->lang->line('general_message');?></button>

            <button id="bu2" class="p-2  message_button"><?php echo $this->lang->line('target_message');?></button>

        </div>
    </div>

    <form id="message_form" method="POST">


            <div class="row">
                <div class="col-12">
                    <label class="text-small"><?php echo $this->lang->line('message_title');?><span class="text-red">*</span></label>
                    <input type="text" name="message_title" id="message_title" class="form-control">
                </div>

                <div class="col-12">
                    <label class="text-small"><?php echo $this->lang->line('message_description');?><span class="text-red">*</span></label>
                    <textarea name="message_description" id="message_description" ></textarea>
                </div>


    <div id="trMessage" style="display: none;">

        <div class="row p-3">

            <div class="col-12">
                <level class="text-paste text-medium font-weight-bold"><?php echo $this->lang->line('who_will_get_this_message');?></level>
            </div>

            <div class="col-12 my-3">

                <label class="mr-3 text-bold"><input type="checkbox" name="gender" id="gender" > <?php echo $this->lang->line('gender');?></label><br>
                <label class="mr-3 text_checkbox"><input type="checkbox" name="men" id="men" disabled=""> <?php echo $this->lang->line('men');?></label>
                <label class="mr-3 text_checkbox"><input type="checkbox" name="women" id="women" disabled=""><?php echo $this->lang->line('women');?></label>
                
            </div>
        
        
                 
            
            
            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <label class="text-small"><input type="checkbox" name="s_city" id="s_city"><?php echo $this->lang->line('select_city');?><span class="text-red">*</span></label>
                <select name="select_city" id="select_city" class="text-small" disabled="">
<!--                    --><?php
//                foreach ($cities as $c_list) {
//                      ?>
<!--                    <option  class="text-small" value="--><?php //echo $c_list['cities_id'] ?><!--">--><?php //echo $c_list['cities_name'] ?><!--</option>-->
<!--                    --><?php //} ?>
                    <!-- <option class="text-small">PRODUCT2</option> -->
                </select>
            </div>
          
         
            
            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <label class="text-small"><input type="checkbox" name="s_occupation" id="s_occupation"><?php echo $this->lang->line('select_occupation');?><span class="text-red">*</span></label>
                <select name="select_occupation" class="text-small" id="select_occupation" disabled="">
                       <?php
                    foreach ($occupation_list as $occ_list) {
                      ?>
                    <option class="text-small" value="<?php echo $occ_list['occupation_list_id'] ?>"><?php echo $occ_list['occupation_list_name'] ?></option>
                    <?php } ?>
                    <!-- <option class="text-small">OCCUPATIO2</option> -->
                </select>
            </div>

             

          
            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <label class="text-small"><input type="checkbox" name="s_marital_status" id="s_marital_status"><?php echo $this->lang->line('select_marital_status');?><span class="text-red">*</span></label>
                <select name="select_marital_status" class="text-small" id="select_marital_status" disabled="">
                     <?php
              foreach ($marital_status as $m_status_list) {
                      ?>
                    <option class="text-small" value="<?php echo $m_status_list['marital_status_id'] ?>"><?php echo $m_status_list['marital_status_name'] ?></option>
                      <?php } ?>

                </select>
            </div>

         


            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-5">
                <label class="text-small"><input type="checkbox" name="select_age_lmit" id="s_age_lmit"><?php echo $this->lang->line('choose_age_limite');?></label>
                <input id="select_age_lmit" name="select_age_lmit" type="text" readonly class="slide_range" disabled="">
                <div id="slider-range"></div>
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-5">
                <label class="text-small"><input type="checkbox" name="choose_birthdate" id="c_birthdate"><?php echo $this->lang->line('choose_birthdate');?> </label>
                <input type="text" class="date-time-picker form-control"  name="choose_birthdate" placeholder="Select Date" id="choose_birthdate" disabled="">
            </div>

</div>

            <div class="col-12 text-medium"><label><input type="checkbox" name="match_all_condition" id="match_all_condition"><?php echo $this->lang->line('match_all_condition');?></label>
            </div>

        </div>



                <div class="col-12"><label class="text-medium"><input type="checkbox" name="push_notification" id="push_notification"><?php echo $this->lang->line('send_push_notification');?></label></div>


                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
                    <button type="submit" id="general_confirm" name="general_confirm" class="btn-common"><?php echo $this->lang->line('confirm');?></button>
                </div>   

        </div>

    <form>


  

</div>


    <script type="text/javascript" rel="script"
            src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js') ?>"></script>


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
                values: [10, 60],
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



    $('#bu1').click(function(){
        $('#general_confirm').attr('name', 'general_confirm');
    });

    $('#bu2').click(function(){
        $('#general_confirm').attr('name', 'target_confirm');
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





  document.getElementById('gender').onchange = function()
    {
        document.getElementById('men').disabled = !this.checked;
        document.getElementById('women').disabled = !this.checked;
    
    };

  document.getElementById('s_city').onchange = function()
    {
        document.getElementById('select_city').disabled = !this.checked;
       
    };

    document.getElementById('s_occupation').onchange = function()
    {
        document.getElementById('select_occupation').disabled = !this.checked;
  
    };

    document.getElementById('s_marital_status').onchange = function()
    {
        document.getElementById('select_marital_status').disabled = !this.checked;

    };

    document.getElementById('s_age_lmit').onchange = function()
    {
        document.getElementById('select_age_lmit').disabled = !this.checked;

    };

    document.getElementById('c_birthdate').onchange = function()
    {
        document.getElementById('choose_birthdate').disabled = !this.checked;

    };



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

                },
                error: function (error) {
                    alert(error);
                }
            });
        }
        get_all_cities();

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