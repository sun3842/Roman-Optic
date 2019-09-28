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
            <label class="page-heading font-color"><?php echo $this->lang->line('optician_consultant');?></label>
            <a href="<?php echo base_url('all_category')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i><?php echo $this->lang->line('back');?></a>
            <a href="<?php echo base_url('add_optician')?>" class="btn-common float-right"><?php echo $this->lang->line('add_optician');?></a>
        </div>
    </div>


    <div class="row">

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="<?php echo $this->lang->line('search');?>" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped text-center">
                <thead>


                <tr>
                    <th><?php echo $this->lang->line('name');?></th>
                    <th><?php echo $this->lang->line('designation');?></th>
                    <th><?php echo $this->lang->line('branch_name');?></th>
                    <th><?php echo $this->lang->line('action');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($team_members as $team_member)
                {

                    ?>
                    <tr>
                        <td><?php echo $team_member['team_member_first_name']." ". $team_member['team_member_last_name']  ?></td>
                        <td><?php echo $team_member['team_member_designation']?></td>
                        <td><?php echo $team_member['branch_title']?></td>
                        <td>
                            <a href="#" class="action action-view" onclick='view_details(<?php echo json_encode($team_member,JSON_HEX_APOS)?>,event)'><i class="fas fa-eye"></i></a>
                            <a href="<?php echo site_url('edit_optician/'.$team_member["team_member_id"]) ?>" class="action action-edit" ><i class="far fa-edit"></i></a>
                            <a href="#" onclick='delete_optician(<?php echo $team_member["team_member_id"]?>,event)' class="action action-delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>



<!--Modal Notification-->
<!--
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
</div>-->

<!--Modal View-->

<div class="modal bd-example-modal-lg fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="modal_view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle"><?php echo $this->lang->line('optician_details');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-lg">


                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 ml-3" id="optician_img"></div>
                </div>

                <div class="col-12 ">
                    <h5 class="label-block"><span id="optician_first_name"></span><span> </span> <span id="optician_last_name"></span></h5>
                </div>
                <div class="col-12">
                    <label class="label-block font-color" id="designation"></label>
                </div>


                <div class="col-12 font-color text-justify">
                    <p id="services_details"></p>
                </div>

            </div>
        </div>

    </div>
</div>
</div>

<!--Delete optician model-->

<div class="modal fade" id="delete_optician_modal" tabindex="-1" role="dialog" aria-labelledby="delete_optician_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('delete_optician');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo site_url('d')?>">

                <div class="modal-body">
                    <?php echo $this->lang->line('Are_You_sure_to_delete_this_optician');?>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger" id="btn_delete_optician"><?php echo $this->lang->line('delete');?></a>

                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript" rel="script">
    function notification(message,event) {
        event.preventDefault();
        $('#modal_notification').modal('show');
    }
    function view_details(doctor,event) {
        event.preventDefault();

        var img = doctor['team_member_image_location'];
        if(img != null)

        {   $('#optician_first_name').html("");
            $('#optician_last_name').html("");
            $('#designation').html("");
            $('#optician_img').html("");
            $('#services_details').html("");

            $('#optician_img').html('<img width = "50%" class="img-product" src="<?php echo base_url();?>'+img+'">');
            $('#optician_first_name').html(doctor['team_member_first_name']);
            $('#optician_last_name').html(doctor['team_member_last_name']);
            $('#designation').html(doctor['team_member_designation']);
            $('#services_details').html(doctor['team_member_about_and_services']);


        }

        else
        {
            $('#optician_first_name').html("");
            $('#optician_last_name').html("");
            $('#designation').html("");
            $('#optician_img').html("");
            $('#services_details').html("");

            $('#optician_first_name').html(doctor['team_member_first_name']);
            $('#optician_last_name').html(doctor['team_member_last_name']);
            $('#designation').html(doctor['team_member_designation']);
            $('#services_details').html(doctor['team_member_about_and_services']);

        }


        $('#modal_view').modal('show');
    }

    function delete_optician(team_member_id,event) {
        event.preventDefault();

        $('#btn_delete_optician').attr('href','<?php  echo site_url('delete_optician/')?>'+team_member_id);
        $('#delete_optician_modal').modal("show");
    }


</script>