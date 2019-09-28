<div class="sidebar">

    <div class="sidebar-close">
        <button class="btn-sidebar-close"><i class="fas fa-times-circle"></i></button>
    </div>

    <div class="site-name mt-3">
        <h3><i>WhatsupOptic</i></h3>
    </div>
    <div class="site-logo">
        <img src="<?php echo base_url('assets/images/profile.png')?>">
    </div>
    <div class="site-name mb-5">
        <h4>WhatsupOptic</h4>
        <label class="font-weight-bold">App ID-12344378</label>
    </div>

    <div class="sidebar-option mt-5">
        <ul class="nav-bar">
            <li class="nav-bar-list">
                <i class="fas fa-tachometer-alt"></i>
                <a href="<?php echo site_url('home')?>"><?php echo $this->lang->line('dash_board');?></a>
            </li>


            <li class="nav-bar-list">
                <i class="fas fa-sitemap"></i>
                <a href="<?php echo base_url('all_category')?>"><?php echo $this->lang->line('category');?></a>
            </li>


            <li class="nav-bar-list">
                <i class="fas fa-chart-pie"></i>
                <a data-toggle="collapse" href="#product_option" role="button" aria-expanded="false" aria-controls="product_option"><?php echo $this->lang->line('product');?></a>
                <div class="sub-nav-bar-options collapse" id="product_option">
                    <ul class="sub-nav-bar">
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('all_product')?>"><?php echo $this->lang->line('all_product');?></a></li>
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('add_product')?>"><?php echo $this->lang->line('upload_product');?></a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-percent"></i>
                <a data-toggle="collapse" href="#offer_option" role="button" aria-expanded="false" aria-controls="offer_option"><?php echo $this->lang->line('offer');?></a>
                <div class="sub-nav-bar-options collapse" id="offer_option">
                    <ul class="sub-nav-bar">
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('all_offer')?>"><?php echo $this->lang->line('all_offer');?></a></li>
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('add_offer')?>"><?php echo $this->lang->line('add_offer');?></a></li>
                    </ul>
                </div>
            </li>


            <li class="nav-bar-list">
                <i class="fas fa-briefcase"></i>
                <a data-toggle="collapse" href="#service_option" role="button" aria-expanded="false" aria-controls="service_option"><?php echo $this->lang->line('service');?></a>
                <div class="sub-nav-bar-options collapse" id="service_option">
                    <ul class="sub-nav-bar">
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('create_service')?>"><?php echo $this->lang->line('create_service');?></a></li>
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('service_list')?>"><?php echo $this->lang->line('service_list');?></a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-images"></i>
                <a href="<?php echo base_url('all_gallery')?>"><?php echo $this->lang->line('gallery');?></a>
            </li>


            <li class="nav-bar-list">
                <i class="fas fa-envelope"></i>
                <a data-toggle="collapse" href="#message_option" role="button" aria-expanded="false" aria-controls="message_option"><?php echo $this->lang->line('message');?></a>
                <div class="sub-nav-bar-options collapse" id="message_option">
                    <ul class="sub-nav-bar">
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('create_message')?>"><?php echo $this->lang->line('create_message');?></a></li>
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('news_message_list')?>"><?php echo $this->lang->line('message_list');?></a></li>
                    </ul>
                </div>
            </li>



            <li class="nav-bar-list">
                <i class="fas fa-calendar-alt"></i>
                <a data-toggle="collapse" href="#events_option" role="button" aria-expanded="false" aria-controls="events_option"><?php echo $this->lang->line('event');?></a>
                <div class="sub-nav-bar-options collapse" id="events_option">
                    <ul class="sub-nav-bar">
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('create_event')?>"><?php echo $this->lang->line('create_event');?></a></li>
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('all_event_list')?>"><?php echo $this->lang->line('all_event');?></a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-arrow-alt-circle-down"></i>
                <a href="<?php echo base_url('all_download')?>"><?php echo $this->lang->line('download');?></a>
            </li>


            <li class="nav-bar-list">
                <i class="fas fa-search"></i>
                <a href="<?php echo base_url('inquiry_list')?>"><?php echo $this->lang->line('inquiry_list');?></a>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-pencil-alt"></i>
                <a href="<?php echo base_url('all_feedback')?>"><?php echo $this->lang->line('feedback');?></a>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-comments"></i>
                <a href="<?php echo base_url('chat')?>"><?php echo $this->lang->line('chat');?></a>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-user-circle"></i>
                <a href="<?php echo base_url('all_optician')?>"><?php echo $this->lang->line('opticians');?></a>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-question-circle"></i>
                <a href="<?php echo base_url('all_branch')?>"><?php echo $this->lang->line('about_us_contact_us');?></a>
            </li>




            <li class="nav-bar-list">
                <i class="fas fa-tablets"></i>
                <a data-toggle="collapse" href="#lens_option" role="button" aria-expanded="false" aria-controls="lens_option"><?php echo $this->lang->line('lens');?></a>
                <div class="sub-nav-bar-options collapse" id="lens_option">
                    <ul class="sub-nav-bar">
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('lens_user')?>"><?php echo $this->lang->line('lens_user');?></a></li>
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('add_lens_user')?>"><?php echo $this->lang->line('add_lens_user');?></a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-newspaper"></i>
                <a data-toggle="collapse" href="#news_option" role="button" aria-expanded="false" aria-controls="news_option"><?php echo $this->lang->line('news');?></a>
                <div class="sub-nav-bar-options collapse" id="news_option">
                    <ul class="sub-nav-bar">
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('create_news')?>"><?php echo $this->lang->line('create_news');?></a></li>
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('news_list')?>"><?php echo $this->lang->line('news_list');?></a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-tags"></i>
                <a data-toggle="collapse" href="#order_option" role="button" aria-expanded="false" aria-controls="order_option"><?php echo $this->lang->line('product_tracking')?></a>
                <div class="sub-nav-bar-options collapse" id="order_option">
                    <ul class="sub-nav-bar">
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('add_order')?>"><?php echo $this->lang->line('add_tracking')?></a></li>
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('order_list')?>"><?php echo $this->lang->line('all_tracking')?></a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-briefcase"></i>
                <a data-toggle="collapse" href="#job_option" role="button" aria-expanded="false" aria-controls="job_option"><?php echo $this->lang->line('job');?></a>
                <div class="sub-nav-bar-options collapse" id="job_option">
                    <ul class="sub-nav-bar">
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('create_job')?>"><?php echo $this->lang->line('create_job');?></a></li>
                        <li class="sub-nav-bar-list"><a href="<?php echo base_url('job_list')?>"><?php echo $this->lang->line('all_job');?></a></li>
                    </ul>
                </div>
            </li>


            <li class="nav-bar-list">
                <i class="fas fa-chart-line"></i>
                <a href="#"><?php echo $this->lang->line('report_statistic');?></a>
            </li>

            <li class="nav-bar-list">
                <i class="fas fa-user"></i>
                <a href="<?php echo base_url('check_account_password')?>"><?php echo $this->lang->line('account_management');?></a>
            </li>










































<!--            <li class="nav-bar-list">-->
<!--                <i class="fas fa-user-circle"></i>-->
<!--                <a href="--><?php //echo base_url('profile')?><!--">Profile</a>-->
<!--            </li>-->

            <li class="nav-bar-list">
                <i class="fas fa-sign-out-alt"></i>
                <a href="<?php echo base_url('logout')?>"><?php echo $this->lang->line('sign_out');?></a>
            </li>
        </ul>
    </div>




</div>



<!--body start-->
<div class="body">

