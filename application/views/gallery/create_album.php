<style type="text/css" rel="stylesheet">

    .upload {
        width: 100%;
        height: 200px;
        position: relative;
        background-color: #CCCCCC;
    }

    .plus {
        height: inherit;
        width: inherit;
        /*font-size: xx-large;*/
        position: absolute;
        z-index: 1;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .browse {
        width: inherit;
        height: inherit;
        opacity: 0;
        z-index: 1000;
        position: absolute;
    }
</style>
<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row mb-4">
        <div class="col-12 text-center my-5">
            <label class="page-heading font-color"><?php echo $this->lang->line('gallery_album')?></label>
            <a href="<?php echo base_url('home') ?>" class="btn-back" style="color: #35C9A7"><i
                        class="fas fa-chevron-left"></i> <?php  echo $this->lang->line('back')?></a>
            <a href="<?php echo site_url('create_album') ?>" class="btn-paste px-4 py-2 m-1 text-white float-right"
               id="btn_crate_album"><?php echo $this->lang->line('create_album')?></a>
            <a href="<?php echo site_url('add_photo')?>" class="btn-paste px-4 py-2 m-1 text-white float-right" id="btn_upload_photo"><?php echo $this->lang->line('upload_photo')?></a>
        </div>
    </div>

    <h5 class="font-color font-weight-bold"><?php echo $this->lang->line('create_album')?></h5>
    <form id="form_album" method="post" enctype="multipart/form-data">
    <div class="row my-5">
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
            <label class="font-weight-bold font-color"><?php echo $this->lang->line('album_name')?><span class="text-red">*</span></label>
            <input type="text" class="form-control" placeholder="ALBUM NAME" name="album_title" id="album_title">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">
            <label class="font-weight-bold font-color"><?php echo $this->lang->line('album_details')?></label>
            <textarea id="album_details" name="album_details"></textarea>
        </div>
        <div class="col-12 p-2">
            <label class="font-weight-bold font-color label-block"><?php echo $this->lang->line('uploaded_photos_videos')?><span class="text-red">*</span></label>
            <div class="row" id="div_images">
                <div class="col-12 col-xs-12 col-sm-6 col-md-3 col-lg-2 p-2" id="div_upload">
                    <div class="upload">
                        <input type="file" name="videos_photos[]" class="browse" accept='image/*,video/*' onchange='openFile(event)' multiple required>
                        <div class="plus p-5">
                            <i class="fas fa-plus my-3"></i>
                            <label class="label-block"><?php echo $this->lang->line('add_photo')?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-12">
            <button type="submit" class="btn-common" id="btn_add_album"><?php echo $this->lang->line('create_album')?></button>
        </div>

    </div>
    </form>
</div>
<script type="text/javascript" rel="script">
    var openFile = function (event) {
        $('#btn_upload').removeClass('collapse');

        // var input = event.target;
        // $('#div_images').contents(':not("#div_upload")').remove();
        // var filesAmount = input.files.length;
        //
        // for (i = 0; i < filesAmount; i++) {
        //     var reader = new FileReader();
        //
        //
        //
        //     reader.onload = function (event) {
        //         var type=event.target.result.split('/');
        //         if(type[0]=='data:image')
        //         {
        //             $("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2'><img src='" + event.target.result + "' width='100%'><textarea name='image_description[]'></textarea></div>").insertBefore('#div_upload');
        //
        //         }
        //         else if(type[0]=='data:video')
        //         {
        //             $("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2'><video controls src='" + event.target.result + "' width='100%'></video><textarea name='image_description[]'></textarea></div>").insertBefore('#div_upload');
        //
        //         }
        //     }
        //
        //
        //     reader.readAsDataURL(input.files[i]);
        // }


        var input = event.target;


        var filesAmount = input.files.length;





        var reader = new FileReader();

        function readFiles(fileIndex)
        {
            if(fileIndex>=filesAmount)
            {
                return;
            }
            reader.onload = function(event) {
                event.preventDefault();

                //$("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4 pip'><img src='"+event.target.result+"' width='100%'><span  class='btn btn-danger single_remove_"+fileIndex+"' style='width: 100%;display: block;' ><?php echo $this->lang->line('delete') ?></span></div>");
                var type=event.target.result.split('/');
                if(type[0]=='data:image')
                {
                    $("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2 pip'><img src='" + event.target.result + "' width='100%'><textarea name='image_description[]'></textarea><span  class='btn btn-danger single_remove_"+fileIndex+"' style='width: 100%;display: block;' ><?php echo $this->lang->line('delete') ?></span></div>").insertBefore('#div_upload');

                }
                else if(type[0]=='data:video')
                {
                    $("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2 pip'><video controls src='" + event.target.result + "' width='100%'></video><textarea name='image_description[]'></textarea><span  class='btn btn-danger single_remove_"+fileIndex+"' style='width: 100%;display: block;' ><?php echo $this->lang->line('delete') ?></span></div>").insertBefore('#div_upload');

                }
                $('#div_images').append("<input type='hidden' id='single_image_deleted_"+fileIndex+"' name='single_image_deleted_"+fileIndex+"' value='0'>");
                $(".single_remove_"+fileIndex).click(function(){
                    $(this).parent(".pip").remove();

                    $('#single_image_deleted_'+fileIndex).val('1');
                });

                readFiles(fileIndex+1)
            }
            reader.readAsDataURL(input.files[fileIndex]);





        }

        readFiles(0);



    };




    $('#form_album').validate({
        rules: {
            album_title: {
                required: true,
            },
            videos_photos: {
                required: true,
            }

        },
        messages: {
            album_title: 'Album Name Is Required',
        },

    });
</script>