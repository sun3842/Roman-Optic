<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.css') ?>">
<link type="text/css" rel="stylesheet"
      href="<?php echo base_url('assets/app_assets/plugins/jquery-ui-1.12.1/jquery-ui.css') ?>">


<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row mb-4">
        <div class="col-12 text-center my-5">
            <label class="page-heading font-color"><?php echo $this->lang->line('order')?></label>
            <a href="<?php echo base_url('home') ?>" class="btn-back" style="color: #35C9A7"><i
                    class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>
    <form id="form_add_order" method="post">
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
            <input type="submit" class="btn-common py-2 text-large" name="add_order" id="add_order" value="<?php echo $this->lang->line('add_order')?>">
        </div>

    </div>
    </form>
</div>

<script type="text/javascript" rel="script"
        src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js') ?>"></script>
<script>
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

                    url: '<?php echo base_url('is_order_id_exist')?>',

                    type: "post",
                    data:
                        {

                            order_id: function() {

                                return $( "#order_unique_id" ).val();
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