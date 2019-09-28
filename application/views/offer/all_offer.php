<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css')?>">
<style type="text/css" rel="stylesheet">

    .row>div{
        margin: 4px 0 12px 0;
    }

    .btn-load-more{
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }

    .img-product{
        width: 120px;
        height: 120px;
    }

    .more{

        font-size: small;
        color: #35C9A7;
        display: block;"
    }

    .dialogue_box_title_text{

        color: #595959;
        font-size: large;
        font-weight: bold;
    }

    .dialogue_box_reporter_name{

        color: #35C9A7;
        font-size: small;
        font-weight: bold;

    }

    .dialog_margin{

        margin: 15px;
    }

    .news_details_text{

        font-weight: bold;
        font-size: small;
        color: #595959;
    }
    table>tbody>tr{
        font-size: small;
    }

</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('offer')?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="SEARCH" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <input type="text" class="date-time-picker form-control" placeholder="Select Date">
        </div>

        <div class="col-12 table-responsive">
            <table class="table table-striped text-center" id="table_offer">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('date')?></th>
                    <th><?php echo $this->lang->line('type')?></th>
                    <th><?php echo $this->lang->line('offer_title')?></th>
                    <th><?php echo $this->lang->line('start_date')?></th>
                    <th><?php echo $this->lang->line('end_date')?></th>
                    <th><?php echo $this->lang->line('action')?></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($offers AS $offer) { ?>
                <tr>
                    <td><?php echo date_format(new DateTime($offer['offer_created_date_time']),'d F Y');?></td>
                    <td><?php echo ($offer['ref_offer_target_type_id']==1)? 'General':(($offer['ref_offer_target_type_id']==2)? 'Target':'Personal') ?></td>
                    <td><?php echo $offer['offer_title']?></td>
                    <td><?php echo ($offer['offer_starting_date_time']!='')?date_format(new DateTime($offer['offer_starting_date_time']),'d F Y'):'';?></td>
                    <td><?php echo ($offer['offer_ending_date_time']!='')?date_format(new DateTime($offer['offer_ending_date_time']),'d F Y'):''?></td>
                    <td>
                        <a href="<?php echo site_url('offer_details/'.$offer['offer_id'])?>" class="action action-view" ><i class="fas fa-eye"></i></a>
                        <a href="<?php echo site_url('edit_offer/'.$offer['offer_id'])?>" class="action action-edit"><i class="far fa-edit"></i></a>
                        <a href="#" onclick='delete_offer(<?php echo $offer["offer_id"]?>,event)' class="action action-delete"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>


            </table>

        </div>

        <div class="col-12 text-center mt-1">
            <button class="text-paste btn-load-more"><i class="fas fa-angle-down"></i></button>
            <label class="text-center more"><?php echo $this->lang->line('more')?></label>
        </div>

    </div>





    <!-- delete Modal -->
    <div class="modal fade" id="delete_offer_modal" tabindex="-1" role="dialog" aria-labelledby="delete_offer_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('delete_offer')?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo site_url('delete_category')?>">

                    <div class="modal-body">
                        <?php echo $this->lang->line('are_you_sure_to_delete_this_offer')?> ???
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-danger" id="btn_delete_offer"><?php echo $this->lang->line('delete')?></a>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js')?>"></script>


    <script type="text/javascript" rel="script">
        $('.date-time-picker').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
        });




        function delete_offer(product_id,event) {
            event.preventDefault();
            $('#btn_delete_offer').attr('href','<?php echo site_url('delete_offer/')?>'+product_id);
            $('#delete_offer_modal').modal("show");
        }

        var stating_offer_list= '<?php echo DEFAULT_DATA_LIMIT ?>';


        $('.btn-load-more').click(function () {
            $.ajax({
                type: 'POST',
                url: '<?php echo uri_string()?>',
                data: {offer_start_limit : stating_offer_list},
                success: function (result) {
                    offers=$.parseJSON(result);
                    total_offer=offers.length;
                    for(var i=0;i<total_offer;i++)
                    {

                        $('#table_offer').find('tbody').append("<tr>\n" +
                            "                    <td>"+offers[i]['offer_created_date_time']+"</td>\n" +
                            "                    <td>"+offers[i]['ref_offer_target_type_id']+"</td>\n" +
                            "                    <td>"+offers[i]['offer_title']+"</td>\n" +
                            "                    <td>"+offers[i]['offer_starting_date_time']+"</td>\n" +
                            "                    <td>"+offers[i]['offer_ending_date_time']+"</td>\n" +
                            "                    <td>\n" +
                            "                        <a href='<?php echo site_url('offer_details/')?>"+offers[i]['offer_id']+"' class='action action-view'><i class='fas fa-eye'></i></a>\n" +
                            "                        <a href='<?php echo site_url('edit_offer/')?>"+offers[i]['offer_id']+"' class='action action-edit'><i class='far fa-edit'></i></a>\n" +
                            "                        <a href='#' onclick='delete_offer("+offers[i]['offer_id']+",event)' class='action action-delete'><i class='far fa-trash-alt'></i></a>\n" +
                            "                    </td>\n" +
                            "                </tr>");

                    }
                    stating_offer_list=parseInt(stating_offer_list,10)+<?php echo DEFAULT_DATA_LIMIT?>;
                },
                error:function (error) {
                    alert(error);
                }
            });
        });

    </script>



