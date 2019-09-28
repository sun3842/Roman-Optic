<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css')?>">
<style type="text/css" rel="stylesheet">
    
    .row>div{
        margin: 4px 0 12px 0;
    }

    .light_gray_background_color{

    	background-color: #E2E3E5;
    }

    .image-size{

        border-radius: 160px;
    }
  @media screen and (min-width: 720px) and (max-width: 992px) 
       {
        .lens-details{

            font-size: xx-small;
        }

  }


   @media screen and (min-width: 200px) and (max-width: 420px)
       {
        .lens-details{

            font-size: xx-small;
        }

  }
  
  

    </style>


    <div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('inquiry_reply')?></label>
            <a href="<?php echo site_url('inquiry_list')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>

    </div>

	
                       
           <div class="row p-4">

            <div class="col-12 light_gray_background_color">

              <div class="row">

                  <?php if($inquiry[0]['ref_inquiry_product_id']!=''){?>
                      <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-7 col-xl-8 text-weight-bold p-5 lens-details">


                          <div ><label><label><?php echo $inquiry[0]['product_name']?></label></div>
                          <div ><label><?php echo $this->lang->line('category')?></label><label><span class="p-2">:</span><?php echo $inquiry[0]['category_name'] ?></label></div>
                          <div ><label><?php echo $this->lang->line('last_display_date')?></label><label><span class="p-2">:</span><?php echo date_format(new DateTime($inquiry[0]['product_last_displaying_date']), 'd F Y')?></label></div>
                          <div class="text-danger"><label><?php echo $this->lang->line('price')?></label><label><span class="p-2">:</span><?php echo $inquiry[0]['product_last_displaying_date'].'('.$inquiry[0]['currency_symbol'].')'?></label></div>
                          <?php $temp_attr=-1; foreach ($inquiry AS $item){?>
                              <?php if($temp_attr<$item['product_attributes_id']) { ?>
                                    <div ><label ><?php echo $item['product_attributes_name']?></label><label><span class="p-2">:</span><?php echo $item['product_attributes_values'] ?></label></div>
                                  <?php $temp_attr=$item['product_attributes_id']; } ?>
                          <?php } ?>
                      </div>
                  <?php } ?>

                  <?php if($inquiry[0]['ref_inquiry_offer_id']!=''){?>
                      <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-7 col-xl-8 text-weight-bold p-5 lens-details">
                          <div ><label><label><?php echo $inquiry[0]['offer_title']?></label></div>
                          <div ><label><?php echo $this->lang->line('offer_duration')?>:</label><label><span class="p-2">:</span><?php echo date_format(new DateTime($inquiry[0]['offer_starting_date_time']), 'd F Y').' TO '. date_format(new DateTime($inquiry[0]['offer_ending_date_time']), 'd F Y')?></label></div>
                         <div ><label><?php echo $this->lang->line('offer_type')?>:</label><label><span class="p-2">:</span><?php if($inquiry[0]['ref_offer_target_type_id']==1)echo 'General';else if($inquiry[0]['ref_offer_target_type_id']==2)echo 'Target';else echo 'None';?></label></div>

                      <?php if ($inquiry[0]['ref_offer_target_type_id']==2){ ?>
                          <h3 class="label-block"><?php echo $this->lang->line('offer_conditions')?></h3>
                          <?php if($inquiry[0]['is_condition_gender']==1) {?>
                                <label class="label-block"><?php echo $this->lang->line('gender')?>: <?php if($inquiry[0]['condition_gender']==1)echo 'Male';else if($inquiry[0]['condition_gender']==2)echo 'Female';else echo 'Both';?></label>
                              <?php } ?>

                          <?php if($inquiry[0]['is_condition_city']==1) {?>
                              <label class="label-block"><?php echo $this->lang->line('cities')?>: <?php echo $inquiry[0]['cities_name']?></label>
                          <?php } ?>

                          <?php if($inquiry[0]['condition_marital_status_id']==1) {?>
                              <label class="label-block"><?php echo $this->lang->line('marital_status')?>: <?php echo $inquiry[0]['marital_status_name']?></label>
                          <?php } ?>

                          <?php if($inquiry[0]['is_condition_occupation']==1) {?>
                              <label class="label-block"><?php echo $this->lang->line('occupation')?>: <?php echo $inquiry[0]['occupation_list_name']?></label>
                          <?php } ?>

                          <?php if($inquiry[0]['is_condition_birth_date']==1) {?>
                              <label class="label-block"><?php echo $this->lang->line('date_of_birth')?>: <?php echo date_format(new DateTime($inquiry[0]['condition_birth_date']), 'd F Y')?></label>
                          <?php } ?>

                          <?php } ?>
                      </div>
                  <?php } ?>



             
            <div class="col-10 col-xs-6 col-sm-6 col-md-6 col-lg-5 col-xl-4 p-5 " >
                <?php if($inquiry[0]['ref_inquiry_product_id']!=''){ ?>
                    <img src="<?php echo base_url($inquiry[0]['product_image_location'])?>" width = "100%">
                <?php } ?>
                <?php if($inquiry[0]['ref_inquiry_offer_id']!=''){ ?>
                    <img src="<?php echo  base_url($inquiry[0]['offer_image_location'])?>" width = "100%">
                <?php } ?>


            </div>

        </div>

        </div>

    </div>


          <div class="row my-5 p-4">



                   <div class="col-5 col-xs-5 col-sm-4 col-md-3 col-lg-3">

                       <?php if($inquiry[0]['ref_inquiry_product_id']!=''){ ?>
                           <img src="<?php echo base_url($inquiry[0]['product_image_location'])?>" width = "100%">
                       <?php } ?>
                       <?php if($inquiry[0]['ref_inquiry_offer_id']!=''){ ?>
                           <img src="<?php echo  base_url($inquiry[0]['offer_image_location'])?>" width = "100%">
                       <?php } ?>

                   </div>

                   <div class="col-12 col-xs-12 col-sm-8 col-md-9 col-lg-9 text-small text-weight-bold">
                       
                      <div class="row ">
                           
                                <div class="col-12 " style="font-size: large;color:#4D4E44; "><label><?php echo $inquiry[0]['inquiry_full_name']?></label></div>
                                <div class="col-12"><label><?php echo $this->lang->line('phone')?></label><span class="p-2">:</span><?php echo $inquiry[0]['inquiry_phone_number']?></label></div>
                                <div class="col-12"><label><?php echo $this->lang->line('email')?></label><span class="p-2">:</span><?php echo $inquiry[0]['inquiry_email_address']?></label></div>
                                <div class="col-12 "><label><?php echo $inquiry[0]['inquiry_message']?></label></div>

                            <div class="col-12 text-danger"><label><?php echo date_format(new DateTime($inquiry[0]['inquiry_date_time']),'d F Y')?></label></div>

                          <?php $temp_rep=-1; foreach ($inquiry as $value) {?>
                              <?php if($value['inquiry_message_id']!=''  && $value['inquiry_message_id']>$temp_rep) {?>
                          <div class="col-12">
                                  <label class="text-small" ><?php if($value['inquiry_reply_from_user']==1)echo '<span class="font-weight-bold">'.$inquiry[0]['inquiry_full_name'].'</span>';else echo '<span class="font-weight-bold">Admin</span>';?></label>
                                  <p><?php echo $value['inquiry_reply_message']?></p>
                          </div>
                                  <?php $temp_rep=$value['inquiry_message_id']; } ?>
                          <?php } ?>


                          <div class="col-12">
                              <form method="post" id="form_reply">
                                  <label class="text-small" ><?php echo $this->lang->line('reply')?></label>
                                  <textarea class="p-2" placeholder="Write here..." name="inquiry_reply" id="inquiry_reply"></textarea>
                                  <input type="submit" class="btn-common my-5" value="<?php echo $this->lang->line('reply')?>" name="reply_submit">
                              </form>
                          </div>

                   </div>


        </div>
</div>

</div>


<script type="text/javascript" rel="script">
    $('#form_reply').validate({
        rules: {
            inquiry_reply: {
                required: true
            }
        }
    });
</script>

