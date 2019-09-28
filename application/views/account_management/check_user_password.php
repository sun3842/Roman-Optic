<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('account_management');?></label>
            <a href="<?php echo site_url(); ?>" class="btn-back" style="color: #35C9A7"><i
                        class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back');?></a>
        </div>
    </div>
    <div class="row my-5 px-5">
        <div class="col-12 box-off-white my-5 px-4 py-2">
            <form method="post" id="form_check_pass">
                <label class="label-block text-center my-2"><?php echo $this->lang->line('enter_your_password');?></label>
                <input type="password" class="form-control px-4 my-4 text-center" name="user_password" id="user_password">
                <label class="text-danger" id="label_wrong_pass" style="display: none"><?php echo $this->lang->line('password_not_valid');?></label>
                <button type="button" class="btn-paste btn-block px-4 my-4 py-3" name="btn_check_pass" id="btn_check_pass"><?php echo $this->lang->line('next');?> >></button>
            </form>
        </div>

    </div>
</div>

<script type="text/javascript" rel="script">


    $('#btn_check_pass').click(function () {
        var pass=$('#user_password').val();
        if(pass!='')
        {
            var form=$('#form_check_pass')[0];
            var form_data=new FormData(form);
            $.ajax({
                url: '<?php echo uri_string()?>',
                data:form_data,
                type: 'POST',
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (result) {

                    if(result==0)
                    {
                       $('#label_wrong_pass').css('display','block');
                    }
                    else
                    {
                        var user_info=$.parseJSON(result);
                        $('.content').load('<?php echo site_url("user_info")?>',function () {

                            if(user_info!=null)
                            {
                                $('#label_user_first_name').html(user_info['representative_first_name']);
                                $('#label_user_last_name').html(user_info['representative_last_name']);
                                $('#label_user_phone').html(user_info['representative_contact_number']);
                                $('#label_user_email').html(user_info['representative_email_address']);

                                //**************modal values
                                $('#update_user_first_name').val(user_info['representative_first_name']);
                                $('#update_user_last_name').val(user_info['representative_last_name']);
                                $('#update_user_phone').val(user_info['representative_contact_number']);
                                $('#update_user_email').val(user_info['representative_email_address']);
                            }

                            //***************where from will be submit****************************
                            $('#form_update_user_info').attr('action','<?php echo base_url('update_app_user_info')?>');
                            $('#form_update_user_password').attr('action','<?php echo base_url('update_app_user_pass')?>');

                            //*******************modal call*******************************
                            $('#btn_update_info').attr('onclick','update_info()');
                        });



                    }
                },
                error: function (error) {
                    alert(error);
                }
            });
        }
    });

</script>