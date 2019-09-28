<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css') ?>">
<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins//jquery-ui-1.12.1/jquery-ui.css') ?>">
<style type="text/css" rel="stylesheet">

    .row > div {
        margin: 4px 0 12px 0;
    }

    .browse {
        position: absolute;
        width: 100px;
        height: 100px;
        opacity: 0;
        z-index: 100;
    }

    .plus {
        height: 100px;
        width: 100px;
        font-size: xx-large;
        position: absolute;
        z-index: 1;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .upload {
        width: 100px;
        height: 100px;
        position: relative;
        background-color: #CCCCCC;
    }

    .size {

        width: 100px;
        height: 100px;
    }

    .lens_left_right_button {

        display: inline-block;
        background-color: #A1A1A1;
    }

    .lens_left_right_button button.active {

        color: #fff;
        background-color: #35C9A7;
    !important;

    }

    .lens_button_margin {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .lens_style_button {

        font-size: small;
        text-align: center;
        border: none;
        cursor: pointer;
    }

    /*.plus_sign_style{*/

    /*color:#fff;*/
    /*border-radius: 16px;*/
    /*width: 32px;*/
    /*height: 32px;*/
    /*background-color: #35C9A7;*/
    /*}*/

    /*.minus_sign_style{*/

    /*color:#35C9A7;*/
    /*border-radius: 16px;*/
    /*width: 32px;*/
    /*height: 32px;*/
    /*border: 2px solid #35C9A7;*/
    /*border-color:#35C9A7;  "*/
    /*}*/

    .sphere-power-type {
        color: #35C9A7;
        background-color: white;
        border-radius: 16px;
        width: 32px;
        height: 32px;
        border: 2px solid #35C9A7;
        text-align: center;
        padding-top: .20em;
        cursor: pointer;
    }

    .sphere-power-type.power-active {
        background-color: #35C9A7;
        color: white;
    }

    .cylinder-power-type {
        color: #35C9A7;
        background-color: white;
        border-radius: 16px;
        width: 32px;
        height: 32px;
        border: 2px solid #35C9A7;
        text-align: center;
        padding-top: .20em;
        cursor: pointer;
    }

    .cylinder-power-type.power-active {
        background-color: #35C9A7;
        color: white;
    }

    .power-type {
        opacity: 0;
    }
</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading "><?php echo $this->lang->line('lens')?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>

    <label class="page-heading"><?php echo $this->lang->line('add_lens_user')?></label>
    <form method="post" id="form_lens_user">
        <div class="row">

            <!--        <div class="col-12">-->
            <!--            <label class="text-small">USER ID <span class="text-red">*</span></label>-->
            <!--            <input type="text" class="form-control">-->
            <!--        </div>-->


            <div class="col-12 my-4">
                <label class="text-small"><?php echo $this->lang->line('user_name')?> </label>
                <input type="text" class="form-control" name="user_name" id="user_name">
                <input type="hidden" name="user_id" id="user_id">
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                <label class="text-small"><?php echo $this->lang->line('first_name')?><span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="user_first_name" id="user_first_name">
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                <label class="text-small"><?php echo $this->lang->line('last_name')?><span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="user_last_name" name="user_last_name">
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label class="text-small"><?php echo $this->lang->line('date_of_birth')?></label>
                <input type="text" class="date-time-picker form-control" placeholder="Select Date" name="user_dob"
                       id="user_dob">
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label class="text-small"> <?php echo $this->lang->line('gender')?></label>
                <select id="user_gender" name="user_gender" class="text-small">
                    <option class="text-small" value="1"><?php echo $this->lang->line('male')?></option>
                    <option class="text-small" value="2"><?php echo $this->lang->line('female')?></option>
                    <option class="text-small" value="3"><?php echo $this->lang->line('others')?></option>
                </select>
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
                <label class="text-small"><?php echo $this->lang->line('select_country')?></label>
                <select name="user_country" id="user_country">
                    <option value=""><?php echo $this->lang->line('select_country')?></option>
                    <?php foreach ($countries AS $country) { ?>
                        <option value="<?php echo $country['countries_id'] ?>"><?php echo $country['countries_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
                <label class="text-small"><?php echo $this->lang->line('select_region')?></label>
                <select name="user_region" id="user_region" disabled>
                    <option value=""><?php echo $this->lang->line('select_region')?></option>
                </select>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
                <label class="text-small"><?php echo $this->lang->line('select_city')?></label>
                <select name="user_city" id="user_city" disabled>
                    <option value=""><?php echo $this->lang->line('select_city')?></option>
                </select>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                <label class="text-small"><?php echo $this->lang->line('post_code')?></label>
                <input type="text" class="form-control" name="user_post_code" id="user_post_code">
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                <label class="text-small"><?php echo $this->lang->line('email')?></label>
                <input type="email" class="form-control" name="user_mail" id="user_mail">
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label class="text-small"><?php echo $this->lang->line('select_phone_code')?></label>
                <select name="user_phone_code" id="user_phone_code">
                    <option value=""><?php echo $this->lang->line('select_phone_code')?></option>
                    <?php foreach ($countries AS $country) { ?>
                        <option value="<?php echo $country['countries_id'] ?>"><?php echo '(' . $country['countries_sortname'] . ') ' . $country['countries_phonecode'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label class="text-small"><?php echo $this->lang->line('phone')?><span class="text-red">*</span></label>
                <input type="text" class="form-control" name="user_phone" id="user_phone">
            </div>


            <div class="col-12 my-3">
                <label class="text-small"><?php echo $this->lang->line('address')?></label>
                <textarea id="user_address" name="user_address"></textarea>
            </div>


            <div class=" col-12 lens_button_margin">

                <div class="lens_left_right_button">

                    <button id="bu1" class="p-2 active lens_style_button" type="button"><?php echo $this->lang->line('right_eye_lens')?></button>
                    <button id="bu2" class=" p-2  lens_style_button" type="button"><?php echo $this->lang->line('left_eye_lens')?></button>

                </div>
            </div>
<!---------------------------------------------------------------right eye---------------------------------------------------------------------------------------------------------->

            <div class="col-12" id="rightEye">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="text-small"><?php echo $this->lang->line('lens_name')?></label>
                        <input type="text" class="form-control" name="right_lens_name" id="right_lens_name">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                        <label class="text-small"><?php echo $this->lang->line('company_name')?></label>
                        <input type="text" class="form-control" name="right_company_name" id="right_company_name">
                    </div>

                    <div class="col-12 ">
                        <label class="text-small"> <?php echo $this->lang->line('lens_type')?></label>
                        <select id="right_lens_type" name="right_lens_type" class="text-small">
                            <option class="text-small" value=""><?php echo $this->lang->line('select')?></option>
                            <?php foreach ($lens_types AS $lens_type) { ?>
                                <option value="<?php echo $lens_type['lens_type_id'] ?>"><?php echo $lens_type['lens_type_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 ">
                        <label class="text-small"><?php echo $this->lang->line('sphere')?> <span class="p-2">:</span></label>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 background-color div-sphere-power">
                        <input type="radio" name="right_sphere_power_type" id="right_sphere_power_plus" class="power-type"
                               value="right_sphere_power_plus"><label for="right_sphere_power_plus" class="right-sphere sphere-power-type"><i
                                    class="fas fa-plus"></i></label>
                        <input type="radio" name="right_sphere_power_type" id="right_sphere_power_minus" class="power-type"
                               value="right_sphere_power_minus"><label for="right_sphere_power_minus" class="right-sphere sphere-power-type"><i
                                    class="fas fa-minus"></i></label>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" name="right_sphere_power_value" id="right_sphere_power_value"
                               pattern="^[+|-]?\d+(\.\d+)">
                    </div>


                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 ">

                        <label class="text-small"><?php echo $this->lang->line('cylinder')?> <span class="p-2">:</span></label>

                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 background-color div-cylinder-power">

                        <input type="radio" name="right_cylinder_power_type" id="right_cylinder_power_plus" class="power-type"
                               value="right_cylinder_power_plus"><label for="right_cylinder_power_plus" class="right-cylinder cylinder-power-type"><i
                                    class="fas fa-plus text-center"></i></label>
                        <input type="radio" name="right_cylinder_power_type" id="right_cylinder_power_minus" class="power-type"
                               value="right_cylinder_power_minus"><label for="right_cylinder_power_minus"
                                                                   class="right-cylinder cylinder-power-type"><i
                                    class="fas fa-minus text-center"></i></label>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" name="right_cylinder_power_value" id="right_cylinder_power_value"
                               pattern="^[+|-]?\d+(\.\d+)">
                    </div>


                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="text-small"><?php echo $this->lang->line('axis')?></label>
                        <input type="text" class="form-control" name="right_axis" id="right_axis">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
                        <label class="text-small"><?php echo $this->lang->line('addiction')?></label>
                        <input type="text" class="form-control" name="right_addiction" id="right_addiction">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
                        <label class="text-small"><?php echo $this->lang->line('diameter')?></label>
                        <input type="text" class="form-control" id="right_diameter" name="right_diameter">
                    </div>

                    <div class="col-12">
                        <label class="text-weight-bold pl-3"><?php echo $this->lang->line('set_timer_right_eye_lens')?></label>
                    </div>


                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="text-small"><?php echo $this->lang->line('lens_duration')?></label>
                        <input type="number" name="right_lens_duration" id="right_lens_duration" class="form-control">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                        <label class="text-small"><?php echo $this->lang->line('starting_date')?></label>
                        <input type="text" class="date-time-picker form-control" placeholder="Select Date"
                               id="right_start_date"
                               name="right_start_date">
                    </div>
                </div>
            </div>
            <!-----------------------------------------------------------------left eye ------------------------------------------------------------------------------------------>
            <div class="col-12" id="leftEye" style="display: none;">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="text-small"><?php echo $this->lang->line('lens_name')?></label>
                        <input type="text" class="form-control" name="left_lens_name" id="left_lens_name">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                        <label class="text-small"><?php echo $this->lang->line('company_name')?></label>
                        <input type="text" class="form-control" name="left_company_name" id="left_company_name">
                    </div>

                    <div class="col-12 ">
                        <label class="text-small"> <?php echo $this->lang->line('lens_type')?></label>
                        <select id="left_lens_type" name="left_lens_type" class="text-small">
                            <option class="text-small" value="">SELECT</option>
                            <?php foreach ($lens_types AS $lens_type) { ?>
                                <option value="<?php echo $lens_type['lens_type_id'] ?>"><?php echo $lens_type['lens_type_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 ">
                        <label class="text-small"><?php echo $this->lang->line('sphere')?> <span class="p-2">:</span></label>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 background-color div-sphere-power">
                        <input type="radio" name="left_sphere_power_type" id="left_sphere_power_plus" class="power-type"
                               value="left_sphere_power_plus"><label for="left_sphere_power_plus" class="left-sphere sphere-power-type"><i
                                    class="fas fa-plus"></i></label>
                        <input type="radio" name="left_sphere_power_type" id="left_sphere_power_minus" class="power-type"
                               value="left_sphere_power_minus"><label for="left_sphere_power_minus" class="left-sphere sphere-power-type"><i
                                    class="fas fa-minus"></i></label>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" name="left_sphere_power_value" id="left_sphere_power_value"
                               pattern="^[+|-]?\d+(\.\d+)">
                    </div>


                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 ">

                        <label class="text-small"><?php echo $this->lang->line('cylinder')?> <span class="p-2">:</span></label>

                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 background-color div-cylinder-power">

                        <input type="radio" name="left_cylinder_power_type" id="left_cylinder_power_plus" class="power-type"
                               value="left_cylinder_power_plus"><label for="left_cylinder_power_plus" class="left-cylinder cylinder-power-type"><i
                                    class="fas fa-plus text-center"></i></label>
                        <input type="radio" name="left_cylinder_power_type" id="left_cylinder_power_minus" class="power-type"
                               value="left_cylinder_power_minus"><label for="left_cylinder_power_minus"
                                                                   class="left-cylinder cylinder-power-type"><i
                                    class="fas fa-minus text-center"></i></label>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" name="left_cylinder_power_value" id="left_cylinder_power_value"
                               pattern="^[+|-]?\d+(\.\d+)">
                    </div>


                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="text-small"><?php echo $this->lang->line('axis')?></label>
                        <input type="text" class="form-control" name="left_axis" id="left_axis">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
                        <label class="text-small"><?php echo $this->lang->line('addiction')?></label>
                        <input type="text" class="form-control" name="left_addiction" id="left_addiction">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
                        <label class="text-small"><?php echo $this->lang->line('diameter')?></label>
                        <input type="text" class="form-control" id="left_diameter" name="left_diameter">
                    </div>

                    <div class="col-12">
                        <label class="text-weight-bold pl-3"><?php echo $this->lang->line('set_timer_left_eye_lens')?></label>
                    </div>


                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="text-small"><?php echo $this->lang->line('lens_duration')?></label>
                        <input type="number" name="left_lens_duration" id="left_lens_duration" class="form-control">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                        <label class="text-small"><?php echo $this->lang->line('starting_date')?></label>
                        <input type="text" class="date-time-picker form-control" placeholder="Select Date"
                               id="left_start_date"
                               name="left_start_date">
                    </div>
                </div>
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
                <button class="btn-common" type="submit" name="eye"><?php echo $this->lang->line('confirm')?></button>
            </div>


        </div>
    </form>

</div>


<script type="text/javascript" rel="script"
        src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js') ?>"></script>
<script type="text/javascript" rel="script"
        src="<?php echo base_url('assets/app_assets/plugins/jquery-ui-1.12.1/jquery-ui.js') ?>"></script>


<script type="text/javascript" rel="script">
    $('.date-time-picker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });


    var x = document.getElementById("bu1");
    var y = document.getElementById("bu2");
    var z = document.getElementById("rightEye");
    var k = document.getElementById("leftEye");

    x.addEventListener("click", Right_Eye_Function);
    y.addEventListener("click", Left_Eye_Function);


    function Right_Eye_Function() {

        z.style.display = "block";
        k.style.display = "none";
        $(this).addClass('active');
        $('#bu2').removeClass('active');


    }

    function Left_Eye_Function() {

        k.style.display = "block";
        z.style.display = "none";
        $(this).addClass('active');
        $('#bu1').removeClass('active');
    }


    $('.right-cylinder').click(function () {

        $('.right-cylinder').each(function () {
            $(this).removeClass('power-active');
        });
        $(this).addClass('power-active');

        var power = $(this).attr('for');
//        alert(power);

        var cylinder_value = $('#right_cylinder_power_value').val();
        var is_sign_exist_plus = cylinder_value.split('+');
        var is_sign_exist_minus = cylinder_value.split('-');

        if (is_sign_exist_plus.length > 1) {
            cylinder_value = is_sign_exist_plus[1];
        }
        if (is_sign_exist_minus.length > 1) {
            cylinder_value = is_sign_exist_minus[1];
        }
        if (power == 'right_cylinder_power_plus') {
            $('#right_cylinder_power_value').val('+' + cylinder_value);
        }
        else {
            $('#right_cylinder_power_value').val('-' + cylinder_value);
        }

    });
    $('.right-sphere').click(function () {

        $('.right-sphere').each(function () {
            $(this).removeClass('power-active');
        });
        $(this).addClass('power-active');
        var power = $(this).attr('for');
//        alert(power);

        var sphere_value = $('#right_sphere_power_value').val();
        var is_sign_exist_plus = sphere_value.split('+');
        var is_sign_exist_minus = sphere_value.split('-');

        if (is_sign_exist_plus.length > 1) {
            sphere_value = is_sign_exist_plus[1];
        }
        if (is_sign_exist_minus.length > 1) {
            sphere_value = is_sign_exist_minus[1];
        }
        if (power == 'right_sphere_power_plus') {
            $('#right_sphere_power_value').val('+' + sphere_value);
        }
        else {
            $('#right_sphere_power_value').val('-' + sphere_value);
        }

    });
//************************************************************************for left eye*********************************************************************************
    $('.left-cylinder').click(function () {

        $('.left-cylinder').each(function () {
            $(this).removeClass('power-active');
        });
        $(this).addClass('power-active');

        var power = $(this).attr('for');
//        alert(power);

        var cylinder_value = $('#left_cylinder_power_value').val();
        var is_sign_exist_plus = cylinder_value.split('+');
        var is_sign_exist_minus = cylinder_value.split('-');

        if (is_sign_exist_plus.length > 1) {
            cylinder_value = is_sign_exist_plus[1];
        }
        if (is_sign_exist_minus.length > 1) {
            cylinder_value = is_sign_exist_minus[1];
        }
        if (power == 'left_cylinder_power_plus') {
            $('#left_cylinder_power_value').val('+' + cylinder_value);
        }
        else {
            $('#left_cylinder_power_value').val('-' + cylinder_value);
        }

    });
    $('.left-sphere').click(function () {

        $('.left-sphere').each(function () {
            $(this).removeClass('power-active');
        });
        $(this).addClass('power-active');
        var power = $(this).attr('for');
//        alert(power);

        var sphere_value = $('#left_sphere_power_value').val();
        var is_sign_exist_plus = sphere_value.split('+');
        var is_sign_exist_minus = sphere_value.split('-');

        if (is_sign_exist_plus.length > 1) {
            sphere_value = is_sign_exist_plus[1];
        }
        if (is_sign_exist_minus.length > 1) {
            sphere_value = is_sign_exist_minus[1];
        }
        if (power == 'left_sphere_power_plus') {
            $('#left_sphere_power_value').val('+' + sphere_value);
        }
        else {
            $('#left_sphere_power_value').val('-' + sphere_value);
        }

    });

    selected_city = '';
    selected_region = '';

    //****************************************************************************auto complete ****************************************************
    availableTags = [
        {label: "HTML", value: "Hypertext Markup Language"}, {label: "CSS", value: "Cascading Style Sheets"}
    ];

    function download_user() {
        $("#user_name").autocomplete({
            source: availableTags,
            select: function (event, ui) {
                this.value = ui.item.label;
                set_user_values(ui.item.value);
                return false;
            }
        });
    }


    $('#user_name').keyup(function () {
        temp_user_name = $(this).val();
        $('#user_id').val('');
        $('#user_first_name').val('');
        $('#user_last_name').val('');
        $('#user_dob').val('');
        $('#user_gender').val('');
        $('#user_phone_code').val('');
        $('#user_phone').val('');
        $('#user_mail').val('');
        $('#user_address').val('');
        selected_city = '';
        selected_region = '';
        $('#user_country').val('');
        $('#user_city').val('');
        $('#user_region').val('');
        $('#user_phone_code').val('');
//        alert(temp_user_name);
        if (temp_user_name != '') {
            $.ajax({
                url: '<?php echo uri_string()?>',
                type: 'POST',
                data: {user_name: temp_user_name},
                success: function (result) {
//                    alert(result);
                    users = $.parseJSON(result);
                    total_user = users.length;
                    availableTags = [];
                    for (var i = 0; i < total_user; i++) {
                        availableTags.push({label: users[i]['downloaded_user_user_name'], value: users[i]});
                    }
                    download_user();
                },
                error: function (error) {
                    alert(error);
                }
            });
        }
    });

    //************************************************************************end auto complete****************************************************
    function set_user_values(user) {
//        alert(user['downloaded_user_user_name']);

        $('#user_first_name').val(user['downloaded_user_first_name']);
        $('#user_last_name').val(user['downloaded_user_last_name']);
        $('#user_dob').val(user['downloaded_user_birth_date']);
        $('#user_gender').val(user['downloaded_user_gender']);
        $('#user_phone_code').val(user['downloaded_user_post_code']);
        $('#user_phone').val(user['downloaded_user_phone']);
        $('#user_mail').val(user['downloaded_user_email']);
        $('#user_address').val(user['downloaded_user_address']);
        $('#user_id').val(user['downloaded_user_id']);
        selected_city = user['ref_downloaded_user_cities_id'];
        selected_region = user['ref_downloaded_user_states_id'];
        $('#user_country').val(user['ref_downloaded_user_countries_id']);
        $('#user_phone_code').val(user['ref_downloaded_user_countries_id']);
        $('#user_country').trigger('change');

    }

    $('#user_country').change(function () {
        var user_country_id = $(this).val();
        $('#user_phone_code').val(user_country_id);
//        alert(country_id);
        if (user_country_id == '' || user_country_id == null) {
            $('#user_region').children('option:not(:first)').remove();
            $('#user_region').attr('disabled', true);
        }
        else {
            $('#user_region').children('option:not(:first)').remove();
            $('#user_region').attr('disabled', false);
            $.ajax({
                url: '<?php echo uri_string()?>',
                type: 'POST',
                data: {country_id: user_country_id},
                success: function (result) {
                    var regions = $.parseJSON(result);
                    var total_regions = regions.length;
                    for (var i = 0; i < total_regions; i++) {
                        $('#user_region').append('<option value="' + regions[i]['states_id'] + '">' + regions[i]['states_name'] + '</option>');
                    }
                    $('#user_region').val(selected_region);
                    $('#user_region').trigger('change');
                },
                error: function (error) {
                    alert(error);
                }
            });
        }

    });
    $('#user_region').change(function () {
        var user_region_id = $(this).val();
//        alert(country_id);
//        alert(user_region_id);
        if (user_region_id == '' || user_region_id == null) {
            $('#user_city').children('option:not(:first)').remove();
            $('#user_city').attr('disabled', true);
        }
        else {
            $('#user_city').children('option:not(:first)').remove();
            $('#user_city').attr('disabled', false);
            $.ajax({
                url: '<?php echo uri_string()?>',
                type: 'POST',
                data: {region_id: user_region_id},
                success: function (result) {
                    var cities = $.parseJSON(result);
                    var total_cities = cities.length;
                    for (var i = 0; i < total_cities; i++) {
                        $('#user_city').append('<option value="' + cities[i]['cities_id'] + '">' + cities[i]['cities_name'] + '</option>');
                    }
                    $('#user_city').val(selected_city);
                },
                error: function (error) {
                    alert(error);
                }
            });
        }

    });

    $('#form_lens_user').validate({
        rules: {
            user_first_name: {
                required: true,
            },
            user_last_name: {
                required: true,
            },
            right_cylinder_power_type: {
                required: true,
            },
            right_cylinder_power_value: {
                required: true,
            },
            right_sphere_power_type: {
                required: true,
            },
            right_sphere_power_value: {
                required: true,
            },
            left_cylinder_power_type: {
                required: true,
            },
            left_cylinder_power_value: {
                required: true,
            },
            left_sphere_power_type: {
                required: true,
            },
            left_sphere_power_value: {
                required: true,
            },
            right_lens_type:{
                required: true,
            },
            left_lens_type:{
                required: true,
            },
            user_phone: {
                required: true
            },
            left_lens_duration: {
                min: 0,
                required: false
            },
            right_lens_duration: {
                min: 0,
                required: false
            },


        },
    });
</script>
