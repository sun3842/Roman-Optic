<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.css') ?>">
<style type="text/css" rel="stylesheet">
    .btn-load-more{
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }



    .more{

        font-size: small;
        color: #35C9A7;
        display: block;"
    }
</style>
<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('all_order')?></label>
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
            <table class="table table-striped text-center" id="table_order">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('order_id')?></th>
                    <th><?php echo $this->lang->line('order_date')?></th>
                    <th><?php echo $this->lang->line('delivery_date')?></th>
                    <th><?php echo $this->lang->line('order_status')?></th>
                    <th><?php echo $this->lang->line('action')?></th>
                </tr>
                </thead>

                <tbody>
                    <?php foreach ($orders AS $order) { ?>
                        <tr>
                            <td><?php echo $order['order_info_unique_number']?></td>
                            <td><?php echo $order['order_info_order_date']?></td>
                            <td><?php echo $order['order_info_delivery_date']?></td>
                            <td><?php echo $order['order_status_name']?></td>
                            <td><a href="#" class="action action-view" onclick='order_details(<?php echo json_encode($order,JSON_HEX_APOS)?>,event)'><i class="fas fa-eye"></i></a></td>
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
</div>

<!-- Modal  Order Details-->
<div class="modal fade" id="order_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('update_order')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_add_order" method="post" action="<?php echo site_url('edit_order')?>">
                    <div class="row">

                        <div class="col-12 py-3">
                            <label><?php echo $this->lang->line('order_unique_id')?><span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-weight-bold" name="order_unique_id" id="order_unique_id">
                        </div>
                        <div class="col-12 py-3">
                            <label><?php echo $this->lang->line('order_status')?><span class="text-danger">*</span></label>
                            <select name="order_status" id="order_status">
                                <?php foreach ($order_status AS $status) { ?>
                                    <option value="<?php echo $status['order_status_id']?>"><?php echo $status['order_status_name']?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 py-3">
                            <label><?php echo $this->lang->line('order_opinion')?></label>
                            <textarea class="" id="order_opinion" name="order_opinion"></textarea>
                        </div>

                        <input type="hidden" name="order_id" id="order_id" value="">
                        <div class="col-12 py-3">
                            <label><?php echo $this->lang->line('order_date')?></label>
                            <input type="text" class="form-control font-weight-bold date-picker" name="order_date" id="order_date">
                        </div>
                        <div class="col-12 py-3">
                            <label><?php echo $this->lang->line('delivery_date')?></label>
                            <input type="text" class="form-control font-weight-bold date-picker" name="delivery_date" id="delivery_date">
                        </div>
                        <div class="col-12 py-3">
                            <label><?php echo $this->lang->line('delivery_time')?></label>
                            <input type="text" class="form-control font-weight-bold time-picker" name="delivery_time" id="delivery_time">
                        </div>


                        <div class="col-12 py-3 text-center">
                            <input type="submit" class="btn-common py-2 text-large" name="update_order" id="update_order" value="<?php echo $this->lang->line('update_order')?>">
                        </div>

                    </div>
                </form>
            </div>
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                <button type="button" class="btn btn-primary">Save changes</button>-->
<!--            </div>-->
        </div>
    </div>
</div>
<script type="text/javascript" rel="script"
        src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js') ?>"></script>
<script type="text/javascript" rel="script">
    var stating_order_list= '<?php echo DEFAULT_DATA_LIMIT ?>';


    $('.btn-load-more').click(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo uri_string()?>',
            data: {order_start_limit : stating_order_list},
            success: function (result) {
                orders=$.parseJSON(result);
                total_order=orders.length;
                for(var i=0;i<total_order;i++)
                {

                    $('#table_order').find('tbody').append("<tr>\n" +
                        "                            <td>"+orders[i]['order_info_unique_number']+"</td>\n" +
                        "                            <td>"+orders[i]['order_info_order_date']+"</td>\n" +
                        "                            <td>"+orders[i]['order_info_delivery_date']+"</td>\n" +
                        "                            <td>"+orders[i]['order_status_name']+"</td>\n" +
                        "                            <td><a href='#' class='action action-view'  onclick='order_details("+JSON.stringify(orders[i])+",event)' ><i class='fas fa-eye'></i></a></td>\n" +
                        "                        </tr>");

                }
                stating_order_list=parseInt(stating_order_list,10)+<?php echo DEFAULT_DATA_LIMIT?>;
            },
            error:function (error) {
                alert(error);
            }
        });
    });

    function order_details(order,event) {
        event.preventDefault();
//        alert(order['order_info_unique_number']);
        $('#order_unique_id').val(order['order_info_unique_number']);
        $('#order_status').val(order['ref_order_info_order_status_id']);
        $('#order_opinion').val(order['order_info_opinion']);
        $('#order_date').val(order['order_info_order_date']);
        $('#delivery_date').val(order['order_info_delivery_date']);
        $('#delivery_time').val(order['order_info_delivery_time']);
        $('#order_id').val(order['order_info_id']);
        $('#order_model').modal('show');
    }


    $('.date-picker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });

    $('.time-picker').datetimepicker({
        timepicker: true,
        datepicker: false,
        format: 'h:i',
    });


    $('#form_add_order').validate({
        rules: {
            order_unique_id: {
                required: true,
                remote: {

                    url: '<?php echo base_url('is_order_unique_id_editable')?>',

                    type: "post",
                    data:
                        {

                            order_data: function() {

                                return $( "#order_unique_id" ).val()+'`!#$^(se[||<~`43>])^_%+/*-'+$('#order_id').val();
                            }
                        }
                }
            },
            order_status: {
                required: true,
            }
        }
    });
</script>

