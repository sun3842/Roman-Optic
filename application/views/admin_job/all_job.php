<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css')?>">
<style type="text/css" rel="stylesheet">


    .btn-load-more{
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }


    .dialog_box_job_title{

        margin-right: 5px;
        margin-top: 10px;
        font-weight: bold;
        float: left;
    }


</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('job_list');?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i><?php echo $this->lang->line('back');?></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="<?php echo $this->lang->line('search');?>" aria-describedby="basic-addon">



                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="col-12 table-responsive">
            <table class="table table-striped text-center" id="table_message">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('job_title');?></th>
                    <th><?php echo $this->lang->line('job_position');?></th>
                    <th><?php echo $this->lang->line('date');?></th>
                    <th><?php echo $this->lang->line('action');?></th>
                </tr>
                </thead>

                <?php foreach($jobs_details as $job_details)

                {

                    ?>

                    <tr >
                        <td><?php echo $job_details['jobs_title']?></td>
                        <td><?php echo $job_details['job_position_name']?></td>
                        <td><?php echo date_format(new DateTime($job_details['jobs_created_edited_date_time']),'d F Y');?></td>
                        <td>
                            <a href="#" class="action action-view" onclick='JobDetails(<?php echo json_encode($job_details);?>,event)'><i class="fas fa-eye"></i></a>
                            <a href="<?php echo site_url('edit_job/'.$job_details["jobs_id"])?>" class="action action-edit" ><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete" onclick='delete_job(<?php echo $job_details["jobs_id"]?>,event)'><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>

                <?php } ?>

            </table>

        </div>

    </div>

<!--job view-->

    <div class="modal fade bd-example-modal-lg" id="job_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title dialog_header" id="exampleModalLongTitle"><?php echo $this->lang->line('job_details');?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #fff">&times;</span>
                    </button>
                </div>


                <div class="col-12"><label class="dialog_box_job_title text-medium" id ="job_title"><?php echo $this->lang->line('there_will_be_one_sit_vacant_for_salesman');?></label> </div>
                 <div class="row" style="margin: 15px;">

                    <div class="col-12"><label class="text-x-large"><span class=""><?php echo $this->lang->line('job_position');?><span> :</span><span> </span></span><span id="job_position">SALESMAN</span></label></div>
                    <div class="col-12"><label ><span class="font-weight-bold"><?php echo $this->lang->line('employment_status');?><span> :</span></span><span> </span><span id="emp_status">FULLTIME</span></label></div>
                    <div class="col-12"><label ><span class="font-weight-bold"><?php echo $this->lang->line('job_context');?><span> :</span> <br></span><span id="job_context">Definition of detail for English Language Learners. : a small part of something. : the small parts of something. : a particular fact or piece of information about something or someone</span></label></div>
                    <div class="col-12"><label ><span class="font-weight-bold"><?php echo $this->lang->line('job_experience');?><span> :</span> <br></span><span id="job_exp">Definition of detail for English Language Learners. : a small part of something.</span></label></div>
                    <div class="col-12"><label ><span class="font-weight-bold"><?php echo $this->lang->line('job_educational_requirement');?><span> :</span> <br></span><span id="job_edu_req">Definition of detail for English Language Learners. : a small part of something.</span></label></div>
                     <div class="col-12"><label ><span class="font-weight-bold"><?php echo $this->lang->line('salary_range');?>  </span><span>:</span><span id="salary_range" style="font-weight: bold">&nbsp500-10000</span> <span id="currency">TK</span><span> </span><span id="negotiate" class="font-weight-bold"></span></label></div>
                    <div class="col-12"><label ><span class="font-weight-bold"><?php echo $this->lang->line('deadline');?>  :</span> <span id="deadline">12/1/2018</span></label></div>
                    <div class="col-12"><label ><span class="font-weight-bold"><?php echo $this->lang->line('job_location');?>  </span><span> :</span><span id="job_location">&nbsp34/B BADDA</span></label></div>

                 </div>
            </div>
        </div>
    </div>


    <!-- delete section -->
    <div class="modal fade" id="delete_job_modal" tabindex="-1" role="dialog" aria-labelledby="delete_job_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('delete_job_info');?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo site_url('d')?>">

                    <div class="modal-body">
                        <?php echo $this->lang->line('are_you_sure_to_delete_this_job_info');?>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-danger" id="btn_delete_job"><?php echo $this->lang->line('delete');?></a>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js')?>"></script>


    <script type="text/javascript" rel="script">
        $('.date-time-picker').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
        });


        function JobDetails(job_array,event) {

            var negotiable = "";
            switch(job_array['jobs_salary_negotiable'])
            {
                case '0': negotiable = "<?php echo $this->lang->line('not_negotiable');?>";
                    break;
                case '1': negotiable = "<?php echo $this->lang->line('negotiable');?>";
                    break;

            }

            event.preventDefault();
            $('#job_title').html("");
            $('#job_position').html("");
            $('#emp_status').html("");
            $('#job_context').html("");
            $('#job_exp').html("");
            $('#job_edu_req').html("");
            $('#salary_range').html("");
            $('#currency').html("");
            $('#negotiate').html("");
            $('#deadline').html("");
            $('#job_location').html("");


            $('#job_title').html(job_array['jobs_title']);
            $('#job_position').html(job_array['job_position_name']);
            $('#emp_status').html(job_array['employment_status_name']);
            $('#job_context').html(job_array['jobs_context']);
            $('#job_exp').html(job_array['jobs_experiences_requirement']);
            $('#job_edu_req').html(job_array['jobs_educational_requirement']);
            $('#salary_range').html(job_array['jobs_salary_range']);
            $('#currency').html(job_array['curency_name']);
            $('#negotiate').html(negotiable);
            $('#deadline').html(job_array['jobs_deadline_date']);
            $('#job_location').html(job_array['jobs_location']);


            $('#job_modal').modal('show');
        }

        function delete_job(job_id,event) {
            event.preventDefault();
            $('#btn_delete_job').attr('href','<?php  echo site_url('delete_job/')?>'+job_id);
            $('#delete_job_modal').modal("show");
        }

        var stating_message_list= '<?php echo DEFAULT_DATA_LIMIT ?>';

        $('.btn-load-more').click(function()

        {
            $.ajax({
                type: 'POST',
                url: '<?php echo uri_string()?>',
                data: {offer_start_limit : stating_message_list},
                success: function (result) {
                    message=$.parseJSON(result);
                    total_message=message.length;
                    for(var i=0;i<total_message;i++)
                    {

                        $('#table_message').find('tbody').append("<tr>\n" +
                            "                    <td>"+message[i]['message_last_edited_date_time']+"</td>\n" +
                            "                    <td>"+message[i]['message_title']+"</td>\n" +
                            "                    <td>"+message[i]['ref_message_target_type_id']+"</td>\n" +

                            "                    <td>\n" +
                            "                        <a href='#' onclick='MessageDetails("+JSON.stringify(message[i])+",event)' class='action action-view'><i class='fas fa-eye'></i></a>\n" +
                            "                        <a href='<?php echo site_url('edit_message/')?>"+message[i]['message_id']+"' class='action action-edit'><i class='far fa-edit'></i></a>\n" +
                            "                        <a href='#' onclick='delete_message("+message[i]['message_id']+",event)' class='action action-delete'><i class='far fa-trash-alt'></i></a>\n" +
                            "                    </td>\n" +
                            "                </tr>");

                    }
                    stating_message_list=parseInt(stating_message_list,10)+<?php echo DEFAULT_DATA_LIMIT?>;
                },
                error:function (error) {
                    alert(error);
                }
            });

        });



    </script>
