<style type="text/css" rel="stylesheet">

    table>thead>tr>td>select{
        background-color: transparent;
        border: 2px solid white;
        color: white;
    }
    input[type='time']{
        background-color: transparent;!important;
        border: 2px solid white;
        color: white;
        width: 100%;
        height: 40px;
    }

</style>
<div class="content">

    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <form id="add_optician" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 text-center my-5">
                <label class="page-heading font-color"><?php echo $this->lang->line('optician_consultant');?></label>
                <a href="<?php echo base_url('all_category')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i></a>
            </div>
        </div>
        <div class="row my-3">

            <div class="col-12">
                <label class="page-heading font-color"><?php echo $this->lang->line('create_opticians_consultant');?></label>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-2">
                <label class="font-color"><?php echo $this->lang->line('first_name');?><span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="first_name" id="first_name">
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-2">
                <label class="font-color"><?php echo $this->lang->line('last_name');?><span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="last_name" id="last_name">
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-2">
                <label class="font-color"><?php echo $this->lang->line('designation');?><span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="designation" id="designation">
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-2">
                <label class="font-color"><?php echo $this->lang->line('branch_name');?><span class="text-danger">*</span></label>
                <select name="branch_name" id="branch_name">


                    <?php foreach($branch_names as $branch_name) {

                        ?>

                        <option class="text-small" name="branch_name" id="branch_name" value="<?php echo $branch_name['branch_id'];?>"> <?php echo $branch_name['branch_title'];  ?> </option>

                    <?php } ?>

                </select>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-2">
                <label class="font-color"><?php echo $this->lang->line('phone_no');?></label>
                <input type="text" class="form-control" name="phone_no" id="phone_no">
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 my-2">
                <label class="font-color"><?php echo $this->lang->line('email');?></label>
                <input type="email" class="form-control" name="email" id="email">
            </div>

            <div class="col-12 my-2">
                <label class="font-color"><?php echo $this->lang->line('about_and_service_details');?></label>
                <textarea name="service_details" id="service_details"> </textarea>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <label class="font-color"><?php echo $this->lang->line('upload_picture');?></label>
                <div class="input-group mb-3">
                    <input type="text"  class="form-control " style="font-size: small;" placeholder="<?php echo $this->lang->line('choose_picture');?>" disabled="">
                    <div>
                        <label for="optician_image"  class="btn-paste btn btn-block"><i class="fas fa-image "></i><?php echo $this->lang->line('upload');?></label>
                        <input type="file" class="collapse " id="optician_image" name="optician_image" onchange="openFile(event)">
                    </div>
                </div>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 box-off-white ml-3">
                <div class="row" id="upload_display_images" >

                    <div >


                    </div>

                </div>
            </div>

            <div class="col-12 text-center">
                <input type="submit" class="btn-common text-center my-5" name="team_member_confirm" id="team_member_confirm" value="<?php echo $this->lang->line('confirm');?>">
            </div>


        </div>
    </form>
</div>


<script type="text/javascript" rel="script">


    $('#add_optician').validate({

        rules:{

            first_name:{

                required: true,
            },

            last_name:{

                required: true,
            },

            designation:{

                required: true,
            },
            branch_name: {
                required: true,
            },
            email: {
                email: true,
                required: false
            }


        }
    });


    var openFile = function(event) {
        var input = event.target;
        $('#upload_display_images').empty();
        var filesAmount = input.files.length;



        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();


            reader.onload = function(event) {

                $("<button type='button' onclick='remove_img(this)' class='btn btn-danger'><?php echo $this->lang->line('delete');?></button>");
                $('#upload_display_images').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4 photo-size'><img src='"+event.target.result+"' style='margin-top: 10px;' width='100%' id='output'><button style='margin-top: 10px;' type='button' id= del onclick='remove_img()' class='btn btn-danger'><?php echo $this->lang->line('delete');?></button></div>");

            }

            reader.readAsDataURL(input.files[i]);
        }


    };

    function remove_img(){

        var output = document.getElementById('output')
        var del = document.getElementById('del')

        $('#optician_image').val("");
        $('#output').attr("src"," ");
        output.style.display = "none";
        del.style.display = "none";
        //del.style.display = "none";

    }
</script>