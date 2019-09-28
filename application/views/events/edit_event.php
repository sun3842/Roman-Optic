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

</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading "><?php echo $this->lang->line('edit_event')?></label>
            <a href="<?php echo site_url()?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>

    <form enctype="multipart/form-data" method="post" id="form_event">
        <div class="row">
            <div class="col-12">
                <label class="text-small"><?php echo $this->lang->line('event_name')?> <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="event_name" name="event_name" value="<?php echo $event[0]['events_title']?>">
            </div>

            <div class="col-12">
                <label class="text-small"><?php echo $this->lang->line('event_details')?> <span class="text-red">*</span></label>
                <textarea name="event_details" id="event_details"><?php echo $event[0]['events_details']?></textarea>
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <label class="text-small"><?php echo $this->lang->line('event_duration')?> </label>
                <input type="text" class="date-time-picker form-control" placeholder="Select Date" name="event_start_time" id="event_start_time" value="<?php echo ($event[0]['events_starting_date_time']!='')?$event[0]['events_starting_date_time']:''?>">
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center my-5">
                <span class="text-red"><?php echo $this->lang->line('to')?></span></label>
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5 my-5">
                <input type="text" class="date-time-picker form-control" placeholder="END DATE AND TIME" name="event_end_time" id="event_end_time" value="<?php echo ($event[0]['events_starting_date_time']!='')?$event[0]['events_starting_date_time']:''?>">
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
                <label class="text-small"><?php echo $this->lang->line('select_country')?></label>
                <select name="event_country" id="event_country">
                    <option value=""><?php echo $this->lang->line('select_country')?></option>
                    <?php foreach ($countries AS $country) { ?>
                        <option value="<?php echo $country['countries_id'] ?>" <?php if($country['countries_id']==$event[0]['ref_events_country_id'])echo 'selected';?>><?php echo $country['countries_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
                <label class="text-small"><?php echo $this->lang->line('select_region')?></label>
                <select name="event_region" id="event_region" <?php if($event[0]['ref_events_country_id']=='')echo 'disabled'?>>
                    <option value=""><?php echo $this->lang->line('select_region')?></option>
                    <?php foreach ($states AS $state) { ?>
                        <option value="<?php echo $state['states_id']?>" <?php if($state['states_id']==$event[0]['ref_events_state_id'])echo 'selected'?>><?php echo $state['states_name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3" <?php if($event[0]['ref_events_state_id']=='')echo 'disabled'?>>
                <label class="text-small"><?php echo $this->lang->line('select_city')?></label>
                <select name="event_city" id="event_city" disabled>
                    <option value=""><?php echo $this->lang->line('select_city')?></option>
                    <?php foreach ($cities AS $city) { ?>
                        <option value="<?php echo $city['cities_id']?>" <?php if($city['cities_id']==$event[0]['ref_events_city_id'])echo 'selected'?>><?php echo $city['cities_name']?></option>
                    <?php } ?>
                </select>
            </div>


            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label class="text-small"><?php echo $this->lang->line('location')?> </label>
                <input type="text" class="form-control" name="event_location" id="event_location" value="<?php echo $event[0]['events_location']?>">
            </div>


            <div class="col-12">
                <label class="text-small"><?php echo $this->lang->line('choose_picture')?></label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control " style="font-size: small;" placeholder="CHOOSE A DISPLAY PICTURE" disabled="">
                    <div>

                        <label for="event_display_image"  class="btn-paste btn btn-block my-1"><i class="fas fa-image "></i><?php echo $this->lang->line('upload')?></label>
                        <input type="file" class="collapse " id="event_display_image" name="event_display_image" onchange="openFile(event)">

                    </div>

                    <div class="col-12 box-off-white ">
                        <div class="row" id="upload_display_images" >
                            <?php $temp_photo_id=-1; foreach ($event AS $item) {?>
                                <?php if($item['events_images_is_display_image']==1 && $item['events_images_id']>$temp_photo_id && $item['events_images_location']!=''){ ?>
                                    <div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4'>
                                        <img src='<?php echo site_url($item['events_images_location'])?>' width='100%'>
                                        <button class="btn btn-danger delete-img" content="<?php echo $item['events_images_id'];?>"><?php echo $this->lang->line('delete')?></button>
                                    </div>
                                    <?php $temp_photo_id=$item['events_images_id']; } ?>
                            <?php } ?>
                        </div>
                    </div>

                </div>

            </div>


            <div class="col-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control " style="font-size: small;" placeholder="CHOOSE MULTIPLE PICTURE" disabled="">
                    <div>

                        <label for="event_more_image"  class="btn-paste btn btn-block my-1"><i class="fas fa-image"></i><?php echo $this->lang->line('upload')?></label>
                        <input type="file" class="collapse " id="event_more_image" name="event_more_image[]" onchange="openFileMultiple(event)" multiple>

                    </div>

                    <div class="col-12 box-off-white ">
                        <div class="row">
                            <?php $temp_photo_id=-1; foreach ($event AS $item) {?>
                                <?php if($item['events_images_is_display_image']==0 && $item['events_images_id']>$temp_photo_id && $item['events_images_location']!=''){ ?>
                                    <div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4'>
                                        <img src='<?php echo site_url($item['events_images_location'])?>' width='100%'>
                                        <button  class="btn btn-danger delete-img" content="<?php echo $item['events_images_id']; ?>"><?php echo $this->lang->line('delete')?></button>
                                    </div>
                                    <?php $temp_photo_id=$item['events_images_id']; } ?>
                            <?php } ?>
                        </div>
                        <div class="row" id="upload_more_images" >



                        </div>
                    </div>

                </div>

            </div>

            <!--        <div class="col-12">-->
            <!---->
            <!--     <div class="row box-off-white py-3">-->
            <!--        <label class="label-block pl-4 my-2" style="display: inline-block;">SHARE ON SOCIAL MEDIA :</label><button class="btn-md-circle active mx-4" style="background-color: #35C9A8"><i class="fab fa-facebook-f " style="color: #fff"></i></button><button class="btn-md-circle" style="background-color: #35C9A8"><i class="fab fa-google-plus-g"  style="color: #fff"></i></button><button class="btn-md-circle mx-4"><i class="fab fa-twitter"></i> </button><button class="btn-md-circle"><i class="fab fa-instagram"></i></i> </button>-->
            <!---->
            <!--      </div>-->
            <!--    </div>-->


<!--            <div class="col-12">-->
<!---->
<!--                <div class="row box-off-white">-->
<!--                    <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-4 my-3">-->
<!--                        <label class="pb-2 pr-4">LIKE TO PUSH NOTIFICATION:</label></div>-->
<!--                    <div class="col-6 col-xs-6 col-sm-6 col-md-8 col-lg-8">-->
<!--                        <label class="switch mt-4">-->
<!--                            <input type="checkbox" name="push_notification" id="push_notification">-->
<!--                            <span class="slider round"></span>-->
<!--                        </label>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->




            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-5 text-center">
                <input type="submit" class="btn-common-post-event" value="<?php echo $this->lang->line('update_event')?>" name="btn_edit_event">
            </div>



        </div>
    </form>

</div>

<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js')?>"></script>






