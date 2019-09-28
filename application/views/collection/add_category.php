<style type="text/css" rel="stylesheet">
    .box-heading{
        display: block;
        text-align: center;
        padding: 10px 0 10px 0;
        color: white;
        background-color: #35C9A8;
        text-transform: uppercase;

    }
    .box-off-white{
        background-color: #E1E3E5;
        padding: 0;
        margin: 5px;
    }
    .box-body{
        padding: 15px 10px 10px 10px;
    }
    div{
        padding: 0;
    }
    .btn-common{
        background-color: #515151;
    }
    .category-list{
        color: black;
        display: block;
        padding: 5px;
        margin: 5px;
        text-decoration: none;
        cursor: pointer;

    }
    .category-list:hover{
        background-color: #C7C9CA;
        text-decoration: none;
        color: black;
    }
    .category-list-active{
        background-color: #C7C9CA;
    }

    .sub-category-list{
        color: black;
        display: block;
        padding: 5px;
        margin: 5px;
        text-decoration: none;
        cursor: pointer;

    }
    .sub-category-list:hover{
        background-color: #C7C9CA;
        text-decoration: none;
        color: black;
    }

</style>
<div class="content">

    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('add_category')?></label>
            <a href="<?php echo base_url('all_category')?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 box-off-white">
            <label class="box-heading"><?php echo $this->lang->line('category')?></label>
            <div class="box-body">
                <input type="text" class="form-control" id="text_add_category">
                <label class="text-red" id="text_msg_add_category"></label>
                <button id="btn_add_category" class="btn-common btn-block my-3"><?php echo $this->lang->line('add_category')?></button>
            </div>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 box-off-white">
            <label class="box-heading"><?php echo $this->lang->line('category_list')?></label>
            <div class="box-body" id="div_category_list">
                <?php foreach ($active_categories AS $category) { ?>
                    <a href="#" role="<?php echo $category['category_id']?>" class="category-list"><?php echo $category['category_name']?></a>
                <?php } ?>
            </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 box-off-white">
            <label class="box-heading"><?php echo $this->lang->line('subcategory')?></label>
            <div class="box-body">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <input type="text" class="form-control" id="text_add_sub_category">
                        <label class="text-red" id="text_msg_add_sub_category"></label>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <button class="btn-common btn-block mt-1" style="padding: 5px" id="btn_add_sub_category"><i class="fas fa-plus"></i> <?php echo $this->lang->line('add')?></button>
                    </div>
                </div>
                <div id="div_sub_category_list">

                </div>
<!--                <a class="sub-category-list">Category 1</a>-->
<!--                <a class="sub-category-list">Category 2</a>-->
<!--                <a class="sub-category-list">Category 3</a>-->
            </div>
        </div>


    </div>

</div>