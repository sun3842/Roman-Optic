
<style type="text/css" rel="stylesheet">

    .row>div{
        margin: 4px 0 12px 0;
    }


    .attribute-variable > span {
        margin: 5px 10px 0 0;
    }


    input[type='radio']{
        width: 25px;
        border: 4px solid #35C9A7;
        color: white;
    }





    @media screen and (max-width: 720px) {
        .attribute-details {
            margin-left: 0;
        }
    }

    .btn-common-post-event{
    color: white;
    border: none;
    background-color: #35C9A7;
    padding: 5px 5em 5px 5em;
    -webkit-box-shadow: -1px 5px 15px -5px rgba(0,0,0,0.75);
    -moz-box-shadow: -1px 5px 15px -5px rgba(0,0,0,0.75);
    box-shadow: -1px 5px 15px -5px rgba(0,0,0,0.75);
    cursor: pointer;
    font-weight: bold;
}



</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading "><?php echo $this->lang->line('user_info');?></label>
        </div>
    </div>


    <div class="row ">

            <div class="col-12">
                <label class="text-large"><?php echo $this->lang->line('first_name');?>:<span id="label_user_first_name" class="ml-2 font-weight-bold"></span></label>
            </div>

            <div class="col-12 ">
                <label class="text-large"><?php echo $this->lang->line('last_name');?>:<span id="label_user_last_name" class="ml-2 font-weight-bold"></span></label>
            </div>

            <div class="col-12">
                <label class="text-large"><?php echo $this->lang->line('phone_no');?>.:<span id="label_user_phone" class="ml-2 font-weight-bold"></span></label>
            </div>

            <div class="col-12 ">
                <label class="text-large"><?php echo $this->lang->line('email');?>:<span id="label_user_email" class="ml-2 font-weight-bold"></span></label>
            </div>





        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-5">
            <button class="btn-common-post-event" id="btn_update_info"><?php echo $this->lang->line('update_info');?></button>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-5">
            <button onclick="change_password()" class="btn-common-post-event"><?php echo $this->lang->line('change_password');?></button>
        </div>



    </div>

</div>



<div class="modal fade bd-example-modal-lg" id="change_password" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="dialog_header text-align-center" id="change_password_title"><center><?php echo $this->lang->line('change_password');?>!!!</center></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff">&times;</span>
                </button>
            </div>

            <div class="dialog_margin">

                <form method="post" id="form_update_user_password">
                <div class="row p-5">
                    <div class="col-12">
                        <label class="text-small"><?php echo $this->lang->line('password');?><span class="text-red">*</span></label>
                        <input type="password" class="form-control" id="user_new_password" name="user_new_password">
                    </div>

                    <div class="col-12">
                        <label class="text-small"><?php echo $this->lang->line('re_type_password');?><span class="text-red">*</span></label>
                        <input type="password" class="form-control" id="user_re_new_pass" name="user_re_new_pass">
                    </div>
                    <div class="col-12">
                        <input type="submit" class="btn btn-paste btn-block my-3 py-2" name="update_pass" value="<?php echo $this->lang->line('update');?>">
                    </div>
                </div>
                </form>

                </div>
        </div>
    </div>

</div>

<div class="modal fade bd-example-modal-lg" id="update_info" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="dialog_header text-align-center" id="update_info_title"><center><?php echo $this->lang->line('update_info');?> !!!</center></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff">&times;</span>
                </button>
            </div>

            <div class="dialog_margin">

                <form method="post" id="form_update_user_info">
                <div class="row p-5">
                    <!--<div class="col-12">-->
                        <!--<label class="text-small">USER NAME <span class="text-red">*</span></label>-->
                        <!--<input type="text" class="form-control" >-->
                    <!--</div>-->

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="text-small"><?php echo $this->lang->line('first_name');?></label>
                        <input type="text" class="form-control" id="update_user_first_name" name="update_user_first_name">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="text-small"><?php echo $this->lang->line('last_name');?></label>
                        <input type="text" class="form-control" name="update_user_last_name" id="update_user_last_name">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="text-small"><?php echo $this->lang->line('phone_no');?>.</label>
                        <input type="text" class="form-control" name="update_user_phone" id="update_user_phone">
                    </div>

                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="text-small"><?php echo $this->lang->line('email');?><span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="update_user_email" id="update_user_email">
                    </div>

                    <div class="col-12">
                        <input type="submit" class="btn btn-paste btn-block my-3 py-2" name="update_info" value="<?php echo $this->lang->line('update');?>">
                    </div>
                    <!--<div class="col-12">-->
                        <!--<label class="text-small">ADDRESS<span class="text-red">*</span></label>-->
                        <!--<textarea></textarea>-->
                    <!--</div>-->
                </div>
                </form>


            </div>
        </div>
    </div>

</div>



<script type="text/javascript" rel="script">



    function update_info() {

        $('#update_info').modal('show');
    }

    function change_password() {
        $('#change_password').modal('show');
    }
    

    $('#form_update_user_info').validate({
        rules: {
            update_user_email:{
                required: true,
            }
        }
    });

    $('#form_update_user_password').validate({
        rules: {
            user_new_password: {
                required: true,
                minlength: 6
            },
            user_re_new_pass: {
                equalTo: "#user_new_password"
            }
        }
    });
     
</script>



