<style type="text/css" rel="stylesheet">

    .row > div {
        margin: 4px 0 12px 0;
    }

    .event_four_button_backgroundCol_display {

        display: inline-block;
        background-color: #FFF;
    }

    .event_four_button_backgroundCol_display button.active {

        color: #fff;
        background-color: #515151;
    !important;

    }

    .text_checkbox {

        font-size: x-small;
        color: #595959;
    }

    .slide_range {
        color: #f6931f;
        font-weight: bold;
        margin-left: 15px;
        text-align: center;
        margin-bottom: 30px;
        border: none;
    }

    .no {


        background-color: #515151;
        color: #fff;
    }

    .yes {


        background-color: #35C9A7;
        color: #fff;
    }

    .btn-load-more {
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }

    .modal-header {
        background-color: #34CAA7;
        color: white;
        text-align: center;
    }

    .img-product {
        width: 100%;
    }

    .clip-board-text {
        width: 100%;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 2px solid #34CAA7;
        outline: none;
    }

    .clip-board-btn {
        color: black;
        text-decoration: none;
        border-bottom: 1px solid black;
    }

    .clip-board-btn:hover {
        color: black;
        text-decoration: none;
    }

    .btn-md-circle {
        height: 35px;
        width: 35px;
        border-radius: 22px;
        border: none;
    }


</style>


<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('all_apps')?></label>
        </div>
        <div class="col-12 my-3">
            <a href="<?php echo site_url('add_app') ?>" class="btn-common" style="float: right;"><?php echo $this->lang->line('add_app')?></a>
        </div>
    </div>




        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped text-center" id="table_event">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line('app_name')?></th>
                        <th><?php echo $this->lang->line('app_available_expecting_date')?></th>
                        <th><?php echo $this->lang->line('app_release_date')?>(ANDROID)</th>
                        <th><?php echo $this->lang->line('app_release_date')?>(IOS)</th>
                        <th><?php echo $this->lang->line('action')?></th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php foreach ($apps AS $app) { ?>
                    <tr>
                        <td><?php echo $app['app_details_app_name']?></td>
                        <td><?php echo($app['app_details_available_expecting_date']=='')?'--:--:----':date_format(new DateTime($app['app_details_available_expecting_date']),'d F Y')?></td>
                        <td><?php echo($app['app_details_android_available_date_time']=='')?'--:--:----':date_format(new DateTime($app['app_details_android_available_date_time']),'d F Y')?></td>
                        <td><?php echo($app['app_details_ios_available_date_time']=='')?'--:--:----':date_format(new DateTime($app['app_details_ios_available_date_time']),'d F Y')?></td>
                        <td>
                            <a  href="<?php echo site_url('view_app/'.$app['app_info_id'])?>" class="action action-view"><i class="fas fa-eye"></i></a>
                            <?php if($app['app_details_android_uploading_date_time']=='' && $app['app_details_ios_uploading_date_time']==''){ ?>
                            <a href="<?php echo site_url('edit_app/'.$app['app_info_id'])?>" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" onclick='delete_app(<?php echo $app["app_info_id"]?>,event)' class="action action-delete"><i class="far fa-trash-alt"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>



</div>


<!-----------------------------------------------Delete App------------------------------------------------------------------->

<div class="modal fade bd-example-modal-lg" id="delete_modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h5 class="dialog_header text-align-center " id="exampleModalLongTitle">
                    <center><?php echo $this->lang->line('delete_app')?>!!!</center>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff">&times;</span>
                </button>
            </div>

            <div class="dialog_margin">


                <div class="news_details_text">
                    <p class="text-justify text-center text-small py-3">
                        <?php echo $this->lang->line('do_you_want_to_delete_app')?>?
                    </p>



                </div>




            </div>
            <div class="row">
                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                    <button class="no btn py-1  btn-block" data-dismiss="modal" aria-label="Close"><?php echo $this->lang->line('no')?></button>
                </div>
                <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a href="#" id="delete_app" class="yes btn  py-1 btn-block"><?php echo $this->lang->line('yes')?></a>
                </div>
            </div>
        </div>
    </div>

</div>






<script type="text/javascript" rel="script">
    function delete_app(app_id,event) {
        event.preventDefault();
        $('#delete_app').attr('href','<?php echo site_url("delete_app/")?>'+app_id);
        $('#delete_modal').modal('show');
    }
</script>



