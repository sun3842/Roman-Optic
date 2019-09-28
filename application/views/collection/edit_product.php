<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css') ?>">

<style type="text/css" rel="stylesheet">
    .product-category {
        color: white;
        background-color: #34CAA7;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
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
        left: 4px;
        bottom: 4px;
        background-color: white;
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
</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row ">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('edit_product')?></label>
            <a href="<?php echo base_url('all_product') ?>" class="btn-back" style="color: #35C9A7"><i
                    class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>
    <form method="post" id="form-product" enctype="multipart/form-data">


        <div class="row">
            <div class="col-12 my-4">
                <label><?php echo $this->lang->line('product_title')?><span class="text-red">*</span></label>
                <input type="text" class="form-control" name="new_product_title" value="<?php echo $product_details[0]['product_name']?>" id="new_product_title">
            </div>

            <div class="col-12 my-4">
                <label><?php echo $this->lang->line('product_description')?></label>
                <textarea id="new_product_description" name="new_product_description"><?php echo $product_details[0]['product_description']?></textarea>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-4">
                <label><?php echo $this->lang->line('select_category')?></label>
                <select id="product_category" class="product-category" name="product_category">
                    <option value=""><?php echo $this->lang->line('no_category')?></option>
                    <?php foreach ($categories AS $category) {?>
                        <option value="<?php echo $category['category_id']?>" <?php if($category['category_id']==$product_details[0]['ref_product_category_id']) echo 'selected'?>><?php echo $category['category_name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-4">
                <label><?php echo $this->lang->line('select_subcategory')?></label>
                <select id="product_subcategory" name="product_subcategory" class="<?php if($product_details[0]['ref_product_subcategory_id']==0 || $product_details[0]['ref_product_subcategory_id']=='')echo '';else echo 'product-category'?>" <?php if($product_details[0]['ref_product_category_id']=='')echo 'disabled'?>>
                    <option value=""><?php echo $this->lang->line('no_subcategory')?></option>
                    <?php foreach ($subcategories AS $subcategory) { ?>
                        <option value="<?php echo $subcategory['subcategory_id']?>" <?php if($subcategory['subcategory_id']==$product_details[0]['ref_product_subcategory_id']) echo 'selected'?>><?php echo $subcategory['subcategory_name']?></option>

                    <?php } ?>
                </select>
            </div>
        </div>



        <div class="row my-3">
            <div class="col-12">
                <div class="row background-off-white">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label><?php echo $this->lang->line('product_display_duration')?></label>
                        <p style="font-size: small">
                            <?php echo $this->lang->line('product_will_quit_displaying_in_website_automatically_after_your_choosing_day_if_you_want_you_may_choose_to_select')?>
                        </p>
                        <div class="col-12 py-4">
                            <div class="row ">
                                <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                    <input type="radio" name="display_product" value="select_p_display_time"><?php echo $this->lang->line('display_this_product_in_website')?>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-7 select_p_display_time" style="display: none">
                                    <select name="p_display_fixed_time" id="p_display_fixed_time">
                                        <option value="3">3 <?php echo $this->lang->line('days')?></option>
                                        <option value="5">5 <?php echo $this->lang->line('days')?></option>
                                        <option value="7">7 <?php echo $this->lang->line('days')?></option>
                                        <option value="15">15 <?php echo $this->lang->line('days')?></option>
                                        <option value="30">30 <?php echo $this->lang->line('days')?></option>
                                        <option value="45">45 <?php echo $this->lang->line('days')?></option>
                                        <option value="60">60 <?php echo $this->lang->line('days')?></option>
                                        <option value="90">90 <?php echo $this->lang->line('days')?></option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 py-4">
                            <div class="row">
                                <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                    <input type="radio" name="display_product" value="custom_p_display_time" <?php if($product_details[0]['product_last_displaying_date']!='') echo 'checked'?>><?php echo $this->lang->line('or_select_your_desire_day')?>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-7 custom_p_display_time" style="display:<?php if($product_details[0]['product_last_displaying_date']!='') echo 'block';else echo 'none'?>;">
                                    <input type="text" class="date-picker form-control" placeholder="Select Date" value="<?php echo $product_details[0]['product_last_displaying_date']?>" name="p_display_custom_time" id="p_display_custom_time">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>






        <div class="row my-3">
            <div class="col-12">
                <div class="row background-off-white p-4">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <label><?php echo $this->lang->line('select_currency')?></label>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-9 col-lg-9">
                        <select id="price_currency" name="price_currency">
                            <?php foreach ($currencies AS $currency){ ?>
                                <option value="<?php echo $currency['currency_id']?>" <?php if($product_details[0]['ref_product_currency_id']==$currency['currency_id']) echo 'selected'?>><?php echo $currency['currency_symbol'].'( '.$currency["curency_name"].' )';?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12 my-2">
                        <label><?php echo $this->lang->line('product_price')?><span class="text-red">*</span> </label>
                        <div class="col-12 py-4">
                            <?php
                            $product_has_price_range=NULL;
                            $price=NULL;
                            if($product_details[0]['product_price']==0 || $product_details[0]['product_price']=='') $product_has_price_range=-1;
                            else
                            {
                                    $price=explode('-',$product_details[0]['product_price']);
                                    (sizeof($price)<=1)? $product_has_price_range=0 : $product_has_price_range=1;

                            }
                            ?>
                            <div class="row ">
                                <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <input type="radio" name="product_price" value="no_price" <?php if($product_has_price_range==-1) echo 'checked';?>><?php echo $this->lang->line('no_price')?>
                                </div>

                                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-4">
                                    <input type="radio" name="product_price" value="fixed_price" <?php if($product_has_price_range==0) echo 'checked';?>><?php echo $this->lang->line('fixed_price')?>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 fixed_price" style="display: <?php if($product_has_price_range==0) echo 'block';else echo 'none'?>">
                                    <input type="number" class="p-2 form-control" placeholder="FIXED PRICE" name="p_fixed_price" value="<?php if($product_has_price_range==0){echo $product_details[0]['product_price'];} ?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-12 py-4">
                            <div class="row">
                                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <input type="radio" name="product_price" value="custom_price" <?php if($product_has_price_range==1) echo 'checked';?>><?php echo $this->lang->line('select_price_range')?>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 custom_price" style="display: <?php if($product_has_price_range==1) echo 'block';else echo 'none'?>">
                                    <input type="number" class="p-2" style="width: 45%" placeholder="<?php echo $this->lang->line('start_price')?>" name="p_custom_price_from" value="<?php if($product_has_price_range==1) echo $price[0]?>">
                                    <label class="font-weight-bold px-2 mx-1"><?php echo $this->lang->line('to')?></label>
                                    <input type="number" class="p-2"  style="width: 45%" placeholder="<?php echo $this->lang->line('end_price')?>" name="p_custom_price_to" value="<?php if($product_has_price_range==1) echo $price[1]?>">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>




        <div class="row my-5" id="div_offer" style="display: <?php if($product_details[0]['product_price']=='' || $product_details[0]['product_price']=0)echo 'none'?>">
            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
                <label class="font-weight-bold"><?php echo $this->lang->line('product_offer_if_needed')?>:</label>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <label class="switch">
                    <input type="checkbox" id="product_has_offer" name="product_has_offer" <?php if($product_details[0]['product_has_offer']==1) echo 'checked';?>>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="col-12 offer-div" style="display: <?php if($product_details[0]['product_has_offer']==1) echo 'block'; else echo 'none';?>">
                <div class="row background-off-white">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <!--                        <label>PRODUCT PRICE<span class="text-red">*</span> </label>-->
                        <div class="col-12 py-4">
                            <div class="row">
                                <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <input type="radio" name="offer_product" value="select_reduce_price" <?php if($product_details[0]['product_offer_current_price']>0) echo 'checked'?>><?php echo $this->lang->line('reduce_price')?>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 select_reduce_price" style="display: <?php if($product_details[0]['product_offer_current_price']=='' || $product_details[0]['product_offer_current_price']==0) echo 'none';else echo 'block'?>">
                                    <input type="number" class="form-control" placeholder="REDUCE PRICE" name="p_price_abs_reduce" value="<?php echo $product_details[0]['product_offer_current_price']?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-12 py-4">
                            <div class="row">
                                <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <input type="radio" name="offer_product" value="custom_reduce_price" <?php if($product_details[0]['product_offer_price_percentage']>0) echo 'checked'?>><?php echo $this->lang->line('reduce_price_in_percentage')?>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 custom_reduce_price" style="display:  <?php if($product_details[0]['product_offer_price_percentage']=='' || $product_details[0]['product_offer_price_percentage']==0) echo 'none';else echo 'block';?>">
                                    <input type="number" class="form-control" placeholder="<?php echo $this->lang->line('reduce_price_in_percentage')?>" name="p_price_percent_reduce" value="<?php echo $product_details[0]['product_offer_price_percentage']?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 py-4">
                            <p><?php echo $this->lang->line('select_date_offer_will_be_valid_within')?>:</p>
                            <div class="row">
                                <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                    <input type="text" class="date-time-picker form-control" placeholder="Select Date" name="p_offer_from" value="<?php echo date_format(new DateTime($product_details[0]['product_offer_starting_date_time']),'Y-m-d h:ia'); ?>">
                                </div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2" style="text-align: center">
                                    <label><?php echo $this->lang->line('to')?></label>
                                </div>
                                <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                    <input type="text" class="date-time-picker form-control" placeholder="Select Date" name="p_offer_to" value="<?php echo date_format(new DateTime($product_details[0]['product_offer_ending_date_time']),'Y-m-d h:ia');  ?>">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12 box-off-white p-1 my-3" id="product_attr">
                <button class="btn-paste btn-block p-3" type="button" id="btn_add_new_attr"><?php echo $this->lang->line('add_product_attribute')?></button>
                <?php $current_attribute_id=-1; foreach ($product_details AS $product) {?>
                    <?php if($current_attribute_id<$product['product_attributes_id'] && $product['product_attributes_name']!=''){?>
                        <div class="row mt-3 p-2">
                            <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                <label><?php echo $this->lang->line('attribute_name')?></label>
                                <input type="text" class="form-control" name="product_attr_name[]" value="<?php echo $product['product_attributes_name']?>" required>
                            </div>
                            <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                <label><?php echo $this->lang->line('attribute_value')?></label>
                                <input type="text" class="form-control" name="product_attr_value[]"  value="<?php echo $product['product_attributes_values']?>" required>
                                <label class="text-red"><?php echo $this->lang->line('if_more_seperate_with_coma')?>(,)</label>
                            </div>
                            <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-4">
                                <button class="btn btn-danger btn-block mt-2 btn-attr-remove" type="button"><?php echo $this->lang->line('remove')?></button>
                            </div>
                        </div>
                        <?php $current_attribute_id= $product['product_attributes_id']; }?>
                <?php } ?>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12 box-off-white">
                <label class="mx-3 mt-2"><?php echo $this->lang->line('upload_cover_image')?></label>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" placeholder="CHOSE YOUR IMAGE" aria-describedby="basic-addon">
                    <div class="input-group-append">
                        <label for="product_display_image" class="input-group-btn btn-common py-2 mt-1" id="btd_p_disp_img"><?php echo $this->lang->line('upload')?></label>
                        <input type="file" id="product_display_image" name="product_display_image" onchange="dislpay_img_openFile(event)" class="collapse"/>
                    </div>
                </div>
                <div id="div_disp_img_preview" class="row">
                    <?php $product_imd_id=-1; foreach ($product_details AS $product) { ?>
                        <?php if($product_imd_id<$product['product_image_id'] && $product['product_image_is_display']==1 && $product['product_image_location']!='' && $product['product_image_active']==1){ ?>
                            <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2">
                                <img src="<?php echo base_url($product["product_image_location"])?>" width="100%">
                                <button type="button"  class="btn btn-danger remove-uploaded-product-img" content="<?php echo $product['product_image_id']?>"><?php echo $this->lang->line('delete')?></button>
                            </div>
                        <?php $product_imd_id=$product['product_image_id']; } ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12 box-off-white">
                <label class="mx-3 mt-2"><?php echo $this->lang->line('upload_more_images')?></label>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" placeholder="CHOSE YOUR IMAGE" aria-describedby="basic-addon">
                    <div class="input-group-append">
                        <label for="product_image" class="input-group-btn btn-common py-2 mt-1" id="btd_p_more_img"><?php echo $this->lang->line('upload')?></label>
                        <input type="file" id="product_image" name="product_image[]" multiple onchange="more_img_openFile(event)" class="collapse"/>
                    </div>
                </div>
                <div id="div_more_img_preview" class="row">
                    <?php $product_imd_id=-1; foreach ($product_details AS $product) { ?>
                        <?php if($product_imd_id<$product['product_image_id'] && $product['product_image_is_display']!=1 && $product['product_image_location']!='' && $product['product_image_active']==1){ ?>
                            <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2">
                                <img src="<?php echo base_url($product["product_image_location"])?>" width="100%">
                                <button type="button"  class="btn btn-danger remove-uploaded-product-img" content="<?php echo $product['product_image_id']?>" >Delete</button>
                            </div>
                        <?php $product_imd_id=$product['product_image_id']; } ?>
                    <?php } ?>
                </div>
            </div>
        </div>







<!---->
<!---->
<!--        <div class="row mt-4">-->
<!---->
<!--            <div class="col-12">-->
<!--                <div class="row background-off-white">-->
<!--                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
<!--                        <div class="row pt-2">-->
<!--                            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">-->
<!--                                <label class="">LIKE TO PUSH NOTIFICATION:</label>-->
<!--                            </div>-->
<!--                            <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">-->
<!--                                <label class="switch">-->
<!--                                    <input type="checkbox" name="push_notification" id="push_notification">-->
<!--                                    <span class="slider round"></span>-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="row my-5">
            <div class="col-12 text-center">
                <button type="submit" class="btn-common"><?php echo $this->lang->line('update_product')?></button>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript" rel="script"
        src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js') ?>"></script>

