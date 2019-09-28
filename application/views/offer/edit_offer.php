<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.css') ?>">
<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins/jquery-ui-1.12.1/jquery-ui.css') ?>">

<style type="text/css" rel="stylesheet">
    .div-offer-option{
        background-color: #A4A4A4;
        border: none;
        display: inline-block;
    }
    .btn-offer-option{
        border: none;
        background: transparent;
        padding: 10px 20px 10px 20px;
        outline: none;
        cursor: pointer;
    }
    .btn-offer-option.offer-active{
        color: white;
        background-color: #35C9A8;
    }
    button.action{
        border: none;
        background-color: transparent;
        outline: none;
        cursor: pointer;
    }
    ul#product_list{
        list-style-type: none;
    }
    ul#product_list>li:not(:last-child){
        border-bottom: 1px solid #C3C3C3;
        margin-bottom: 5px;
    }
</style>
<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row mb-4">
        <div class="col-12 text-center my-5">
            <label class="page-heading font-color"><?php echo $this->lang->line('offer')?></label>
            <a href="<?php echo base_url('all_offer') ?>" class="btn-back" style="color: #35C9A7"><i
                    class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold my-3 font-color"><?php echo $this->lang->line('create_offer')?></h4>

            <div class="div-offer-option my-3">
                <button type="button" class="btn-offer-option <?php echo ($offer[0]['ref_offer_target_type_id']==1)?'offer-active':'' ?>" name="btn_general_offer"><?php echo $this->lang->line('general_offer')?></button>
                <button type="button" class="btn-offer-option <?php echo ($offer[0]['ref_offer_target_type_id']==2)?'offer-active':'' ?>" name="btn_target_offer"><?php echo $this->lang->line('targeted_offer')?></button>
            </div>

        </div>
    </div>
    <form method="post" id="form_offer" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 my-3">
                <label><?php echo $this->lang->line('offer_title')?><span class="text-red">*</span></label>
                <input type="text" class="form-control" name="offer_title" id="offer_title" value="<?php echo $offer[0]['offer_title']?>">
            </div>

            <div class="col-12 my-3">
                <label><?php echo $this->lang->line('offer_description')?><span class="text-red">*</span></label>
                <textarea name="offer_description" id="offer_description"><?php echo $offer[0]['offer_details']?></textarea>
            </div>



            <div class="col-12 my-3">
                <label><?php echo $this->lang->line('offer_duration')?></label>
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 box-off-white p-3">
                        <input type="text" class="form-control date-time" placeholder="END DATE TIME" id="offer_start_date_time" name="offer_start_date_time" value="<?php echo ($offer[0]['offer_starting_date_time']!='')?$offer[0]['offer_starting_date_time']:''?>">
                        <!--                    <input type="text" class="form-control date-time mt-4" placeholder="END DATE TIME" id="offer_end_date_time" name="offer_end_date_time">-->
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 box-off-white p-3">
                        <input type="text" class="form-control date-time" placeholder="END DATE TIME" id="offer_end_date_time" name="offer_end_date_time" value="<?php echo ($offer[0]['offer_ending_date_time']!='')?$offer[0]['offer_ending_date_time']:''?>">
                    </div>

                    <!--                <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center">-->
                    <!--                    <label class="text-large text-red font-weight-bold mt-5">OR</label>-->
                    <!--                </div>-->
                    <!--                <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5 box-off-white py-4">-->
                    <!--                        <label>Offer Stay For</label>-->
                    <!--                    <select style="" id="offer_select_dat" name="offer_select_day">-->
                    <!--                        <option>No Date Selected</option>-->
                    <!--                        <option value="3">3 DAYS</option>-->
                    <!--                        <option value="5">5 DAYS</option>-->
                    <!--                        <option value="7">7 DAYS</option>-->
                    <!--                        <option value="15">15 DAYS</option>-->
                    <!--                        <option value="30">30 DAYS</option>-->
                    <!--                        <option value="45">45 DAYS</option>-->
                    <!--                        <option value="60">60 DAYS</option>-->
                    <!--                        <option value="90">90 DAYS</option>-->
                    <!--                    </select>-->
                    <!--                </div>-->
                </div>
            </div>

            <div class="col-12 my-3">
                <div class="row">
                    <div class="col-12">
                        <label><?php echo $this->lang->line('upload_display_image')?></label>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('upload_display_image')?>" disabled>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="offer_display_image" class="btn-paste btn btn-block"><?php echo $this->lang->line('upload')?></label>
                        <input type="file" class="collapse" id="offer_display_image" name="offer_display_image" onchange="openFile(event)">
                    </div>
                    <div class="col-12 box-off-white">
                        <div class="row" id="upload_display_images" >
                            <?php $offer_img_id=-1; foreach ($offer AS $item){ ?>
                                <?php  if($item['offer_image_id']!=$offer_img_id && $item['offer_image_active']==1 && $item['offer_image_is_display']==1) { ?>
                                    <div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2'>
                                        <img src='<?php echo site_url($item["offer_image_location"])?>' width='100%'>
                                        <button type='button' content="<?php echo $item['offer_image_id'] ?>" class='btn btn-danger btn-delete-offer-img'><?php echo $this->lang->line('delete')?></button>
                                    </div>
                                <?php $offer_img_id=$item['offer_image_id']; } ?>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 my-3">
                <div class="row">
                    <div class="col-12">
                        <label><?php echo $this->lang->line('upload_more_image')?></label>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('upload_more_image')?> " disabled>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="offer_more_image" class="btn-paste btn btn-block"><?php echo $this->lang->line('upload')?></label>
                        <input type="file" class="collapse" id="offer_more_image" name="offer_more_image[]" onchange="openFileMultiple(event)" multiple>
                    </div>
                    <div class="col-12 box-off-white">
                        <div class="row" id="upload_more_images" >
                            <?php $offer_img_id=-1; foreach ($offer AS $item){ ?>
                                <?php  if($item['offer_image_id']!=$offer_img_id && $item['offer_image_active']==1 && $item['offer_image_is_display']==0) { ?>
                                    <div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2'>
                                        <img src='<?php echo site_url($item["offer_image_location"])?>' width='100%'>
                                        <button type='button' content="<?php echo $item['offer_image_id'] ?>" class='btn btn-danger btn-delete-offer-img'><?php echo $this->lang->line('delete')?></button>
                                    </div>
                                    <?php $offer_img_id=$item['offer_image_id']; } ?>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-12 my-3">
                <label class="label-block"><?php echo $this->lang->line('offer_from_product_list')?></label>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="row box-off-white py-4">
                    <div class="col-8">
                        <input type="text" class="form-control" id="offer_products_search">
                    </div>
                    <div class="col-4">
                        <button class="btn-paste btn-block py-2" type="button" id="btn_add_offer_product"><?php echo $this->lang->line('add')?></button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="box-off-white">
                    <label class="box-heading"><?php echo $this->lang->line('product_list')?></label>
                    <ul id="product_list" class="p-3">


                        <?php  $temp_product_id=-1; foreach ($offer AS $item){ ?>
                            <?php if($item['ref_offer_product_product_id']!=$temp_product_id && $item['offer_product_active']==1){ ?>
                                    <li>
                                        <label><?php echo $item['product_name']?></label>
                                        <button class="action action-delete float-right btn-delete-offer-product" content="<?php echo $item['offer_product_id']?>"><i class="far fa-trash-alt"></i></button>
                                    </li>
                                <?php  $temp_product_id=$item['ref_offer_product_product_id'];}?>
                        <?php } ?>

                    </ul>
                </div>
            </div>
            <!--        <div class="col-12 my-3">-->
            <!--            <label class="text-bold pr-2">DOWNLOAD PDF:</label>-->
            <!--            <label for="offer_pdf" class="text-paste px-2" style="text-decoration: underline">Browse From Your pc/desktop</label>-->
            <!--            <input type="file" id="offer_pdf" class="collapse">-->
            <!--        </div>-->
            <div id="div_offer_target" class="col-12 my-4" style="display: <?php echo ($offer[0]['ref_offer_target_type_id']==2)?'block':'none'?>">
                <div class="row">
                    <div class="col-12 mr-3">
                        <level class="text-paste mx-2 text-medium font-weight-bold"><?php echo $this->lang->line('who_will_get_this_offer')?></level>
                    </div>


                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                        <label class="label-block"><input type="checkbox" name="is_target_gender" id="is_target_gender" <?php echo ($offer[0]['is_condition_gender']==1)?'checked':'' ?>><strong><?php echo $this->lang->line('gender')?></strong></label>
                        <label class="mr-3 text_checkbox "><input class="target-gender-type" type="checkbox" name="men"  <?php echo ($offer[0]['is_condition_gender']==1)?'':'disabled'?> <?php echo ($offer[0]['condition_gender']==1 || $offer[0]['condition_gender']==4)?'checked':''?>> <?php echo $this->lang->line('men')?></label>
                        <label class="mr-3 text_checkbox "><input class="target-gender-type"  type="checkbox" name="women" <?php echo ($offer[0]['is_condition_gender']==1)?'':'disabled'?> <?php echo ($offer[0]['condition_gender']==2 || $offer[0]['condition_gender']==4)?'checked':''?>> <?php echo $this->lang->line('women')?></label>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                        <label class="text-small"><input type="checkbox" id="is_target_city" name="is_target_city" <?php echo ($offer[0]['is_condition_city']==1)?'checked':'' ?>><?php echo $this->lang->line('select_city')?></label>
                        <select id="city_id" name="city_id" class="text-small" <?php echo ($offer[0]['is_condition_city']==1)?'':'disabled' ?>>
<!--                            --><?php //foreach ($cities as $city) { ?>
<!--                                <option value="--><?php //echo $city['cities_id'] ?><!--" --><?php //echo ($city['cities_id']==$offer[0]['condition_cities_id'])?'selected':'' ?><!-->--><?php //echo $city['cities_name'] ?><!--</option>-->
<!--                            --><?php //} ?>
                        </select>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                        <label class="text-small"><input type="checkbox" name="is_target_occupation" id="is_target_occupation" <?php echo ($offer[0]['is_condition_occupation']==1)?'checked':'' ?>><?php echo $this->lang->line('select_occupation')?></label>
                        <select id="occupation_id" name="occupation_id"  class="text-small" <?php echo ($offer[0]['is_condition_occupation']==1)?'':'disabled' ?>>
                            <?php foreach ($occupations AS $occupation){ ?>
                                <option class="text-small" value="<?php echo $occupation['occupation_list_id']?>" <?php echo ($occupation['occupation_list_id']==$offer[0]['condition_occupation_list_id'])?'selected':''?>><?php echo $occupation['occupation_list_name']?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                        <label class="text-small"><input type="checkbox" id="is_target_age_limit" name="is_target_age_limit" <?php echo ($offer[0]['is_condition_age_range']==1)?'checked':'' ?>><?php echo $this->lang->line('choose_age_limit')?> </label>
                        <input type="text" id="age_limit" name="age_limit" readonly class="slide_range"  <?php echo ($offer[0]['is_condition_age_range']==1)?'':'disabled' ?>>
                        <div id="slider-range"></div>
                    </div>


                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                        <label class="text-small"><input type="checkbox" id="is_target_birthday" name="is_target_birthday" <?php echo ($offer[0]['is_condition_birth_date']==1)?'checked':'' ?>><?php echo $this->lang->line('choose_birthday')?> </label>
                        <input type="text" class="date-time-picker form-control" name="birthday" id="birthday" value="<?php echo $offer[0]['condition_birth_date']?>" placeholder="Select Date" <?php echo ($offer[0]['is_condition_birth_date']==1)?'':'disabled' ?>>
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-3">
                        <label class="text-small"><input type="checkbox" name="is_target_marital_status" id="is_target_marital_status" <?php echo ($offer[0]['is_condition_marital_status']==1)?'checked':'' ?>><?php echo $this->lang->line('select_marital_status')?></label>
                        <select id="marital_status" name="marital_status"  class="text-small" <?php echo ($offer[0]['is_condition_marital_status']==1)?'':'disabled' ?>>
                            <?php foreach ($marital_status AS $status){ ?>
                                <option class="text-small" value="<?php echo $status['marital_status_id']?>" <?php echo ($status['marital_status_id']==$offer[0]['condition_marital_status_id'])?'checked':''?>><?php echo $status['marital_status_name']?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="col-12 text-medium my-3">
                        <label><input type="checkbox" name="match_and_condition" <?php echo ($offer[0]['match_all_conditions']==1)?'checked':''?>> <?php echo $this->lang->line('match_all_condition')?></label>
                    </div>

                </div>

            </div>

            <div class="col-12 text-medium my-3">
                <label><input type="checkbox" name="push_notification" <?php echo ($offer[0]['offer_is_push_notification']==1)?'checked':''?>> <?php echo $this->lang->line('send_push_notification')?></label>
            </div>

            <div class="col-12 my-3 text-left">
                <button type="submit" class="btn-common" name="<?php if($offer[0]['ref_offer_target_type_id']==1)echo 'submit_general_offer';else if($offer[0]['ref_offer_target_type_id']==2)echo 'submit_target_offer'?>" id="btn_offer_form_submit"><?php echo $this->lang->line('confirm')?></button>
            </div>
        </div>
    </form>

</div>


<script type="text/javascript" rel="script"
        src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js') ?>"></script>
<script type="text/javascript" rel="script"
        src="<?php echo base_url('assets/app_assets/plugins/jquery-ui-1.12.1/jquery-ui.js') ?>"></script>





