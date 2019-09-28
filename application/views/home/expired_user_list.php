<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>
    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('expired_user_list_within_7_days')?></label>
            <a href="<?php echo site_url('home')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>


    <?php
            $current_date=date('Y-m-d');
            $week = new DateTime($current_date.' + 7 day');
            $week=$week->format('Y-m-d');
    ?>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped text-center" id="product_table">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('user_name')?></th>
                    <th><?php echo $this->lang->line('expired_eye_lens')?></th>
                    <th><?php echo $this->lang->line('lens_type')?></th>
                    <th><?php echo $this->lang->line('lens_brand')?></th>
                    <th><?php echo $this->lang->line('lens_sphere')?></th>
                    <th><?php echo $this->lang->line('lens_cylinder')?></th>

<!--                    <th>Lens Axis</th>-->

                </tr>
                </thead>
                <tbody>
                <?php foreach ($last_week_expired_lenses AS $lens) { ?>
                    <tr>
                        <th><?php echo $lens['lens_user_first_name'].' '.$lens['lens_user_last_name']?></br><hr><button class="btn btn-paste btn-small" onclick='user_details(<?php echo json_encode($lens,JSON_HEX_APOS)?>)'><?php echo $this->lang->line('user_details')?></button></th>
                        <th><span class="<?php echo ($lens['left_EXPIRED_DATE']<=$week)?'text-danger':''?>"><?php echo $this->lang->line('left_eye')?></span></br><hr><span class="<?php echo ($lens['right_EXPIRED_DATE']<=$week)?'text-danger':''?>"><?php echo $this->lang->line('right_eye')?></span></th>
                        <th><?php echo $lens['left_eye_lens_name']?></br><hr><?php echo $lens['right_eye_lens_name']?></th>
                        <th><?php echo $lens['lens_user_left_company']?></br><hr><?php echo $lens['lens_user_right_company']?></th>
                        <th><?php echo $lens['lens_user_left_sphere']?></br><hr><?php echo $lens['lens_user_right_sphere']?></th>
                        <th><?php echo $lens['lens_user_left_cylinder']?></br><hr><?php echo $lens['lens_user_left_cylinder']?></th>
<!--                        <th>--><?php //echo $lens['left_eye_lens_name']?><!--</br><hr>--><?php //echo $lens['right_eye_lens_name']?><!--</th>-->
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- User Details Modal -->
<div class="modal fade" id="user_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('user_details')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="div_user_details">

                </div>
            </div>
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                <button type="button" class="btn btn-primary">Save changes</button>-->
<!--            </div>-->
        </div>
    </div>
</div>

<script type="text/javascript" rel="script">
    function user_details(user_info) {
        $('#div_user_details').empty();
        var user_details='';
        user_details=user_details+'<div class="col-12"><label class="font-weight-bold"><?php echo $this->lang->line('user_name')?>: </label> '+user_info["lens_user_first_name"]+' '+user_info["lens_user_last_name"]+'</div>';
        user_details=user_details+'<div class="col-12"><label class="font-weight-bold"><?php echo $this->lang->line('user_phone')?>: </label> '+user_info["lens_user_phone"]+'</div>';
        user_details=user_details+'<div class="col-12"><label class="font-weight-bold"><?php echo $this->lang->line('user_email')?>: </label> '+user_info["lens_user_email"]+'</div>';
        user_details=user_details+'<div class="col-12"><label class="font-weight-bold"><?php echo $this->lang->line('user_postcode')?>: </label> '+user_info["lens_user_post_code"]+'</div>';
        user_details=user_details+'<div class="col-12"><label class="font-weight-bold"><?php echo $this->lang->line("user_address")?>: </label> '+user_info["lens_user_address"]+'</div>';
        $('#div_user_details').append(user_details);
        $('#user_details').modal('show');
    }
</script>