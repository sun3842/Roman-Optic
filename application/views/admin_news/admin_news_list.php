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
            <label class="page-heading"><?php echo $this->lang->line('news_list');?></label>
            <a href="" class="btn-back" style="color: #35C9A7;visibility: hidden"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back');?></a>
            <a href="<?php echo site_url('create_news')?>" class="btn-common" style="float: right;"><?php echo $this->lang->line('create_news');?></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="<?php echo $this->lang->line('search');?>" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <input type="text" class="date-time-picker form-control" placeholder="<?php echo $this->lang->line('select_date');?>">
        </div>

        <div class="col-12 table-responsive">
            <table class="table table-striped text-center" id="table_news">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('date');?></th>
                    <th><?php echo $this->lang->line('news_title');?></th>
<!--                    <th>--><?php //echo $this->lang->line('detail');?><!--</th>-->
                    <th><?php echo $this->lang->line('action');?></th>
                </tr>
                </thead>

                <?php foreach ($news_list as $n_list)
                {?>

                    <tr class="text-small">
                        <td><?php echo date_format(new DateTime($n_list['news_created_date_time']),'d F Y');?></td>
                        <td><?php echo $n_list['news_title'] ?></td>
<!--                        <td>--><?php //echo $n_list['news_details'] ?><!--</td>-->
                        <td>
                            <a href="#" class="action action-view" onclick='NewsDetails(<?php echo json_encode($n_list);?>,event)'><i class="fas fa-eye"></i></a>
                            <a href="<?php echo site_url('edit_news/'.$n_list["news_id"]) ?>" class="action action-edit" ><i class="far fa-edit"></i></a>
                            <a href="#" onclick='delete_news(<?php echo $n_list["news_id"]?>,event)' class="action action-delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>

                <?php  }  ?>

            </table>

        </div>

        <div class="col-12 text-center mt-1">
            <button class="text-paste btn-load-more"><i class="fas fa-angle-down"></i></button>
            <label class="text-center more"><?php echo $this->lang->line('more');?></label>
        </div>

    </div>

    <div class="modal bd-example-modal-lg fade" id="news_modal" tabindex="-1" role="dialog" aria-labelledby="news_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle"><?php echo $this->lang->line('news_details');?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-lg">


                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 ml-3" id="news_img"></div>
                    </div>

                    <div class="col-12 ">
                        <h5 class="label-block"><span id="news_title"></span></h5>
                    </div>
                    <div class="col-12">
                        <label class="label-block font-color" id="designation"></label>
                    </div>


                    <div class="col-12 font-color text-justify">
                        <p id="news_details"></p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="delete_news_modal" tabindex="-1" role="dialog" aria-labelledby="delete_news_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('delete_news');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo site_url('d')?>">

                <div class="modal-body">
                    <?php echo $this->lang->line('are_you_you_sure_to_delete_this_news');?>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger" id="btn_delete_news"><?php echo $this->lang->line('delete');?></a>

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


    function NewsDetails(news,event) {
        event.preventDefault();

        var img = news['news_image_location'];
        if(img != null)

        {   $('#news_title').html("");
            $('#news_img').html("");
            $('#news_details').html("");

            $('#news_img').html('<img width = "50%" class="img-product" src="<?php echo base_url();?>'+img+'">');
            $('#news_title').html(news['news_title']);
            $('#news_details').html(news['news_details']);


        }

        else
        {
            $('#news_title').html("");
            $('#news_img').html("");
            $('#news_details').html("");

            $('#news_title').html(news['news_title']);
            $('#news_details').html(news['news_details']);

        }

        $('#news_modal').modal('show');
    }

    function delete_news($news_id,event) {
        event.preventDefault();

        $('#btn_delete_news').attr('href','<?php  echo site_url('delete_news/')?>'+$news_id);
        $('#delete_news_modal').modal("show");
    }


    var stating_news_list= '<?php echo DEFAULT_DATA_LIMIT ?>';

    $('.btn-load-more').click(function()

    {
        $.ajax({
            type: 'POST',
            url: '<?php echo uri_string()?>',
            data: {news_start_limit : stating_news_list},
            success: function (result) {
                news = $.parseJSON(result);
                total_news = news.length;
                for(var i=0;i<total_news;i++)
                {

                    $('#table_news').find('tbody').append("<tr class=\"text-small\">\n" +
                        "                    <td>"+news[i]['news_created_date_time']+"</td>\n" +
                        "                    <td>"+news[i]['news_title']+"</td>\n" +
                        "                    <td>"+news[i]['news_details']+"</td>\n" +

                        "                    <td>\n" +
                        "                        <a href='#' onclick='NewsDetails("+JSON.stringify(news[i])+",event)' class='action action-view'><i class='fas fa-eye'></i></a>\n" +
                        "                        <a href='<?php echo site_url('edit_news/')?>"+news[i]['news_id']+"' class='action action-edit'><i class='far fa-edit'></i></a>\n" +
                        "                        <a href='#' onclick='delete_news("+news[i]['news_id']+",event)' class='action action-delete'><i class='far fa-trash-alt'></i></a>\n" +
                        "                    </td>\n" +
                        "                </tr>");

                }
                stating_news_list = parseInt(stating_news_list,10)+<?php echo DEFAULT_DATA_LIMIT?>;
            },
            error:function (error) {
                alert(error);
            }
        });

    });


</script>



