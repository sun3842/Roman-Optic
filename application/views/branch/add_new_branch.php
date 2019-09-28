<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css') ?>">
<style type="text/css" rel="stylesheet">
    .btn-md-circle{
        height: 35px;
        width: 35px;
        border-radius: 20px;
    }

    .btn-social{
        background: transparent;
        border: 1px solid #515151;
        color: #515151;
    }
    .btn-social.btn-active{
        background-color: #34CAA7;
        border: none;
        color: white;
    }
    .social-site .btn-social{
        margin: 0 10px 0 10px;
    }
    .div-paste{
        background-color: #35C9A7;
        color: white;
        padding: 15px 10px 15px 10px;
    }

    table>thead>tr{
        color: #35C9A7;
        background-color: transparent;
    }

</style>
<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading">CONTACT US</label>
            <a href="<?php echo site_url('all_branch');?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> BACK</a>
        </div>
    </div>

    <form name="contact_us_form" id="contact_us_form" action="<?php echo site_url('add_branch');?>" method="post">

        <center><?php echo validation_errors(); ?></center>

        <div class="row">

        <h3 class="mb-5">ADD CONTACT</h3>

        <div class="col-12 my-3">
            <label>SHOP/ORGANIZATION NAME<span class="text-red"><b>*</b></span></label>
            <input type="text" class="form-control" name="shop_name">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>SHOP REGISTER NO.</label>
            <input type="text" class="form-control" name="reg_no">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>IS MAIN BRANCH</label>
            <select name="is_main_branch">
                <option value="0">NO</option>
                <option value="1">YES</option>
            </select>
        </div>

        <div class="col-12 my-3">
            <label>ABOUT SHOP<span class="text-red"><b>*</b></span></label>
            <textarea name="shop_details"></textarea>
        </div>
        <div class="col-12">
            <h5 class="my-3">LOCATION</h5>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>COUNTRY<span class="text-red"><b>*</b></span></label>
            <select name="country_list" id="country_list">
                <option value="">SELECT COUNTRY</option>
                <?php
                foreach($countries as $country)
                {
                    ?>
                    <option value="<?php echo $country['countries_id'];?>"><?php echo $country['countries_name'];?></option>
                    <?php
                }
                ?>

            </select>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>REGION<span class="text-red"><b>*</b></span></label>
            <select name="state_list" id="state_list">
                <option value=""></option>
            </select>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>CITY<span class="text-red"><b>*</b></span></label>
            <select name="city_list" id="city_list">
                <option value=""></option>
            </select>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 my-3">
            <label>ADDRESS<span class="text-red"><b>*</b></span></label>
            <input type="text" class="form-control" name="shop_address">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>POST CODE<span class="text-red"><b>*</b></span></label>
            <input type="text" class="form-control" name="post_code">
        </div>

        <div class="col-12">
            <h5 class="my-3">CONTACT</h5>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>PHONE (COUNTRY CODE)<span class="text-red"><b>*</b></span></label>
            <select name="phone_code_country_id" id="phone_code_country_id">
                <option value="">COUNTRY PHONE CODE</option>
                <?php
                foreach($countries as $country)
                {
                    ?>
                    <option value="<?php echo $country['countries_id'];?>"><?php echo $country['countries_name']."-".$country['countries_sortname']."-".$country['countries_phonecode'];?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>PHONE (COUNTRY CODE)<span class="text-red"><b>*</b></span></label>
            <input type="text" class="form-control" name="country_phone_code" id="country_phone_code" readonly>

        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>PHONE NUMBER<span class="text-red"><b>*</b></span></label>
            <input type="text" class="form-control" name="phone_number">
        </div>
        <!--
                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
                    <label class="label-block">SHARE ON SOCIAL MEDIA</label>
                    <div class="social-site">
                        <button class="btn-md-circle btn-social btn-active"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn-md-circle btn-social btn-active"><i class="fab fa-twitter"></i></button>
                        <button class="btn-md-circle btn-social"><i class="fab fa-google-plus-g"></i></button>
                    </div>
                </div>
                -->

            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
                <label>EMAIL</label>
                <input type="email" class="form-control" name="shop_email">
            </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <label>WEBSITE</label>
            <input type="text" class="form-control" name="shop_website">
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <label>FACEBOOK</label>
            <input type="text" class="form-control" name="shop_facebook">
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <label>GOOGLE PLUS</label>
            <input type="text" class="form-control" name="shop_google_plus">
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <label>LINKEDIN</label>
            <input type="text" class="form-control" name="shop_linkedin">
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <label>TWITTER</label>
            <input type="text" class="form-control" name="shop_twitter">
        </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
                <label>INSTAGRAM</label>
                <input type="text" class="form-control" name="shop_instagram">
            </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <label>TIMETABLE<span class="text-red"><b>*</b></span></label>
            <select name="select_branch_time_table" id="select_branch_time_table">
                <option value="0">NOT AVAILABLE</option>
                <option value="1">ALWAYS OPEN</option>
                <option value="2">SELECTED TIMETABLE</option>
            </select>
        </div>


            <div class="row" id="timetable_section"><!--START TIMETABLE SECTION-->


            <div class="col-12">
                <h5 class="my-3">SET SCHEDULE</h5>
            </div>
            <div class="col-12 div-paste">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <select name="timetable_day" id="timetable_day">
                            <option value="0">SELECT YOUR DAY</option>
                            <option value="1">SATURDAY</option>
                            <option value="2">SUNDAY</option>
                            <option value="3">MONDAY</option>
                            <option value="4">TUESDAY</option>
                            <option value="5">WEDNESDAY</option>
                            <option value="6">THURSDAY</option>
                            <option value="7">FRIDAY</option>
                        </select>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <select name="timetable_option" id="timetable_option" disabled>
                            <option value="">SLECT OPEN/CLOSE</option>
                            <option value="1">OPEN</option>
                            <option value="0">CLOSE</option>
                        </select>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <input type="text" name="timetable_start_time" id="timetable_start_time"  class="form-control time-picker" placeholder="START TIME" disabled>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <input type="text" name="timetable_end_time" id="timetable_end_time" class="form-control time-picker" placeholder="END TIME" disabled>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <button class="btn btn-block" id="add_timetable_button" disabled>ADD</button>
                    </div>

                </div>
            </div>
            <div class="col-12 table-responsive my-3">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>DAY</th>
                        <th>STATUS</th>
                        <th>START</th>
                        <th>END</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>MON</td>
                        <td id="mon_status"></td>
                        <td><span id="mon_slot_start_time_1"></span> <br/><span id="mon_slot_start_time_2"></span></td>
                        <td><span id="mon_slot_end_time_1"></span> <br/><span id="mon_slot_end_time_2"></span></td>
                        <td>

                            <input type="hidden" name="h_mon_status" id="h_mon_status" value="0">
                            <input type="hidden" name="h_mon_slot_start_time_1" id="h_mon_slot_start_time_1" value="">
                            <input type="hidden" name="h_mon_slot_start_time_2" id="h_mon_slot_start_time_2" value="">
                            <input type="hidden" name="h_mon_slot_end_time_1" id="h_mon_slot_end_time_1" value="">
                            <input type="hidden" name="h_mon_slot_end_time_2" id="h_mon_slot_end_time_2" value="">
                            <input type="hidden" name="h_mon_total_slot" id="h_mon_total_slot" value="0">

                            <span id="mon_delete_slot_1"></span>
                            <br>

                            <span id="mon_delete_slot_2"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>TUE</td>
                        <td id="tue_status"></td>
                        <td><span id="tue_slot_start_time_1"></span> <br/><span id="tue_slot_start_time_2"></span></td>
                        <td><span id="tue_slot_end_time_1"></span> <br/><span id="tue_slot_end_time_2"></span></td>
                        <td>

                            <input type="hidden" name="h_tue_status" id="h_tue_status" value="0">
                            <input type="hidden" name="h_tue_slot_start_time_1" id="h_tue_slot_start_time_1" value="">
                            <input type="hidden" name="h_tue_slot_start_time_2" id="h_tue_slot_start_time_2" value="">
                            <input type="hidden" name="h_tue_slot_end_time_1" id="h_tue_slot_end_time_1" value="">
                            <input type="hidden" name="h_tue_slot_end_time_2" id="h_tue_slot_end_time_2" value="">
                            <input type="hidden" name="h_tue_total_slot" id="h_tue_total_slot" value="0">

                            <span id="tue_delete_slot_1"></span>
                            <br>

                            <span id="tue_delete_slot_2"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>WED</td>
                        <td id="wed_status"></td>
                        <td><span id="wed_slot_start_time_1"></span> <br/><span id="wed_slot_start_time_2"></span></td>
                        <td><span id="wed_slot_end_time_1"></span> <br/><span id="wed_slot_end_time_2"></span></td>
                        <td>

                            <input type="hidden" name="h_wed_status" id="h_wed_status" value="0">
                            <input type="hidden" name="h_wed_slot_start_time_1" id="h_wed_slot_start_time_1" value="">
                            <input type="hidden" name="h_wed_slot_start_time_2" id="h_wed_slot_start_time_2" value="">
                            <input type="hidden" name="h_wed_slot_end_time_1" id="h_wed_slot_end_time_1" value="">
                            <input type="hidden" name="h_wed_slot_end_time_2" id="h_wed_slot_end_time_2" value="">
                            <input type="hidden" name="h_wed_total_slot" id="h_wed_total_slot" value="0">

                            <span id="wed_delete_slot_1"></span>
                            <br>

                            <span id="wed_delete_slot_2"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>THURS</td>
                        <td id="thurs_status"></td>
                        <td><span id="thurs_slot_start_time_1"></span> <br/><span id="thurs_slot_start_time_2"></span></td>
                        <td><span id="thurs_slot_end_time_1"></span> <br/><span id="thurs_slot_end_time_2"></span></td>
                        <td>

                            <input type="hidden" name="h_thurs_status" id="h_thurs_status" value="0">
                            <input type="hidden" name="h_thurs_slot_start_time_1" id="h_thurs_slot_start_time_1" value="">
                            <input type="hidden" name="h_thurs_slot_start_time_2" id="h_thurs_slot_start_time_2" value="">
                            <input type="hidden" name="h_thurs_slot_end_time_1" id="h_thurs_slot_end_time_1" value="">
                            <input type="hidden" name="h_thurs_slot_end_time_2" id="h_thurs_slot_end_time_2" value="">
                            <input type="hidden" name="h_thurs_total_slot" id="h_thurs_total_slot" value="0">

                            <span id="thurs_delete_slot_1"></span>
                            <br>

                            <span id="thurs_delete_slot_2"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>FRI</td>
                        <td id="fri_status"></td>
                        <td><span id="fri_slot_start_time_1"></span> <br/><span id="fri_slot_start_time_2"></span></td>
                        <td><span id="fri_slot_end_time_1"></span> <br/><span id="fri_slot_end_time_2"></span></td>
                        <td>


                            <input type="hidden" name="h_fri_status" id="h_fri_status" value="0">
                            <input type="hidden" name="h_fri_slot_start_time_1" id="h_fri_slot_start_time_1" value="">
                            <input type="hidden" name="h_fri_slot_start_time_2" id="h_fri_slot_start_time_2" value="">
                            <input type="hidden" name="h_fri_slot_end_time_1" id="h_fri_slot_end_time_1" value="">
                            <input type="hidden" name="h_fri_slot_end_time_2" id="h_fri_slot_end_time_2" value="">
                            <input type="hidden" name="h_fri_total_slot" id="h_fri_total_slot" value="0">


                            <span id="fri_delete_slot_1"></span>
                            <br>

                            <span id="fri_delete_slot_2"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>SAT</td>
                        <td id="sat_status"></td>
                        <td><span id="sat_slot_start_time_1"></span> <br/><span id="sat_slot_start_time_2"></span></td>
                        <td><span id="sat_slot_end_time_1"></span> <br/><span id="sat_slot_end_time_2"></span></td>
                        <td>

                            <input type="hidden" name="h_sat_status" id="h_sat_status" value="0">
                            <input type="hidden" name="h_sat_slot_start_time_1" id="h_sat_slot_start_time_1" value="">
                            <input type="hidden" name="h_sat_slot_start_time_2" id="h_sat_slot_start_time_2" value="">
                            <input type="hidden" name="h_sat_slot_end_time_1" id="h_sat_slot_end_time_1" value="">
                            <input type="hidden" name="h_sat_slot_end_time_2" id="h_sat_slot_end_time_2" value="">
                            <input type="hidden" name="h_sat_total_slot" id="h_sat_total_slot" value="0">

                            <span id="sat_delete_slot_1"></span>
                            <br>

                            <span id="sat_delete_slot_2"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>SUN</td>
                        <td id="sun_status"></td>
                        <td><span id="sun_slot_start_time_1"></span> <br/><span id="sun_slot_start_time_2"></span></td>
                        <td><span id="sun_slot_end_time_1"></span> <br/><span id="sun_slot_end_time_2"></span></td>
                        <td>

                            <input type="hidden" name="h_sun_status" id="h_sun_status" value="0">
                            <input type="hidden" name="h_sun_slot_start_time_1" id="h_sun_slot_start_time_1" value="">
                            <input type="hidden" name="h_sun_slot_start_time_2" id="h_sun_slot_start_time_2" value="">
                            <input type="hidden" name="h_sun_slot_end_time_1" id="h_sun_slot_end_time_1" value="">
                            <input type="hidden" name="h_sun_slot_end_time_2" id="h_sun_slot_end_time_2" value="">
                            <input type="hidden" name="h_sun_total_slot" id="h_sun_total_slot" value="">


                            <span id="sun_delete_slot_1"></span>
                            <br>

                            <span id="sun_delete_slot_2"></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>



        </div><!--END TIMETABLE SECTION-->



        <div class="col-12 text-center">
            <button class="btn-common">CONFIRM</button>
        </div>
    </div>

    </form>
</div>
<script type="text/javascript" rel="script"
        src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js') ?>"></script>
<script type="text/javascript" rel="script">


    $('#timetable_section').hide();

    $('#select_branch_time_table').change(function () {
        var selected_timetable_type_id=$(this).val();
        if(selected_timetable_type_id==2)
        {
            $('#timetable_section').show();
        }
        else
        {
            $('#timetable_section').hide();
        }
    });

    $('#phone_code_country_id').change(function()
    {
        var selected_country_code_value=$("#phone_code_country_id option:selected").text();
        var c_code_array=selected_country_code_value.split("-");
        $('#country_phone_code').val(c_code_array[2]);
    });
    $('#country_list').change(function () {
        var selected_country_id=$(this).val();

        $("#phone_code_country_id").val(selected_country_id);
        var selected_country_code_value=$("#phone_code_country_id option:selected").text();
        var c_code_array=selected_country_code_value.split("-");
        $('#country_phone_code').val(c_code_array[2]);


        $.ajax({
            type: 'POST',
            url: 'Common/for_ajax_get_all_states_by_country_id',
            data: {country_id : selected_country_id},
            success: function (result) {
                // result=$.parseJSON(result);

                var options="<option value=''>SELECT REGION</option>";
                for(var i=0;i<result.length;i++)
                {
                    options=options+"<option value='"+result[i]['states_id']+"'>"+result[i]['states_name']+"</option>"
                }
                $('#city_list').html("");
                $('#state_list').html(options);
                console.log(result);
            },
            error: function (error) {
                console.log(error);
            }
        });

    });



    $('#state_list').change(function () {
        var selected_state_id=$(this).val();

        $.ajax({
            type: 'POST',
            url: 'Common/for_ajax_get_all_cities_by_state_id',
            data: {state_id : selected_state_id},
            success: function (result) {


                var options="<option value=''>SELECT CITY</option>";
                for(var i=0;i<result.length;i++)
                {
                    options=options+"<option value='"+result[i]['cities_id']+"'>"+result[i]['cities_name']+"</option>"
                }
                $('#city_list').html(options);
                console.log(result);
            },
            error: function (error) {
                console.log(error);
            }
        });

    });

    $('.time-picker').datetimepicker({
        datepicker: false,
        format: 'H:i',
        step: 15,
        defaultTime:'08:00'
    });



    $('#timetable_option').change(function () {
        var open_close_status=$(this).val();

        if(open_close_status==1)
        {

            $(".time-picker").removeAttr("disabled");
            $(".time-picker").val("00:00");
        }
        else {
            $(".time-picker").prop("disabled", "disabled");
            $(".time-picker").val("");
        }

        if(open_close_status==1 || open_close_status==0)
        {
            $("#add_timetable_button").removeAttr("disabled");
        }
        else
        {
            $("#add_timetable_button").prop("disabled", "disabled");
        }




    });

    $('#timetable_day').change(function () {
        var selected_day_no=$(this).val();

        if(selected_day_no!=0)
        {

            $("#timetable_option").removeAttr("disabled");

        }
        else {
            $("#timetable_option").prop("disabled", "disabled");
            $(".time-picker").prop("disabled", "disabled");
            $("#add_timetable_button").prop("disabled", "disabled");
        }



    });

    /*
    var mon_slot=1;
    var tue_slot=1;
    var wed_slot=1;
    var thurs_slot=1;
    var fri_slot=1;
    var sat_slot=1;
    var sun_slot=1;
*/
    var slot_no_array= [0,0,0,0,0,0,0,0];


    $('#add_timetable_button').click(function(e){
        e.preventDefault();

        var time_table_option=$("#timetable_option").val();
        var timetable_day=$("#timetable_day").val();
        var timetable_start_time=$("#timetable_start_time").val();
        var timetable_end_time=$("#timetable_end_time").val();

        if(timetable_day!=0 && (time_table_option==1 || time_table_option==0))
        {
            var tag="";

            if(timetable_day==3 )//monday
            {
                var tag="mon";
            }
            else if(timetable_day==4 )//Tuesday
            {
                var tag="tue";
            }
            else if(timetable_day==5 )//Wednesday
            {
                var tag="wed";
            }
            else if(timetable_day==6  )//Thursday
            {
                var tag="thurs";
            }
            else if(timetable_day==7  )//Friday
            {
                var tag="fri";
            }
            else if(timetable_day==1  )//Saturday
            {
                var tag="sat";
            }
            else if(timetable_day==2  )//Sunday
            {
                var tag="sun";
            }
            var status_value=time_table_option==1?"OPEN":"CLOSE";
            $("#"+tag+"_status").html(status_value);

            $("#h_"+tag+"_status").val(time_table_option);

            if(time_table_option==0)
            {

                slot_no_array[timetable_day]=0;
                $("#"+tag+"_slot_start_time_1").html("");
                $("#"+tag+"_slot_end_time_1").html("");
                $("#"+tag+"_delete_slot_1").html('<a href="javascript:void(0)" class="action action-delete" onclick="delet_time_slot('+timetable_day+','+slot_no_array[timetable_day]+');"><i class="far fa-trash-alt"></i></a>');

                $("#"+tag+"_slot_start_time_2").html("");
                $("#"+tag+"_slot_end_time_2").html("");
                $("#"+tag+"_delete_slot_2").html('');

                $("#h_"+tag+"_slot_start_time_1").val("");
                $("#h_"+tag+"_slot_end_time_1").val("");
                $("#h_"+tag+"_slot_start_time_2").val("");
                $("#h_"+tag+"_slot_end_time_2").val("");

                $("#h_"+tag+"_total_slot").val(slot_no_array[timetable_day]);

            }
            else if(slot_no_array[timetable_day]<2) {

                slot_no_array[timetable_day]=slot_no_array[timetable_day]+1;

                $("#h_"+tag+"_total_slot").val(slot_no_array[timetable_day]);

                $("#"+tag+"_slot_start_time_"+slot_no_array[timetable_day]).html(timetable_start_time);
                $("#"+tag+"_slot_end_time_"+slot_no_array[timetable_day]).html(timetable_end_time);
                $("#"+tag+"_delete_slot_"+slot_no_array[timetable_day]).html('<a href="javascript:void(0)" class="action action-delete" onclick="delet_time_slot('+timetable_day+','+slot_no_array[timetable_day]+');"><i class="far fa-trash-alt"></i></a>');

                $("#h_"+tag+"_slot_start_time_"+slot_no_array[timetable_day]).val(timetable_start_time);
                $("#h_"+tag+"_slot_end_time_"+slot_no_array[timetable_day]).val(timetable_end_time);
                //slot_no_array[timetable_day]=slot_no_array[timetable_day]+1;
            }
        }


    });



    function delet_time_slot(timetable_day,slot_no)
    {

        var tag="";

        if(timetable_day==3 )//monday
        {
            var tag="mon";
        }
        else if(timetable_day==4 )//Tuesday
        {
            var tag="tue";
        }
        else if(timetable_day==5 )//Wednesday
        {
            var tag="wed";
        }
        else if(timetable_day==6  )//Thursday
        {
            var tag="thurs";
        }
        else if(timetable_day==7  )//Friday
        {
            var tag="fri";
        }
        else if(timetable_day==1  )//Saturday
        {
            var tag="sat";
        }
        else if(timetable_day==2  )//Sunday
        {
            var tag="sun";
        }
        if(slot_no_array[timetable_day]==1)
        {
            $("#"+tag+"_status").html("");
            $("#h_"+tag+"_status").val("0");
        }
        if( $("#h_"+tag+"_status").val()==0)
        {
            $("#"+tag+"_status").html("");
            $("#h_"+tag+"_status").val("0");
            $("#"+tag+"_slot_start_time_1").html("");
            $("#"+tag+"_slot_end_time_1").html("");
            $("#"+tag+"_delete_slot_1").html('');

        }

        slot_no_array[timetable_day]=slot_no_array[timetable_day]-1;
        $("#"+tag+"_slot_start_time_"+slot_no).html("");
        $("#"+tag+"_slot_end_time_"+slot_no).html("");
        $("#"+tag+"_delete_slot_"+slot_no).html('');



        $("#h_"+tag+"_slot_start_time_"+slot_no).val("");
        $("#h_"+tag+"_slot_end_time_"+slot_no).val("");
        $("#h_"+tag+"_slot_start_time_"+slot_no).val("");
        $("#h_"+tag+"_slot_end_time_"+slot_no).val("");

        if(slot_no_array[timetable_day]<0)
        {
            slot_no_array[timetable_day]=0;
        }
        $("#h_"+tag+"_total_slot").val(slot_no_array[timetable_day]);

    }


    $('#contact_us_form').validate({
        rules: {
            shop_name: {
                required: true
            },
            shop_details:{
                required:true
            },
            country_list:{
                required:true
            },
            state_list:{
                required:true
            },

            city_list:{
                required:true
            },
            country_phone_code:{
                required:true,
                digits: true
            },
            phone_number:{
                required:true
            },
            select_branch_time_table:{
                required:true
            },
            shop_email:{
                email:true
            },
            shop_website:{
                url:true
            },
            shop_facebook:{
                url:true
            },
            shop_google_plus:{
                url:true
            },
            shop_linkedin:{
                url:true
            },
            shop_twitter:{
                url:true
            },
            shop_instagram:{
                url:true
            }



        },
        messages: {

        }
    });
</script>