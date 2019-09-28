<style type="text/css" rel="stylesheet">

    div {
        padding: 0;
    }

    .btn-load-more {
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }

    .category {
        text-decoration: none;
        color: black;
    }

    .category:hover {
        text-decoration: none;
        color: black;
    }
</style>
<div class="content">

    <h4 class="text-center"><?php echo date('d F Y (l)') ?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('category')?></label>
            <a href="<?php echo base_url('add_category') ?>" class="btn-common" style="float:right"><?php echo $this->lang->line('add_category')?></a>
        </div>
    </div>
<!--
    <div class="row">
        <div class="col-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
-->

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo $this->lang->line('category')?></th>
                    <th><?php echo $this->lang->line('subcategory')?></th>
                    <th><?php echo $this->lang->line('action')?></th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                foreach ($categories AS $category) { ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo $category['category_name'] ?></td>
                        <td><?php echo $category['subctg'] ?></td>
                        <td>
                            <a href="<?php echo $category['subctg']!=0?site_url('all_subcategory/'.$category['category_id']):'#';?>" class="action action-view" <?php echo $category['subctg']==0?"onclick='no_subcategory()'":"";?>><i class="fas fa-eye"></i></a>
                            <a href="#" onclick='edit_category(<?php echo json_encode($categories[$i],JSON_HEX_APOS); ?>,event)'
                               class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" onclick='delete_category(<?php echo json_encode($categories[$i],JSON_HEX_APOS); ?>,event)' class="action action-delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php $i++;
                } ?>
                </tbody>
            </table>
        </div>
        <!--
        <div class="col-12 text-center">
            <button class="text-paste btn-load-more"><i class="fas fa-angle-down"></i></button>
        </div>
        -->
    </div>

</div>


<div class="modal fade" id="category_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('update_category_name')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_update_ctg">
                <div class="modal-body">
                    <input type="text" value="" class="form-control" name="text_update_category_name"
                           id="text_update_category_name">
                    <input type="hidden" value=""  name="text_update_category_id"
                           id="text_update_category_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-common"><?php echo $this->lang->line('update')?></button>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="modal fade" id="no_subcategory" tabindex="-1" role="dialog" aria-labelledby="no_subcategory"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('no_subcategory')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_update_ctg">
                <div class="modal-body">
                    <?php echo $this->lang->line('no_subcategory')?>
                </div>
                <div class="modal-footer">

                </div>
            </form>

        </div>
    </div>
</div>


<!-- delete Modal -->
<div class="modal fade" id="delete_product_modal" tabindex="-1" role="dialog" aria-labelledby="delete_product_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('delete_category')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo site_url('delete_category')?>">

            <div class="modal-body">
                <?php echo $this->lang->line('are_you_sure_to_delete_this_category')?> ???
                <div class="row">
                    <div class="col-12 my-2"><input type="checkbox" name="product_delete" id="product_delete" class="mr-4"> <?php echo $this->lang->line('delete_product_also')?></div>
                    <input type="hidden" id="delete_category" name="delete_category">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="btn_delete_category"><?php echo $this->lang->line('delete')?></button>

            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" rel="script">

    function edit_category(category, event) {
        event.preventDefault();
        $('#text_update_category_name').val(category['category_name']);
        $('#text_update_category_id').val(category['category_id']);
        $('#category_update').modal('show');
    }

    function delete_category(category,event) {
        event.preventDefault();
        $('#delete_category').val(category['category_id']);
        $('#delete_product_modal').modal("show");
    }

    function no_subcategory()
    {
        $('#no_subcategory').modal("show");
    }

    $('#form_update_ctg').validate({
        rules: {
            text_update_category_name: {
                required: true,
                remote: {
                    url: '<?php echo uri_string();?>',

                    type: "post",
                    data:
                        {

                            update_ctg_name: function () {

                                return $("#text_update_category_name").val();
                            },
                            update_ctg_id: function () {

                                return $("#text_update_category_id").val();
                            }
                        }
                }
            },
        },
        messages: {
            text_update_category_name: '<?php echo $this->lang->line('type_unique_category_name');?>',
        }
    });
</script>