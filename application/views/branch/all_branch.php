<style type="text/css" rel="stylesheet">
    table>tbody>tr>td:nth-child(5){
        max-width: 20ch;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>
<div class="content">

    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading font-color">ALL BRANCHES</label>
            <a href="<?php echo base_url('add_branch')?>" class="btn-common float-right">ADD BRANCH</a>
        </div>
    </div>





    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>BRANCH NAME</th>
                    <th>FULL ADDRESS</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach($all_branches as $branch)
                {
                   ?>
                    <tr>
                        <td><?php echo $branch['branch_title'];?></td>
                        <td><?php echo $branch['branch_full_address'];?></td>
                        <td>
                            <a href="#" class="action action-view" onclick='view_details(<?php echo json_encode( $branch,JSON_HEX_APOS);?>,event);'><i class="fas fa-eye"></i></a>
                            <a href="<?php echo site_url('edit_branch/'.$branch["branch_id"]);?>" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" onclick='delete_category("optician",event)' class="action action-delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>


                </tbody>
            </table>
        </div>
        <div class="col-12 text-center">
            <button class="text-paste btn-load-more"><i class="fas fa-angle-down"></i></button>
        </div>
    </div>
</div>


<!-- Modal Notification-->
<div class="modal fade" id="modal_notification" tabindex="-1" role="dialog" aria-labelledby="modal_notification" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">NOTIFICATION<br/><small>(12 MAY 2018)</small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label>TITLE</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-12 my-3">
                        <label>DESCRIPTION</label>
                        <textarea></textarea>
                    </div>
                    <div class="col-12 my-3 text-center">
                        <button type="submit" class="btn-common">CONFIRM</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--Modal View-->

<div class="modal bd-example-modal-lg fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="modal_view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">BRANCH DETAILS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5 modal-lg">
                <div class="row">

                    <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4" >
                    </div>
                    <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8" >
                        <h5 class="label-block " id="branch_title"></h5>
                        <label class="label-block font-color" id="branch_reg_no"></label>
                        <label class="label-block font-weight-bold" id="branch_full_address"></label>
                    </div>
                    <div class="col-12">
                    <p class="font-color text-justify" id="branch_about_us">

                    </p>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <label>Phone:<span class="font-color" id="branch_contact_number"></span></label>

                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <label>Email:<span class="font-color" id="branch_email_address"></span></label>
                    </div>

                    <div class="col-12">
                        <label>WEBSITE:<span class="font-color" id="branch_web_site_link"></span></label>
                    </div>

                    <div class="col-12">
                        <label>FACEBOOK:<span class="font-color" id="branch_facebook"></span></label>
                    </div>

                    <div class="col-12">
                        <label>LINKEDIN:<span class="font-color" id="branch_linkedin"></span></label>
                    </div>

                    <div class="col-12">
                        <label>GOGGLE PLUS:<span class="font-color" id="branch_google_plus"></span></label>
                    </div>

                    <div class="col-12">
                        <label>TWITTER:<span class="font-color" id="branch_twitter"></span></label>
                    </div>
                    <div class="col-12">
                        <label>INSTAGRAM:<span class="font-color" id="branch_instagram"></span></label>
                    </div>


                    <div class="col-12 my-2" >
                        <div class="row">
                            <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-2">
                                <label class="font-weight-bold">SCHEDULE :</label>
                            </div>
                            <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5" id="timetable_div">

                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>




<script type="text/javascript" rel="script">
    function notification(message,event) {
        event.preventDefault();
        $('#modal_notification').modal('show');
    }
    function view_details(branch,event) {
        event.preventDefault();
        $('#branch_title').html("");
        $('#branch_reg_no').html("");
        $('#branch_full_address').html("");
        $('#branch_about_us').html("");
        $('#branch_contact_number').html("");
        $('#branch_email_address').html("");
        $('#branch_web_site_link').html("");
        $('#branch_facebook').html("");
        $('#branch_linkedin').html("");
        $('#branch_google_plus').html("");
        $('#branch_twitter').html("");
        $('#timetable_div').html("");
        $('#branch_instagram').html("");


        $('#branch_title').html(branch['branch_title']+"<small class=\"font-color\">("+branch['branch_reg_no']+")</small>");
        $('#branch_reg_no').html("REG. NO:"+branch['branch_reg_no']);
        $('#branch_full_address').html(branch['branch_full_address']);
        $('#branch_about_us').html(branch['branch_about_us']);
        $('#branch_contact_number').html(branch['branch_contact_number']);
        $('#branch_email_address').html(branch['branch_email_address']);
        $('#branch_web_site_link').html(branch['branch_web_site_link']);
        $('#branch_facebook').html(branch['branch_facebook']);
        $('#branch_linkedin').html(branch['branch_linkedin']);
        $('#branch_google_plus').html(branch['branch_google_plus']);
        $('#branch_twitter').html(branch['branch_twitter']);
        $('#branch_instagram').html(branch['branch_instagram']);


        if(branch['timetable_type']==0)
        {
            //NOT AVAILABLE
            $('#timetable_div').html("NOT AVAILABLE");
        }
        else if(branch['timetable_type']==1)
        {
            //Always OPEn
            $('#timetable_div').html("ALWAYS OPEN");
        }
        else if(branch['timetable_type']==2)
        {
            //SELECTED TIME TABLE
            var closed="<spam class=\"text-danger font-weight-bold pt-5\">CLOSED</spam>";
            var sat_open=branch['is_sat_open']==0?closed:branch['sat_time'];
            var sun_open=branch['is_sun_open']==0?closed:branch['sun_time'];
            var mon_open=branch['is_mon_open']==0?closed:branch['mon_time'];
            var tues_open=branch['is_tues_open']==0?closed:branch['tues_time'];
            var wed_open=branch['is_wed_open']==0?closed:branch['wed_time'];
            var thurs_open=branch['is_thurs_open']==0?closed:branch['thurs_time'];
            var fri_open=branch['is_fri_open']==0?closed:branch['fri_time'];

        var all_time_table='<label class="label-block">SAT : '+sat_open+'</label>'+
            '<label class="label-block">SUN : '+sun_open+'</label>'+
        '<label class="label-block">MON : '+mon_open+'</label>'+
        '<label class="label-block">TUES : '+tues_open+'</label>'+
       ' <label class="label-block">WED : '+wed_open+'</label>'+
        '<label class="label-block">THURS : '+thurs_open+'</label>'+
        '<label class="label-block">FRI : '+fri_open+'</label>';

            $('#timetable_div').html(all_time_table);
        }
        else
        {
            $('#timetable_div').html("");
        }
        $('#modal_view').modal('show');
    }
</script>