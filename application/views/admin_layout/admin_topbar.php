<div class="top-bar">


    <div class="row pt-3 px-4">
        <div class="sidebar-show col-4 col-xs-4 col-sm-4">
            <button class="btn-sidebar-show"><i class="fas fa-bars"></i></button>
        </div>
        <div class="col-8 col-xs-8 col-sm-8 col-md-3 col-lg-3 page-title">
            <h4 class="text-white"><?php if(isset($title))echo $title; else echo '';?></h4>
        </div>


        <div class="col-4 col-xs-2 col-sm-2 col-md-1 col-lg-2 page-refresh">
           <!-- <h4 class="text-white"><a href="<?php echo uri_string();?>"><i class="fas fa-sync-alt"></i></a></h4>-->
        </div>
        <div class="col-8 col-xs-5 col-sm-4 col-md-3 col-lg-3 page-search input-group">
           <!-- <input type="text" class="form-control" id="top_bar_search" name="top_bar_search" placeholder="<?php echo $this->lang->line('search')?>...">-->
            <div class="input-group-btn">
                <!--
                <button class="btn btn-white" type="button">
                    <i class="fas fa-search"></i>
                </button>
                -->
            </div>
        </div>

        <div class="offset-4 col-8  offset-xs-0 col-xs-3 offset-sm-0 col-sm-3   offset-md-0 col-md-2 offset-lg-0 col-lg-2 float-right">
            <select name="language" role="<?php echo uri_string();?>" about="<?php echo base_url('set_language/')?>" id="language">
                <option value="LANG_EN" <?php if($this->session->userdata('language')=='LANG_EN')echo 'selected'?>>ENGLISH</option>
                <option value="LANG_IT" <?php if($this->session->userdata('language')=='LANG_IT')echo 'selected'?>>ITALIAN</option>
            </select>
        </div>

        <div class="col-12 col-xs-2 col-sm-3 col-md-3 col-lg-2 page-chat-notification">
            <label class="text-white"><a href="#"><i class="fas fa-comments"></i></a></label>
            <label class="text-white"><a href="#"><i class="far fa-bell"></i></a></label>
        </div>
    </div>

</div>