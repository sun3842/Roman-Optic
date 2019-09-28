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
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="row">
                <?php $offer_img_id=-1; foreach ($offer AS $item){ ?>
                    <?php  if($item['offer_image_id']!=$offer_img_id && $item['offer_image_active']==1 && $item['offer_image_is_display']==1) { ?>
                        <div class="col-12">
                            <img class="img-product" src='<?php echo site_url($item["offer_image_location"])?>' width="100%">
                        </div>
                        <?php $offer_img_id=$item['offer_image_id']; } ?>
                <?php  } ?>
                <?php $offer_img_id=-1; foreach ($offer AS $item){ ?>
                    <?php  if($item['offer_image_id']!=$offer_img_id && $item['offer_image_active']==1 && $item['offer_image_is_display']==0) { ?>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <img class="img-product" src='<?php echo site_url($item["offer_image_location"])?>' width="100%">
                        </div>
                        <?php $offer_img_id=$item['offer_image_id']; } ?>
                <?php  } ?>
            </div>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h4><?php echo $offer[0]['offer_title']?></h4>
            <p><?php echo $offer[0]['target_type_name']?></p>
            <p><strong><?php echo $this->lang->line('offer_created_date')?>:</strong <span><?php echo  date_format(new DateTime($offer[0]['offer_created_date_time']),'d F Y') ?></span></p>
            <p><strong><?php echo $this->lang->line('offer_starting_date_time')?>:</strong> <span><?php echo ($offer[0]['offer_starting_date_time']!='')?date_format(new DateTime($offer[0]['offer_starting_date_time']),'d F Y'):'' ?></span></p>
            <p><strong><?php echo $this->lang->line('offer_ending_date_time')?>: </strong><span><?php echo ($offer[0]['offer_ending_date_time']!='')?date_format(new DateTime($offer[0]['offer_ending_date_time']),'d F Y'):'' ?></span></p>

            <p class="text-paste"><?php echo $this->lang->line('offer_product')?>:</p>
            <p><?php  $temp_product_id=-1; foreach ($offer AS $item){ ?>
                <?php if($item['ref_offer_product_product_id']!=$temp_product_id && $item['offer_product_active']==1){ ?>

                <label><?php echo $item['product_name']?>,</label>

            <?php  $temp_product_id=$item['ref_offer_product_product_id'];}?>
            <?php } ?></p>
<!--            <p>COLOR: RED</p>-->
<!--            <p>SIZE: XL</p>-->
        </div>
        <div class="col-12">
            <p class="text-justify">
                <?php echo $offer[0]['offer_details']?>
            </p>
        </div>
        <div class="col-12">
           <?php if($offer[0]['ref_offer_target_type_id']==2){?>
               <?php if($offer[0]['is_condition_gender']==1){?>
                   <p><strong><?php echo $this->lang->line('offer_applicable_for_gender')?>:</strong> <?php  echo($offer[0]['condition_gender']==4)?'ALL':(($offer[0]['condition_gender']==1)?'MAN':(($offer[0]['condition_gender']==2)?'WOMEN':'none'))?> </p>
               <?php } ?>
               <?php if($offer[0]['is_condition_city']==1){?>
                   <p><strong><?php echo $this->lang->line('offer_applicable_for_cities')?>:</strong> <?php  echo $offer[0]['cities_name'] ?> </p>
               <?php }?>
               <?php if($offer[0]['is_condition_occupation']==1){?>
                   <p><strong><?php echo $this->lang->line('offer_applicable_for_occupation')?>:</strong> <?php  echo $offer[0]['occupation_list_name'] ?> </p>
               <?php }?>
               <?php if($offer[0]['is_condition_age_range']==1){?>
                   <p><strong><?php echo $this->lang->line('offer_applicable_for_age_range_in_year')?>: </strong><?php  echo $offer[0]['condition_starting_age'].'-'.$offer[0]['condition_ending_range'] ?> </p>
               <?php }?>
               <?php if($offer[0]['is_condition_birth_date']==1){?>
                   <p><strong><?php echo $this->lang->line('offer_applicable_for_birthday')?>:</strong> <?php  echo $offer[0]['condition_birth_date'] ?> </p>
               <?php }?>
               <?php if($offer[0]['is_condition_marital_status']==1){?>
                   <p><strong><?php echo $this->lang->line('offer_applicable_for_marital_status')?>:</strong> <?php  echo $offer[0]['marital_status_name'] ?> </p>
               <?php }?>

            <?php } ?>
        </div>
    </div>

</div>