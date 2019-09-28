<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css')?>">
<style type="text/css" rel="stylesheet">

.row>div{
        margin: 4px 0 12px 0;
    }

.btn-load-more{
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }

.lens-details>div>label:nth-child(2){

    color: #7B7B7B;

}



</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('lens_user')?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a><button class="btn-common" style="float: right;">ADD LENS USER</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="SEARCH" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="col-12 table-responsive">
            <table class="table table-striped text-center" id="table_user">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('user_name')?></th>
                    <th><?php echo $this->lang->line('user_id')?></th>
                    <th><?php echo $this->lang->line('user_type')?></th>
                    <th><?php echo $this->lang->line('right_lens')?></th>
                    <th><?php echo $this->lang->line('left_lens')?></th>
                    <th><?php echo $this->lang->line('duration')?></th>
                    <th><?php echo $this->lang->line('action')?></th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($lens_users AS $lens_user) { ?>
               <tr class="text-small">
                    <td><?php echo $lens_user['lens_user_first_name'].' '.$lens_user['lens_user_last_name']?></td>
                    <td><?php echo $lens_user['lens_user_id']?></td>
                    <td><?php echo($lens_user['ref_lens_user_downloaded_user_id']=='')?'General User':'App user' ?></td>
                    <td><button type="button" onclick='EyeDetails(<?php echo json_encode($lens_user,JSON_HEX_APOS)?>,1)' class="btn-common"><?php echo $this->lang->line('details')?></button></td>
                    <td><button type="button" onclick='EyeDetails(<?php echo json_encode($lens_user,JSON_HEX_APOS)?>,2)' class="btn-common"><?php echo $this->lang->line('details')?></button></td>
                    <td><label><?php echo $this->lang->line('right_lens')?></label><label><span class="p-2">:</span><?php echo $lens_user['lens_user_left_duration_day']?> <?php echo $this->lang->line('days')?></label><br><label> <?php echo $this->lang->line('left_lens')?></label> <label><span class="p-2">:</span><?php echo $lens_user['lens_user_right_duration_day']?> <?php echo $this->lang->line('days')?></label></td>
                    <td>
                        <a href="<?php echo site_url('edit_lens_user/'.$lens_user['lens_user_id'])?>" class="action action-edit"><i class="far fa-edit"></i></a>
                    </td>
               </tr>
                   <?php } ?>


            </tbody>
        </table>
    </div> 

          <div class="col-12 text-center mt-1">
            <button class="text-paste btn-load-more"><i class="fas fa-angle-down"></i></button>
            <label class="text-center more-style"><?php echo $this->lang->line('more')?></label>
        </div>  

    </div>

   <div class="modal fade bd-example-modal-lg" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="dialog_header text-center label-block" id="lens_modal_title"><?php echo $this->lang->line('right_lens')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff">&times;</span>
                </button>
            </div>

            <div>

                <div class="row light-white p-0 m-0">
                   
                   <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
                       <svg>
                           <circle r="28" cx="30" cy="30" fill="none" stroke="green" stroke-width="4"  stroke-dashoffset="0" stroke-dasharray="10" style="stroke-linecap: round"></circle>


                       </svg>
                       <label class="lens-duration" style="position: absolute;top:15px;left:35px;">30 <?php echo $this->lang->line('days')?></label>
                   </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-9 col-lg-9">
                        <div class="row text-weight-bold ml-5">
                            <div class="col-12 "><label><?php echo $this->lang->line('lens_duration')?> : </label><label class="lens-duration mx-2">200 Days</label></div>
                            <div class="col-12"><label><?php echo $this->lang->line('starting_date')?>  : </label><label class="mx-2" id="lens_start_date">12-1-2018</label></div>
                        </div>
                   </div>
                </div>
        
                            <div class="row news_details_text deep-white p-5 m-0 lens-details"> 
                                <div class="col-12"><label><?php echo $this->lang->line('lens_name')?></label> <label><span class="p-2">:</span>Acuvue Oasys</label></div>
                                <div class="col-12"><label><?php echo $this->lang->line('company_name')?></label> <label><span class="p-2">:</span>Oases</label></div>
                                <div class="col-12"><label><?php echo $this->lang->line('lens_kind')?></label> <label><span class="p-2">:</span>Multi focal</label></div>
                                <div class="col-12"><label><?php echo $this->lang->line('sphere')?></label> <label><span class="p-2">:</span>-1.5</label></div>
                                <div class="col-12"><label><?php echo $this->lang->line('cyl')?></label><label><span class="p-2">:</span>-1.0</label></div>
                                <div class="col-12"><label><?php echo $this->lang->line('ax')?><sup>o</sup></label><label><span class="p-2">:</span>120</label></div>
                                <div class="col-12"><label><?php echo $this->lang->line('bc')?></label><label><span class="p-2">:</span>8.1</label></div>
                                <div class="col-12"><label><?php echo $this->lang->line('diameter')?></label><label><span class="p-2">:</span>14</label></div>
                            </div>
            </div>

        </div>

    </div>

</div>


<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js')?>"></script>


<script type="text/javascript" rel="script">
   
    function EyeDetails(lens,title) {
        $('.lens-details').empty();
        var modal_title=(title==1)?'Right Eye Lens':'Left Eye Lens';
        $('#lens_modal_title').html(modal_title);
        if(title==1){
            $('.lens-duration').html(lens['lens_user_right_duration_day']);
            $('#lens_start_date').html(lens['lens_user_right_starting_date']);

           $('.lens-details').append(' <div class="col-12"><label><?php echo $this->lang->line('lens_name')?></label> <label><span class="p-2">:</span>'+lens["lens_user_right_name"]+'</label></div>\n' +
               '                                <div class="col-12"><label><?php echo $this->lang->line('company_name')?></label> <label><span class="p-2">:</span>'+lens["lens_user_right_company"]+'</label></div>\n' +
               '                                <div class="col-12"><label><?php echo $this->lang->line('lens_kind')?></label> <label><span class="p-2">:</span>'+lens['right_lens_name']+'</label></div>\n' +
               '                                <div class="col-12"><label><?php echo $this->lang->line('sphere')?></label> <label><span class="p-2">:</span>'+lens["lens_user_right_sphere"]+'</label></div>\n' +
               '                                <div class="col-12"><label><?php echo $this->lang->line('cyl')?></label><label><span class="p-2">:</span>'+lens["lens_user_right_cylinder"]+'</label></div>\n' +
               '                                <div class="col-12"><label><?php echo $this->lang->line('ax')?><sup>o</sup></label><label><span class="p-2">:</span>'+lens['lens_user_right_axis']+'</label></div>\n' +
               '                                <div class="col-12"><label><?php echo $this->lang->line('bc')?></label><label><span class="p-2">:</span>'+lens["lens_user_right_addiction"]+'</label></div>\n' +
               '                                <div class="col-12"><label><?php echo $this->lang->line('diameter')?></label><label><span class="p-2">:</span>'+lens["lens_user_right_diameter"]+'</label></div>');
        }
        else
        {
            $('.lens-duration').html(lens['lens_user_left_duration_day']);
            $('#lens_start_date').html(lens['lens_user_left_starting_date']);

            $('.lens-details').append(' <div class="col-12"><label><?php echo $this->lang->line('lens_name')?></label> <label><span class="p-2">:</span>'+lens["lens_user_left_name"]+'</label></div>\n' +
                '                                <div class="col-12"><label><?php echo $this->lang->line('company_name')?></label> <label><span class="p-2">:</span>'+lens["lens_user_left_company"]+'</label></div>\n' +
                '                                <div class="col-12"><label><?php echo $this->lang->line('lens_kind')?></label> <label><span class="p-2">:</span>'+lens['left_lens_name']+'</label></div>\n' +
                '                                <div class="col-12"><label><?php echo $this->lang->line('sphere')?></label> <label><span class="p-2">:</span>'+lens["lens_user_left_sphere"]+'</label></div>\n' +
                '                                <div class="col-12"><label><?php echo $this->lang->line('cyl')?></label><label><span class="p-2">:</span>'+lens["lens_user_left_cylinder"]+'</label></div>\n' +
                '                                <div class="col-12"><label><?php echo $this->lang->line('ax')?><sup>o</sup></label><label><span class="p-2">:</span>'+lens['lens_user_left_axis']+'</label></div>\n' +
                '                                <div class="col-12"><label><?php echo $this->lang->line('bc')?></label><label><span class="p-2">:</span>'+lens["lens_user_left_addiction"]+'</label></div>\n' +
                '                                <div class="col-12"><label><?php echo $this->lang->line('diameter')?></label><label><span class="p-2">:</span>'+lens["lens_user_left_diameter"]+'</label></div>');
        }

        $('#product_modal').modal('show');
    }


    var stating_user_list= '<?php echo DEFAULT_DATA_LIMIT ?>';


    $('.btn-load-more').click(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo uri_string()?>',
            data: {user_start_limit : stating_user_list},
            success: function (result) {
                users=$.parseJSON(result);
                total_user=users.length;
                var right='Right';
                for(var i=0;i<total_user;i++)
                {

                    var user_type='';
                    if(users[i]['ref_lens_user_downloaded_user_id']=='')
                    {
                        user_type='General User';
                    }
                    else
                    {
                        user_type='App User';
                    }

                    $('#table_user').find('tbody').append("<tr class='text-small'>\n" +
                        "                    <td>"+users[i]['lens_user_first_name']+" "+users[i]['lens_user_last_name']+"</td>\n" +
                        "                    <td>"+users[i]['lens_user_id']+"</td>\n" +
                        "                    <td>"+user_type+"</td>\n" +
                        "                    <td><button onclick='EyeDetails("+JSON.stringify(users[i])+","+ 1+")' class='btn-common'>Details</button></td> \n" +
                        "                    <td><button onclick='EyeDetails("+JSON.stringify(users[i])+","+2+")' class='btn-common'>Details</button></td>      \n" +
                        "                    <td><label>Right Lens</label><label><span class='p-2'>:</span>"+users[i]['lens_user_left_duration_day']+" Days</label><br><label>Left Lens</label> <label><span class='p-2'>:</span>"+users[i]['lens_user_right_duration_day']+" Days</label></td>\n" +
                        "                    <td>\n" +
                        "                        <a href='<?php echo site_url('edit_lens_user/')?>"+users[i]['lens_user_id']+"' class='action action-edit'><i class='far fa-edit'></i></a>\n" +
                        "                    </td> </tr>");

                }
                stating_user_list=parseInt(stating_user_list,10)+<?php echo DEFAULT_DATA_LIMIT?>;
            },
            error:function (error) {
                alert(error);
            }
        });
    });
     
</script>



