<style type="text/css" rel="stylesheet">

    a{
        text-decoration: none;
        color: black;
        cursor: pointer;
    }
    a:hover{
        text-decoration: none;
        color: black;
        cursor: pointer;
    }
</style>
<div class="content">
<!--   <a href="--><?php //echo site_url('all_week_expired_lens_users')?><!--">-->
       <div class="row">
           <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3">
               <a href="<?php echo site_url('all_week_expired_lens_users')?>">
               <div class="card" style="width: 100%">
                   <!--            <img class="card-img-top" src="http://placehold.it/128x128" alt="Card image cap">-->
                   <div class="box-off-white">
                       <p class="font-weight-bold text-xl m-3 text-center"><?php echo $this->lang->line('total_user_lens_time_expired_within_7_days')?></p>
                   </div>
                   <div class="card-body">
                       <p class="card-text text-center"><?php echo sizeof($last_week_expired_lenses)?></p>
                   </div>
               </div>
               </a>
           </div>


           <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3">
                   <div class="card" style="width: 100%">
                       <!--            <img class="card-img-top" src="http://placehold.it/128x128" alt="Card image cap">-->
                       <div class="box-off-white">
                           <p class="font-weight-bold text-xl m-3 text-center"><?php echo $this->lang->line('total_download')?></p>
                       </div>
                       <div class="card-body">
                           <p class="card-text text-center"><?php echo sizeof($total_download)?></p>
                       </div>
                   </div>
           </div>

           <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3">
               <div class="card" style="width: 100%">
                   <!--            <img class="card-img-top" src="http://placehold.it/128x128" alt="Card image cap">-->
                   <div class="box-off-white">
                       <p class="font-weight-bold text-xl m-3 text-center"><?php echo $this->lang->line('total_chat_last_7_days')?></p>
                   </div>
                   <div class="card-body">
                       <p class="card-text text-center"><?php echo sizeof($total_chat_7_days)?></p>
                   </div>
               </div>
           </div>
           <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3">
               <div class="card" style="width: 100%">
                   <!--            <img class="card-img-top" src="http://placehold.it/128x128" alt="Card image cap">-->
                   <div class="box-off-white">
                       <p class="font-weight-bold text-xl m-3 text-center"><?php echo $this->lang->line('total_feedback_last_7_days')?></p>
                   </div>
                   <div class="card-body">
                       <p class="card-text text-center"><?php echo sizeof($total_feedback_7_days)?></p>
                   </div>
               </div>
           </div>
       </div>


</div>


