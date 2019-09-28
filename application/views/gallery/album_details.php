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
    .div-album-images{
        padding: 5px;
    }

    .div-album img{
        width: 100%;
    }
    .div-photo img{
        width: 100%;
    }
    /*.album-img-option{*/
        /*width: inherit;*/
        /*position: absolute;*/
        /*bottom: 2px;*/
        /*padding: 0 1.75em 0 1em;*/
        /*display: none;*/
    /*}*/

    /*.div-album-images:hover > .album-img-option{*/
        /*display: block;*/
    /*}*/


    .album-img-option{
        width: inherit;
        position: absolute;
        bottom: 2px;
        padding: 0 1.85em 0 .75em;
        display: none;
    }

    .div-album-images:hover > .album-img-option{
        display: block;
    }
    .modal-body{
        background-color: #515151;
        color: white;
        padding: 0;
    }
    .modal-body>div{
        padding: 0;
        margin: 0;
    }
    .btn-img-details{
        float: right;
    }
    .btn-img-details:hover{
        color: #35CCB0;
    }
    #text_img_details,#btn_imd_details_update{
        display: none;
    }

</style>
<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row mb-4">
        <div class="col-12 text-center my-5">
            <label class="page-heading font-color"><?php echo $this->lang->line('gallery_album')?></label>
            <a href="<?php echo site_url('all_gallery') ?>" class="btn-back" style="color: #35C9A7"><i
                    class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
            <a href="<?php echo site_url('create_album')?>" class="btn-paste px-4 py-2 m-1 text-white float-right" id="btn_crate_album"><?php echo $this->lang->line('create_album')?></a>
            <a href="<?php echo site_url('add_photo')?>" class="btn-paste px-4 py-2 m-1 text-white float-right" id="btn_upload_photo"><?php echo $this->lang->line('upload_photo')?></a>
        </div>
    </div>



    <div class="row mb-5">
        <div class="col-12">
            <h4 class="font-color"><?php echo $album_details[0]['album_name']?></h4>
            <p style="text-align: justify"><?php echo $album_details[0]['album_details']?></p>
        </div>
        <div class="col-12">
        <form method="post" enctype="multipart/form-data">
            <div class="row my-5">
                <!--        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">-->
                <!--            <label class="font-weight-bold font-color">PHOTO DETAILS<span class="text-red">*</span></label>-->
                <!--            <input type="text" class="form-control" placeholder="ALBUM NAME">-->
                <!--        </div>-->
                <!--        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 p-2">-->
                <!--            <label class="font-weight-bold font-color">YOUR LOCATION<span class="text-red">*</span></label>-->
                <!--            <input type="text" class="form-control" placeholder="ALBUM NAME">-->
                <!--        </div>-->



                <div class="col-12 p-2">
                    <label class="font-weight-bold font-color label-block"><?php echo $this->lang->line('uploaded_photos_videos')?><span class="text-red">*</span></label>
                    <div class="row" id="div_images">
                        <?php $img_id=-1; foreach ($album_details AS $item) { ?>
                            <?php if($item['image_file_location']!='' && $img_id!=$item['images_id']) { ?>
                        <div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2 div-album-images  uploaded-photo-video'>
                            <a href="#" onclick='view_photo_details(<?php echo json_encode($item,JSON_HEX_APOS)?>,event)'>
                                <?php if($item['image_is_video']==1){?>
                                    <video controls class="img-product" src="<?php echo base_url($item['image_file_location'])?>" width="100%"></video>
                                <?php } else { ?>
                                    <img class="img-product" src="<?php echo base_url($item['image_file_location'])?>" width="100%">
                                <?php } ?>
                            </a>
                            <div class="album-img-option">
                                <div class="row">
                                    <!--                            <button class="btn-paste py-1  col-6"><i class="fas fa-edit"></i></button>-->
                                    <button class="btn-paste btn-danger btn-block py-1 delete-file col-12" content="<?php echo $item['images_id']?>"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="col-12 col-xs-12 col-sm-6 col-md-3 col-lg-2 p-2 uploaded-photo-video" id="div_upload">
                            <div class="upload">
                                <input type="file" name="videos_photos[]" class="browse" accept='image/*,video/*' onchange='openFile(event)' multiple>
                                <div class="plus p-5">
                                    <i class="fas fa-plus my-3"></i>
                                    <label class="label-block"><?php echo $this->lang->line('add_photo')?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-12">
                    <button type="submit" class="btn-common collapse" id="btn_upload"><?php echo $this->lang->line('upload')?></button>
                </div>
            </div>

        </form>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modal_photo_details" tabindex="-1" role="dialog" aria-labelledby="modal_photo_details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php $this->lang->line('photo_details')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 p-0 div-img-video">
                        <img class="img-product" src="<?php echo base_url('assets/images/product/product_view.png')?>" width="100%">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="font-weight-bold"><?php echo $this->lang->line('album_name')?></label>
<!--                        <p class="text-paste">DRESS FOR EID</p>-->
                        <label class="label-block"><?php echo $this->lang->line('description')?></label>
                        <a href="#" onclick='edit_img_details("img",event)' class="text-paste btn-img-details"><?php echo $this->lang->line('edit')?></a>
                        <form method="post">
                        <input type="hidden" name="update_img_id" id="update_img_id">
                        <P class="text-justify" id="p_img_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</P>
                        <textarea id="update_text_image_details" name="update_text_image_details" rows="10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</textarea>
                        <button id="btn_imd_details_update" type="submit"  class="btn-paste p-2 m-2">Update</button>
                        </form>
<!--                        <p>--><?php //$this->lang->line('location')?><!-- :<span class="text-paste">DHAKA</span></p>-->
<!--                        <p>--><?php //$this->lang->line('day')?><!-- :<span class="text-paste">21 MAY 2019</span></p>-->
                    </div>
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


    function edit_img_details(img,event) {
        event.preventDefault();
        $('#p_img_details').css('display','none');
        $('#update_text_image_details').css('display','block');
        $('#btn_imd_details_update').css('display','block');
    }

    var openFile = function (event) {
        $('#btn_upload').removeClass('collapse');

        $('.pip').css('display','none');
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


    $('.delete-file').click(function () {
        image_id=$(this).attr('content');
        $(this).parent().parent().parent().remove();
        $.ajax({
            url: '<?php echo  site_url("all_gallery")?>',
            type: 'POST',
            data: {img_id: image_id},
            success: function (result) {
                if(result==-1)
                {
                    alert('Image/Video NOT Found');
                }
                else if(result==0)
                {
                    alert('Image/Video Deleting  Failed');
                }
            },
            error : function (error) {
                alert(error);
            }
        });
    });


    function view_photo_details(photo,event){
        event.preventDefault();
        $('.div-img-video').empty();

        if(photo['image_is_video']==1)
        {
            $('.div-img-video').append('<video controls class="img-product" src="<?php echo site_url()?>'+photo['image_file_location']+'" width="100%"></video>');
        }
        else
        {
            $('.div-img-video').append('<img class="img-product" src="<?php echo site_url()?>'+photo['image_file_location']+'" width="100%">');
        }
        $('#update_text_image_details').html(photo['image_description']);
        $('#p_img_details').html(photo['image_description']);
        $('#update_img_id').val(photo['images_id']);
        $('#modal_photo_details').modal('show');
        $('#update_text_image_details').css('display','none');
        $('#btn_imd_details_update').css('display','none');
        $('#p_img_details').css('display','block');

    }

</script>


