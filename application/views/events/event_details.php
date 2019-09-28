<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading "> <?php echo $this->lang->line('event_details')?></label>
            <a href="<?php echo site_url('all_event_list')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="row">
                <?php foreach ($event AS $item){ ?>
                    <?php if($item['events_images_is_display_image']==1 && $item['events_images_location']!=''){ ?>
                        <div class="col-12">
                            <img class="img-product" width="100%" src="<?php echo base_url($item['events_images_location'])?>">
                        </div>

                        <?php } ?>
<!--                    --><?php //echo'problem'; ?>
                <?php } ?>
                <?php foreach ($event AS $item){?>
                    <?php if($item['events_images_is_display_image']==0 && $item['events_images_location']!='') {?>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <img class="img-product" width="100%" src="<?php echo base_url($item['events_images_location'])?>">
                        </div>
                    <?php } ?>

                <?php } ?>
            </div>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h4 class="text-color-grey text-weight-bold text-x-large"><?php echo $event[0]['events_title']?></h4>
            <p  class="text-color-grey text-weight-bold text-large"><?php echo $this->lang->line('event_duration')?> </p>
            <p  class="text-small text-color-grey text-weight-bold"><?php echo $this->lang->line('start_date_time')?> : <span><?php echo ($event[0]['events_starting_date_time']!='')?date_format(new DateTime($event[0]['events_starting_date_time']),'d F Y h:ia'):''?></span></p>
            <p  class="text-small text-color-grey text-weight-bold"><?php echo $this->lang->line('end_date_time')?> : <span><?php echo ($event[0]['events_ending_date_time']!='')?date_format(new DateTime($event[0]['events_ending_date_time']),'d F Y h:ia'):''?></span></p>
            <p  class="text-color-grey text-weight-bold text-large"><?php echo $this->lang->line('location')?> :</p>
            <p  class="text-small text-color-grey text-weight-bold"><?php echo $event[0]['events_location']?></p>

<!--            <div class="row box-off-white py-3">-->
<!--                <label class="label-block pl-3 my-2 text-color-grey text-weight-bold text-large display-inline-block">Share :</label><button class="btn-md-circle active mx-4 background-color-paste "><i class="fab fa-facebook-f text-color-white"></i></button><button class="btn-md-circle background-color-paste"><i class="fab fa-google-plus-g text-color-white"></i></button><button class="btn-md-circle mx-4 btn-md-circle background-color-paste"><i class="fab fa-twitter"></i> </button><button class="btn-md-circle  btn-md-circle background-color-paste" ><i class="fab fa-instagram"></i></i> </button>-->
<!---->
<!--            </div>-->


        </div>
        <div class="col-12">
            <p class="text-justify text-small text-weight-bold">
                <?php echo $event[0]['events_details']?>
            </p>
        </div>
<!--        <div class="col-12">-->
<!--            <p><strong>LINK SHARE ON SHARE:</strong> <label></label></p>-->
<!--            <div class="row">-->
<!--                <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">-->
<!--                    <input type="text" value="--><?php //echo uri_string()?><!--" id="clip_board_text" class="labe">-->
<!---->
<!--                </div>-->
<!--                <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">-->
<!--                    <a href="#" id="clip_board_btn" class="clip-board-btn">Copy Link</a>-->
<!--                    <label class="text-red" style="font-size: small"><i>(CLICK THE COPY LINK BUTTON GET THE SHAREABLE LINK)</i></label>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>