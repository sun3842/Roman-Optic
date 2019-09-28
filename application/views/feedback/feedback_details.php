<link rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins/font-awesome/web-fonts-with-css/css/all.css');?>">
<style type="text/css" rel="stylesheet">
    .div-rating label{
        display: inline-block;
        cursor: pointer;
        width: 50px;
        height: 25px;
        background-color: white;
    }
    .div-rating input{
        /*display: none;*/
    }
    .rating{
        display: inline-block;
    }

    .div-rating>.rating>input + label:hover{
        color: yellow;
        /*background-color: yellow;*/
    }
    .div-rating>.rating>input + label:hover ~ .rating{
        color: yellow;
        /*background-color: yellow;*/
    }
    .div-rating input{
        display: none;
    }
    .div-rating>.rating>input + label{
        font-size: x-large;
        background-color: inherit;
    }
    .img-user{
        width: 100%;
        border-radius: 60%;
    }
</style>
<div class="content">

    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading font-color"><?php echo $this->lang->line('user_feedback');?> </label>
            <a href="<?php echo base_url('home')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i><?php echo $this->lang->line('back');?></a>
        </div>
    </div>

    <div class="row box-off-white my-3 p-4 ">
        <div class="col-12 text-center">
            <h5 class="font-color font-weight-bold"><?php echo $this->lang->line('average_rating');?></h5>
        </div>
        <div class="col-12 text-center div-rating">
            <?php  $avg_rat=round($feedbacks_details[0]['avg_rat'],1);?>
            <p class="text-center">
                <i class="fas <?php if($avg_rat<1 &&  $avg_rat>0){echo "fa-star-half";$flag=1;} else echo "fa-star"?> <?php if($avg_rat>0) echo 'text-warning'?>"></i>
                <i class="fas <?php if($avg_rat<2 &&  $avg_rat>1){echo "fa-star-half";$flag=1;} else echo "fa-star"?> <?php if($avg_rat>1) echo 'text-warning'?>"></i>
                <i class="fas <?php if($avg_rat<3 &&  $avg_rat>2){echo "fa-star-half";$flag=1;} else echo "fa-star"?> <?php if($avg_rat>2) echo 'text-warning'?>"></i>
                <i class="fas <?php if($avg_rat<4 &&  $avg_rat>3){echo "fa-star-half";$flag=1;} else echo "fa-star"?> <?php if($avg_rat>3) echo 'text-warning'?>"></i>
                <i class="fas <?php if($avg_rat<5 &&  $avg_rat>4){echo "fa-star-half";$flag=1;} else echo "fa-star"?> <?php if($avg_rat>4) echo 'text-warning'?>"></i>
                <!--                <i class="fas fa-star-half-alt" style="color: red"></i>-->
                <!--                <i class="fas fa-star-half"></i>-->
            </p>
            <p class="text-xx-large text-bold text-center">(<?php  echo $avg_rat ;?>/5)</p>

        </div>

    </div>

    <div class="row">
        <div class="col-12 col-xs-12 col-sm-4 col-md-2 col-lg-1">
            <img class="img-user" src="<?php echo base_url('assets/images/product/product_view.png')?>">
        </div>
        <div class="col-12 col-xs-12 col-sm-8 col-md-10 col-lg-11">
            <h4 class=""><?php echo $feedbacks_details[0]['downloaded_user_first_name']." ".$feedbacks_details[0]['downloaded_user_last_name'] ?><small class="pl-2" id="feeedback_privacy"><?php echo($feedbacks_details[0]['feedback_is_public']==1)? $this->lang->line('public'):$this->lang->line('private') ?><span class="text-paste ml-1"><i class="<?php echo($feedbacks_details[0]['feedback_is_public']==1)? "fas fa-unlock" :"fas fa-lock"?>"></i></span></small></h4>

            <div class="rating">
<!--                --><?php
//                $rating = 5;
//                for($i=0; $i<$feedbacks_details[0]['feedback_rating_score']; $i++)
//                {
//                    $p= "fas fa-star star";
//                    ?>
<!--                    <label><i class="--><?php //echo $p; ?><!--"></i></label>-->
<!---->
<!--                --><?php //}
//                $val = $rating - $feedbacks_details[0]['feedback_rating_score'];
//                for($i=0; $i<$val; $i++)
//                {
//                    $p= "far fa-star";
//                    ?>
<!--                    <label><i class="--><?php //echo $p; ?><!--"></i></label>-->
<!---->
<!--                --><?php //} ?>
                <i class="fas fa-star <?php if($feedbacks_details[0]['feedback_rating_score']>=1) echo 'text-warning'?>"></i>
                <i class="fas fa-star <?php if($feedbacks_details[0]['feedback_rating_score']>=2) echo 'text-warning'?>"></i>
                <i class="fas fa-star <?php if($feedbacks_details[0]['feedback_rating_score']>=3) echo 'text-warning'?>"></i>
                <i class="fas fa-star <?php if($feedbacks_details[0]['feedback_rating_score']>=4) echo 'text-warning'?>"></i>
                <i class="fas fa-star <?php if($feedbacks_details[0]['feedback_rating_score']>=5) echo 'text-warning'?>"></i>
            </div>

            <p>
                <?php echo $feedbacks_details[0]['feedback_message'];  ?>
            </p>

            <?php foreach ($feedbacks_details as $feedback_details) {

                ?>
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-4 col-md-2 col-lg-1">
                        <img class="img-user" src="<?php echo base_url('assets/images/product/product_view.png')?>">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-8 col-md-10 col-lg-11 my-3">
                        <h5 class=""><?php echo ($feedback_details['feedback_reply_from_downloaded_user'] == 0) ? $this->lang->line('admin') : $feedback_details['rep_first_name']." ".$feedback_details['rep_last_name'] ?><small class="pl-2"> <?php echo ($feedback_details['feedback_reply_from_downloaded_user'] == 0) ? $this->lang->line('from_administrator') : " " ?>  </small></h5>
                        <p>
                            <?php echo $feedback_details['feedback_reply_message']  ?>

                    </div>
                </div>

            <?php } ?>

            <form method="POST">

                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-4 col-md-2 col-lg-1">
                        <img class="img-user" src="<?php echo base_url('assets/images/product/product_view.png')?>">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-8 col-md-10 col-lg-11>
                    <h5 class=""><?php echo $this->lang->line('admin');?><small class="pl-2"><?php echo $this->lang->line('from_administrator');?></small></h5>
                </div>
        </div>
        <textarea class="my-2" name="admn_reply" id="admn_reply"></textarea>
        <input type="hidden" name="feedback_id" id="feedback_id" value="<?php echo $feedbacks_details[0]['feedback_id'] ?>">
        <input type="hidden" name="downloaded_user_id" id="downloaded_user_id" value="<?php echo $feedbacks_details[0]['downloaded_user_id'] ?>">
        <input class="btn-common my-4" type="submit" name="admin_reply_submit" id="admin_reply_submit" value="<?php echo $this->lang->line('reply');?>">

        </form>
    </div>

</div>
</div>

</div>
</div>