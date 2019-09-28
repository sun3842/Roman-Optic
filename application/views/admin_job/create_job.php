<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css') ?>">
<link  type="text/css" rel="stylesheet"  href="<?php echo base_url('assets/app_assets/plugins/jquery-ui-1.12.1/jquery-ui.css') ?>">
<style type="text/css" rel="stylesheet">
    .row>div{
        margin: 4px 0 12px 0;
    }
</style>
<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('job');?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back');?></a>
        </div>
    </div>

    <label class="page-heading"><?php echo $this->lang->line('create_job');?></label>

    <form id="job_form" method="post">


    <div class="row">
        <div class="col-12">
            <label><?php echo $this->lang->line('job_title');?><span class="text-red">*</span></label>
            <input type="text" class="form-control" name="job_title" id="job_title">
        </div>

        <div class="col-12">
            <label><?php echo $this->lang->line('job_context');?></label>
            <textarea name="job_context" id="job_context"></textarea>
        </div>

        <div class="col-12">
            <label><?php echo $this->lang->line('job_educational_requirement');?></label>
            <textarea name="job_edu_req" id="job_edu_req"></textarea>
        </div>

        <div class="col-12">
            <label><?php echo $this->lang->line('job_experience_requirement');?></label>
            <textarea name="job_exp_req" id="job_exp_req"></textarea>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-4">
            <label><?php echo $this->lang->line('currency_name');?></label>

            <select id="job_type" name="currency_name" id="currency_name">
                <?php foreach($currency as $curr) { ?>
                <option value="<?php echo $curr['currency_id'] ?>"><?php echo $curr['curency_name'] ?></option><?php } ?>
            </select>

        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label><?php echo $this->lang->line('job_position');?><span class="text-red">*</span></label>
            <select name="job_position" id="job_position">
                <?php foreach($jobs_position as $jobs_pos) { ?>
                    <option value="<?php echo $jobs_pos['job_position_id'] ?>"><?php echo $jobs_pos['job_position_name'] ?></option><?php } ?>
            </select>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label><?php echo $this->lang->line('employment_status');?><span class="text-red">*</span></label>
            <select name="employment_status" id="employment_status">
                <?php foreach($employment_status as $emp_status) { ?>
                    <option value="<?php echo $emp_status['employment_status_id'] ?>"><?php echo $emp_status['employment_status_name'] ?></option><?php } ?>
            </select>
        </div>

        <div class="col-12  mt-5"><label class="text-medium"><input type="checkbox" name="salary_neg" id="salary_neg"><span class="ml-2"><?php echo $this->lang->line('salary_negotiable');?></span></label></div>


        <div class="col-12  mb-5">
            <label><?php echo $this->lang->line('choose_salary_range');?></label>
            <input id="select_salary_limit" name="select_salary_limit" type="text" readonly class="slide_range text-center">
            <div id="slider-range" class="my-3"></div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-5">
            <label><?php echo $this->lang->line('deadline_time');?></label>
            <input type="text" class="date-time-picker form-control"  name="choose_deadtime" placeholder="Select Date" id="choose_deadtime">
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-5">
            <label><?php echo $this->lang->line('job_location');?></label>
            <input type="text" class="form-control" name="job_location" id="job_location">
        </div>


        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <input type="submit" name="job_info_submit" id="job_info_submit" class="btn-common" value="CONFIRM">
        </div>

    </div>

    </form>
</div>


<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js') ?>"></script>
<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins/jquery-ui-1.12.1/jquery-ui.js') ?>"></script>

<script type="text/javascript" rel="script">

    $('.date-time-picker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });

    $(function () {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 50000,
            values: [0, 12000],
            slide: function (event, ui) {
                $("#select_salary_limit").val(" " + ui.values[0] + " - " + ui.values[1]);
            }
        });
        $("#select_salary_limit").val(" " + $("#slider-range").slider("values", 0) +
            " - " + $("#slider-range").slider("values", 1));
    });

    $('#job_form').validate({

        rules : {

            job_title : {

                required : true
            },

            job_position:{

                required : true
            },

            employment_status:{

                required : true
            },


        }

    });



</script>