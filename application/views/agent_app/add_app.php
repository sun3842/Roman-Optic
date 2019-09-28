<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css')?>">
<style type="text/css" rel="stylesheet">

    .row>div{
        margin: 4px 0 12px 0;
    }

    .upload{

        background-color:#35C9A8;
    }

    .browse{
        position: absolute;
        float: left;
        opacity: 0;
        z-index: 100;
    }



    .product-category {
        color: white;
        background-color: #34CAA7;
    }

    .box-heading {
        display: block;
        text-align: center;
        padding: 10px 0 10px 0;
        color: white;
        background-color: #35C9A8;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        outline: none;

    }

    .attribute-list {
        padding: 5px 0 5px 10px;
    }

    .box-off-white {
        background-color: #E1E3E5;
        padding: 0;
        margin: 5px;
    }

    .box-body {
        padding: 15px 10px 10px 10px;
    }

    div {
        padding: 0;
    }

    a.box-heading {
        color: white;
        text-decoration: none;
    }

    a.box-heading:hover {
        color: white;
        text-decoration: none;
    }

    .attribute-item {
        border-bottom: 1px solid #B7B9BB;
        padding-top: 7px;
    }

    .attribute-list {
        padding: 0 5% 0 5%;
    }

    .btn-paste {
        color: white;
        background-color: #35C9A7;
        border: none;
        cursor: pointer;
        outline: none;
    }

    .attribute-details {
        margin-left: 5em;
    !important;
        padding: 15px;
    }

    .attribute-variable {
        display: flex;
    }

    .attribute-variable > span {
        margin: 5px 10px 0 0;
    }
    .background-off-white{
        background-color: #E1E3E5;
        padding: 10px;
        margin-top: 10px;
    }

    input[type='radio']{
        width: 25px;
        border: 4px solid #35C9A7;
        color: white;
    }

    .btn-md-circle{
        height: 45px;
        width: 45px;
        border-radius: 25px;
        border: none;
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
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 14px;
    }

    /* Hide default HTML checkbox */
    .switch input {display:none;}

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: -2px;
        bottom: -5px;
        background-color: #34CAA7;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #34CAA7;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #34CAA7;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    @media screen and (max-width: 720px) {
        .attribute-details {
            margin-left: 0;
        }
    }

    .btn-common-post-event{
        color: white;
        border: none;
        background-color: #35C9A7;
        padding: 5px 10em 5px 10em;
        -webkit-box-shadow: -1px 5px 15px -5px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px 5px 15px -5px rgba(0,0,0,0.75);
        box-shadow: -1px 5px 15px -5px rgba(0,0,0,0.75);
        cursor: pointer;
        font-weight: bold;
    }

    .photo-size{

        width: 150px;
        height: 150px;

    }

    .photo-size>img{

        width: 100%;
        height: 100%;
    }

    input[type='checkbox']{
        color: #35C9A8;
        background-color: #35C9A8;
    }

</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading "><?php echo $this->lang->line('add_app')?></label>
            <a href="<?php echo site_url('agent_apps')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>

    <form enctype="multipart/form-data" method="post" id="form_app">
        <div class="row">
            <div class="col-12">
                <label class="text-small"><?php echo $this->lang->line('app_name')?> <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="app_name" name="app_name" autocomplete="false">
            </div>

            <div class="col-12">
                <label class="text-small"><?php echo $this->lang->line('app_description')?></label>
                <textarea name="app_description" id="app_description"></textarea>
            </div>


            <div class="col-12">
                <label class="text-small"><?php echo $this->lang->line('app_available_expecting_date')?></label>
                <input type="text" class="form-control datepicker" id="app_available_expecting_date" name="app_available_expecting_date">
            </div>
            <div class="col-12">
                <label class="text-small"><?php echo $this->lang->line('app_user_name')?></label>
                <input type="text" class="form-control" id="app_user_name" name="app_user_name">
                <label class="label-block text-danger text-center font-weight-bold">****<?php echo $this->lang->line('app_password_will_be_same_as_user_name')?>****</label>
            </div>



            <div class="col-12 mt-5 mb-3">
                <h3 class="label-block text-center my-3"><?php echo $this->lang->line('select_app_modules')?></h3>
                <div class="row">
                    <?php  foreach($app_modules AS $app_module) { ?>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <input type="checkbox" value="<?php echo $app_module['app_modules_id']?>" name="modules[]"><?php echo $app_module['app_modules_name']?>
                    </div>
                    <?php } ?>

                </div>

            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-5 text-center">
                <input type="submit" class="btn-common-post-event" value="<?php echo $this->lang->line('add_app')?>" name="btn_add_app">
            </div>

        </div>
    </form>

</div>

<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js')?>"></script>
<script type="text/javascript" rel="script">
    $('.datepicker').datetimepicker({

       timepicker: false,
        format:'Y/m/d',
        mindate:0

    });



    $('#app_name').keyup(function () {
        var app_name=$(this).val();
        var app_name_length=app_name.length
        var temp_user_name='';
        for(var i=0;i<app_name_length;i++)
        {
            if(app_name[i]!=' ')
            {
                temp_user_name=temp_user_name+app_name[i];
            }
        }
        $('#app_user_name').val(temp_user_name);
        $('#app_user_name').trigger('focusout');
    });



    jQuery.validator.addMethod('noSpace',function (value,element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "Name Is Required And Spaces are not allowed");


    $('#form_app').validate({
        rules:{
            app_name: {
                required: true,
            },
            app_user_name: {
                noSpace: true,
                remote: {

                    url: '<?php echo base_url('is_user_name_exist')?>',

                    type: "post",
                    data:
                        {

                            app_user_name: function() {

                                return $( "#app_user_name" ).val();
                            }
                        }
                }
            }
        }
    });

</script>






