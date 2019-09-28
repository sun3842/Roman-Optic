<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading "><?php echo $this->lang->line('app_details');?></label>
            <a href="<?php echo site_url('agent_apps')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back');?></a>
        </div>
    </div>
    <div class="col-12 my-3">
        <h2 class="text-paste"><?php echo $app_details[0]['app_details_app_name']?></h2>
        <p class="text-justify"><?php echo $app_details[0]['app_details_description']?></p>
        <label><?php echo $this->lang->line('app_available_expecting_date');?>:<span class="text-paste font-weight-bold"><?php echo date_format(new DateTime($app_details[0]['app_details_available_expecting_date']),'d F Y')?></span></label>
    </div>
    <div class="col-12 my-3">
        <h2><?php echo $this->lang->line('app_modules');?></h2>
        <ul>
            <?php $temp_module_id=-1; foreach ($app_details AS $detail){ ?>
                <?php if($detail['app_modules_id']>$temp_module_id) { ?>
                    <li><?php echo $detail['app_modules_name']?></li>
                <?php $temp_module_id=$detail['app_modules_id']; } ?>
            <?php } ?>
        </ul>
    </div>

    <div class="col-12 table-responsive my-3">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="title"><?php echo $this->lang->line('Platform');?></th>
                <th class="title"><?php echo $this->lang->line('release_date');?></th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="sub-title">IOS <i class="fab fa-apple"></i></td>
                <td><?php echo($app_details[0]['app_details_ios_available_date_time']=='')?'--:--:----':date_format(new DateTime($app_details[0]['app_details_ios_available_date_time']),'d F Y'); ?></td>
            </tr>
            <tr>
                <td class="sub-title">Android <i class="fab fa-android text-success"></i></td>
                <td><?php echo($app_details[0]['app_details_android_available_date_time']=='')?'--:--:----':date_format(new DateTime($app_details[0]['app_details_android_available_date_time']),'d F Y'); ?></td>
            </tr>


            </tbody>
        </table>
    </div>
</div>