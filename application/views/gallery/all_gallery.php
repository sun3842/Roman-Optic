<style type="text/css" rel="stylesheet">
    .btn-gallery-option{
        background: none;
        border: none;
        font-size: large;
        font-weight: bold;
        color: #515151;
        cursor: pointer;
    }
    .btn-gallery-option:focus{
        outline: none;
    }
    .btn-gallery-option.btn-gallery-active{
        color: #35CCB0;
    }
    .button-selector{
        /*height: 30px;*/
        /*width: 30px;*/
        width: 0;
        height: 0;
        border-left: 30px solid transparent;
        border-right: 30px solid transparent;
        border-bottom: 30px solid #E1E3E5;
        /*background-color: #E1E3E5;*/
        color: #E1E3E5;
        position: absolute;
        /*transform: rotate(45deg);*/
        top: -30px;
        left: 35px;
        z-index: 1;
    }
    .add-data-gallery{

        display: block;
        min-width: 200px;
        background-color: white;
        text-decoration: none;
        color: #6B6B6B;
        text-align: center;
        font-size: large;

    }
    .add-data-gallery:hover{
        text-decoration: none;
        color: #6B6B6B;

    }

    .div-photo{
        /*display: none;*/
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
    .album-img-option{
        width: inherit;
        position: absolute;
        bottom: 2px;
        padding: 0 1.75em 0 1em;
        display: none;
    }

    .div-album-images:hover > .album-img-option{
        display: block;
    }

    .div-album{
        display: none;
    }

    #modal_photo_details .modal-body{
        background-color: #515151;
        color: white;
        padding: 0;
    }
    #modal_photo_details .modal-body>div{
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
            <a href="<?php echo site_url('home') ?>" class="btn-back" style="color: #35C9A7"><i
                        class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
            <a href="<?php echo site_url('create_album')?>" class="btn-paste px-4 py-2 m-1 text-white float-right" id="btn_crate_album"><?php echo $this->lang->line('create_album')?></a>
            <a href="<?php echo site_url('add_photo')?>" class="btn-paste px-4 py-2 m-1 text-white float-right" id="btn_upload_photo"><?php echo $this->lang->line('upload_photo')?></a>


        </div>
    </div>



    <div class="row mb-5">
        <div class="col-12">
            <button class="btn-gallery-option  btn-gallery-active" id="gallery_photo"><?php echo $this->lang->line('photos')?></button>
            <button class="btn-gallery-option" id="gallery_album"><?php echo $this->lang->line('album')?></button>
        </div>
        <div class="col-12 box-off-white mt-4 p-4">
            <div class="row div-album">
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-3">
                    <a href="<?php echo site_url('create_album')?>" class="add-data-gallery p-5"><i class="fas fa-plus-circle p-5" style="font-size: xx-large"></i><label class="label-block pb-5"><?php echo $this->lang->line('create_album')?></label></a>
                </div>
                <?php $temp_album_id=-1; foreach ($albums AS $album) { ?>
                    <?php if($temp_album_id!=$album['album_id']){ ?>
                        <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 div-album-images" id="album_<?php echo $album['album_id']?>">
                            <a href="<?php echo site_url('album_details/'.$album['album_id'])?>">

                                <?php if($album['image_is_video']==1){?>
                                    <video controls class="img-product" src="<?php echo base_url($album['image_file_location'])?>" width="100%"></video>
                                <?php } else { ?>
                                    <img class="img-product" src="<?php echo ($album['image_file_location']!='')? base_url($album['image_file_location']):'http://placehold.it/200x128'?>" width="100%">
                                <?php } ?>
                            </a>
                            <div class="album-img-option">
                                <div class="row">
                                    <button class="btn-paste py-1  col-6" onclick='update_album(<?php echo json_encode($album,JSON_HEX_APOS)?>)' type="button"><i class="fas fa-edit"></i></button>
                                    <button class="btn-paste btn-danger delete-album py-1 col-6"   content="<?php echo $album['album_id']?>" type="button"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <?php $temp_album_id=$album['album_id']; }?>
                <?php } ?>
            </div>


            <div class="row div-photo">
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-3">
                    <a href="<?php echo site_url('add_photo')?>" class="add-data-gallery p-5"><i class="fas fa-plus-circle p-5" style="font-size: xx-large"></i><label class="label-block pb-5"><?php echo $this->lang->line('upload_photo')?></label></a>
                </div>
                <?php foreach ($files AS $file){ ?>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 div-album-images">
                        <a href="#" onclick='view_photo_details(<?php echo json_encode($file,JSON_HEX_APOS)?>,event)'>
                            <?php if($file['image_is_video']==1){?>
                                <video controls class="img-product" src="<?php echo base_url($file['image_file_location'])?>" width="100%"></video>
                            <?php } else { ?>
                                <img class="img-product" src="<?php echo base_url($file['image_file_location'])?>" width="100%">
                            <?php } ?>
                        </a>
                        <div class="album-img-option">
                            <div class="row">
                                <!--                            <button class="btn-paste py-1  col-6"><i class="fas fa-edit"></i></button>-->
                                <button class="btn-paste btn-danger btn-block py-1 delete-file col-12" content="<?php echo $file['images_id']?>"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="button-selector"></div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal_photo_details" tabindex="-1" role="dialog" aria-labelledby="modal_photo_details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('photo_details')?></h5>
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
                        <label class="font-weight-bold"><?php echo  $this->lang->line('album_name')?></label>
<!--                        <p class="text-paste">DRESS FOR EID</p>-->
                        <label class="label-block"><?php echo $this->lang->line('description')?></label>
                        <a href="#" onclick='edit_img_details("img",event)' class="text-paste btn-img-details"><?php echo $this->lang->line('edit')?></a>
                        <form method="post">
                            <input type="hidden" name="update_img_id" id="update_img_id">
                            <P class="text-justify" id="p_img_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</P>
                            <textarea id="update_text_img_details" name="update_text_image_details" rows="10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</textarea>
                            <button id="btn_imd_details_update" type="submit"  class="btn-paste p-2 m-2">Update</button>
                        </form>
<!--                        <p>--><?php //echo $this->lang->line('location')?><!-- :<span class="text-paste">DHAKA</span></p>-->
<!--                        <p>--><?php //echo $this->lang->line('day')?><!-- :<span class="text-paste">21 MAY 2019</span></p>-->
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


<!-- Modal album Update-->
<div class="modal fade" id="modal_update_album" tabindex="-1" role="dialog" aria-labelledby="modal_update_album" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_update_album">
                    <div class="row">
                        <div class="col-12 my-3">
                            <label>Updated Album Name</label>
                            <input type="text" name="update_album_name" id="update_album_name" class="form-control">
                        </div>
                        <div class="col-12 my-3">
                            <label>Updated Album Details</label>
                            <textarea name="update_album_details" id="update_album_details"></textarea>
                        </div>
                        <input type="hidden" name="update_album_id" id="update_album_id">
                        <div class="col-12 my-3">
                            <button type="submit" class="btn-common btn-block">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete_album_modal" tabindex="-1" role="dialog" aria-labelledby="delete_album_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Album</h5>
                <button type="button" id="album_delete_modal_close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo site_url('delete_category')?>">

                <div class="modal-body">
                    Are you You sure to delete this ???
                </div>
                <div class="modal-footer">
                    <a href="#"  onclick=''  class="btn btn-danger" id="confirm_album_delete">Delete</a>

                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript" rel="script">
    $('#gallery_photo').click(function () {
        $('.button-selector').css('left','35px');
        $('#gallery_album').removeClass('btn-gallery-active');
        $(this).addClass('btn-gallery-active');
        $('.div-photo').css('display','flex');
        $('.div-album').css('display','none');
    });
    $('#gallery_album').click(function () {
        $('.button-selector').css('left','110px');
        $('#gallery_photo').removeClass('btn-gallery-active');
        $(this).addClass('btn-gallery-active');
        $('.div-photo').css('display','none');
        $('.div-album').css('display','flex');
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

        $('#update_text_img_details').html(photo['image_description']);
        $('#p_img_details').html(photo['image_description']);
        $('#update_img_id').val(photo['images_id']);
        $('#modal_photo_details').modal('show');

        $('#update_text_img_details').css('display','none');
        $('#btn_imd_details_update').css('display','none');
        $('#p_img_details').css('display','block');

    }
    function edit_img_details(img,event) {
        event.preventDefault();
        $('#p_img_details').css('display','none');
        $('#update_text_img_details').css('display','block');
        $('#btn_imd_details_update').css('display','block');
    }

    $('.delete-file').click(function () {
        image_id=$(this).attr('content');
        $(this).parent().parent().parent().remove();
        $.ajax({
            url: '<?php echo  uri_string()?>',
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

    $('.delete-album').click(function () {
       var delete_album_id=$(this).attr('content');
        $('#confirm_album_delete').attr('onclick','delete_album('+delete_album_id+')');
        $('#delete_album_modal').modal('show');


    });

    function delete_album(delete_album_id) {
        $('#album_'+delete_album_id).remove();
        $.ajax({
            url: '<?php echo  uri_string()?>',
            type: 'POST',
            data: {album_id: delete_album_id},
            success: function (result) {
                if(result==-1)
                {
                    alert('Album NOT Found');
                }
                else if(result==0)
                {
                    alert('Album Deleting  Failed');
                }
            },
            error : function (error) {
                alert(error);
            }
        });
        $('#album_delete_modal_close').trigger('click');
    }

    function update_album(album) {
//        alert('album');
        $('#update_album_name').val(album['album_name']);
        $('#update_album_id').val(album['album_id']);
        $('#update_album_details').html(album['album_details']);
        $('#modal_update_album').modal('show');
    }
    $('#form_update_album').validate({
        rules: {
            update_album_name: {
                required: true,
            }
        },
        messages: {
            update_album_name: 'Update Album Is Required',
        }
    });
</script>
