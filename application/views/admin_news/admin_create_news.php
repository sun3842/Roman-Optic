<style type="text/css" rel="stylesheet">

    .row>div{
        margin: 4px 0 12px 0;
    }




</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading "><?php echo $this->lang->line('news');?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i><?php echo $this->lang->line('choose_picture');?></a>
        </div>
    </div>

    <label class="page-heading"><?php echo $this->lang->line('create_news');?></label>

    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">
                <label class="text-small"><?php echo $this->lang->line('news_title');?><span class="text-red">*</span></label>
                <input type="text" name="news_title" id="news_title" class="form-control">
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <label class="font-color"><?php echo $this->lang->line('upload_picture');?></label>
                <div class="input-group mb-3">
                    <input type="text"  class="form-control " style="font-size: small;" placeholder="<?php echo $this->lang->line('choose_picture');?>" disabled="">
                    <div>
                        <label for="news_image"  class="btn-paste btn btn-block"><i class="fas fa-image "></i><?php echo $this->lang->line('upload');?></label>
                        <input type="file" class="collapse " id="news_image" name="news_image" onchange="openFile(event)">
                    </div>
                </div>
            </div>

            <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 box-off-white ml-3">
                <div class="row" id="upload_display_images" >

                    <div >

                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12" >
                <label class="font-color"><?php echo $this->lang->line('news_description');?><span class="text-red">*</span></label>
                <textarea name="news_description" class="form-control ckeditor" name="news_description" id="editor" ></textarea>

            </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <input type="submit" class=" btn-common " name="news_submit" id="news_submit" value="<?php echo $this->lang->line('confirm');?>">

        </div>

</div>
</form>

</div>

<script type="text/javascript" rel="script" src="<?php echo base_url("assets/app_assets/plugins/ckeditor/ckeditor.js")?>"></script>


<script>

    CKEDITOR.replace('editor');




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

        $('#news_image').val("");
        $('#output').attr("src"," ");
        output.style.display = "none";
        del.style.display = "none";
        //del.style.display = "none";

    }



</script>


