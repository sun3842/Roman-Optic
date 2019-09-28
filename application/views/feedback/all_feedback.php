<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css')?>">
<style type="text/css" rel="stylesheet">
    .box-white{
        background-color: white;
        display: block;
    }
    .logo-lg{
        font-size: 50px;
    }
    .feedback-status{
        width: auto;
        border: none;
        outline: none;
        display: inline-block;
        background: transparent;
    }
</style>
<div class="content">

    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading font-color"><?php echo $this->lang->line('user_feedback');?></label>
            <a href="<?php echo base_url('home')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i><?php echo $this->lang->line('back');?></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3 p-2">
            <div class="box-white text-center p-5">
                <i class="fas fa-pencil-alt logo-lg font-color"></i>
                <p class="my-4 font-weight-bold font-color large"><?php echo $this->lang->line('total_feedback');?></p>
                <h3 class="text-paste"><?php echo count($feedback_count)?></h3>
            </div>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3 p-2">
            <div class="box-white text-center p-5">
                <i class="fas fa-pencil-alt logo-lg font-color"></i>
                <p class="my-2 font-weight-bold font-color"><?php echo $this->lang->line('average_rating');?></p>
                <h4 class="text-paste"><?php ?></h4>
                <p class="my-2 font-weight-bold font-color"><?php echo $this->lang->line('out_of_5');?></p>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 py-2">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="<?php echo $this->lang->line('search');?>" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 py-2">
            <input type="text" class="date-time-picker form-control" placeholder="<?php echo $this->lang->line('select_date');?>">
        </div>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped text-center" id="product_table">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('name');?></th>
                    <th><?php echo $this->lang->line('time');?></th>
                    <th><?php echo $this->lang->line('message_details');?></th>
                    <th><?php echo $this->lang->line('rate');?></th>
                    <th><?php echo $this->lang->line('status');?></th>
                    <th><?php echo $this->lang->line('view');?></th>
                </tr>
                </thead>
                <tbody>
                     
                     <?php $temp = 0; ?>
                    <?php foreach ($feedbacks as $feedback) {
                       if($feedback['feedback_id'] > $temp){
                ?>
                                            
                <tr>
                    <td><?php echo $feedback['downloaded_user_first_name']." ".$feedback['downloaded_user_last_name'] ?></td>
                  <!--  <td><img class="img-product" src="<?php echo base_url('assets/images/product/product_view.png')?>" width="75px" height="75px"></td>-->
                    <td><?php echo $feedback['feedback_giving_date_time'] ?></td>
                    <td width="40%"><?php echo $feedback['feedback_message'] ?></td>
                    <td><?php echo $feedback['feedback_rating_score'] ?></td>
                    <td class="font-color">
                        <select content="<?php echo $feedback['feedback_id'] ?>" class="feedback-status" id="feedback-status">
                            <option value="1" <?php echo ($feedback['feedback_is_public']) == 1 ? "selected" : " " ;?>><?php echo $this->lang->line('public');?></option>
                            <option value="0" <?php echo ($feedback['feedback_is_public']) == 0 ? "selected" : " " ;?> ><?php echo $this->lang->line('private');?></option>
                        </select><i class="fas fa-cog"></i>
                    </td>
                    <td> 
                        <a href="<?php echo base_url('feedback_details/'.$feedback['feedback_id'])?>" class="action-view px-2" style="font-size: large"><i class="fas fa-eye "></i></a>
                    </td>
                </tr>
               
               <?php $temp = $feedback['feedback_id']; } } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js')?>"></script>
<script type="text/javascript" rel="script">
    $('.date-time-picker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });

    $(document).ready(function(){
           
           $('#feedback-status').change(function(){

               var feedback_status_id = $(this).val();
               var feedback = $(this).attr('content');


               $.ajax({

                    url: '<?php echo uri_string(); ?>',
                    type:'POST',
                    data:{feedback_status:feedback_status_id, feedback_id: feedback },
                    success:function(data){  

                    
                       
                },

                error:function (error) {
                    alert(error);
                }
       });     });
    
});


</script>