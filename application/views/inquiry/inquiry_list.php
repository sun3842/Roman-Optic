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


    .news_details_text{

         font-weight: bold;
         font-size: small;
         font-weight: bold;
         color: #595959;

    }

    .padding-left{

        padding-left: 5em;
    }

    @media only screen and (min-width: 200px) and (max-width: 320px){
        .news_details_text{
            font-size: x-small;
        }
    }

    table>tbody>tr>td:nth-child(4){
        color: red;
    }

</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('inquiry')?></label>
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
            <table class="table table-striped text-center" id="table_inquires">
                   <thead>
                <tr>
                    <th><?php echo $this->lang->line('type')?></th>
                    <th><?php echo $this->lang->line('name')?></th>
<!--                    <th>EMAIL</th>-->
                    <th><?php echo $this->lang->line('phone')?></th>
<!--                    <th>INQUIRY PRODUCT ID</th>-->
<!--                    <th>STATUS</th>-->
                    <th><?php echo $this->lang->line('action')?></th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($inquiries AS $inquiry){ ?>
               <tr class="<?php echo($inquiry['inquiry_is_seen']==0)?"":((( $inquiry['inquiry_reply_is_seen']==1) || ($inquiry['inquiry_reply_is_seen']==''))?"font-color":"") ?>">
                   <td><?php echo ($inquiry["ref_inquiry_product_id"]!='')?"Product":(($inquiry["ref_inquiry_offer_id"]!='')?"Offer":"")?></td>
                    <td><?php echo $inquiry['inquiry_full_name']?></td>
<!--                    <td>john@gmail.com</td>-->
                    <td><?php echo $inquiry['inquiry_phone_number']?></td>
<!--                    <td>A12563</td>  -->
<!--                    <td>Registred</td>               -->
                    <td>
                        <a href="<?php echo site_url('inquiry_reply/'.$inquiry['inquiry_id'])?>" class="action action-view"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                <?php } ?>


<!---->
<!--                <tr class="text-small">-->
<!--                    <td>John Doe</td>-->
<!--                    <td>john@gmail.com</td>-->
<!--                    <td>ANDROID</td>     -->
<!--                    <td>A12563</td>  -->
<!--                    <td>Registred</td>               -->
<!--                    <td>-->
<!--                        <a href="#" class="action action-view"><i class="fas fa-eye"></i></a>-->
<!--                        <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>-->
<!--                    </td>-->
<!--                </tr>-->

                </tbody>
            </table>
        </div>
        
    </div>
  

          <div class="col-12 text-center mt-1">
            <button class="text-paste btn-load-more"><i class="fas fa-angle-down"></i> <label class="text-center label-block text-small"><?php echo $this->lang->line('more')?></label></button>

        </div>  

    </div>



<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js')?>"></script>


<script type="text/javascript" rel="script">
    $('.date-time-picker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });



    starting_inquiry_limit=<?php echo DEFAULT_DATA_LIMIT ?>;

    $('.btn-load-more').click(function () {
        $.ajax({
           url: '<?php echo uri_string();?>',
           type: 'POST',
           data: {inquiry_limit: starting_inquiry_limit},
           success: function (result) {
//               alert(result);
               var inquires=$.parseJSON(result);
               var  total_inquires=inquires.length;
               for (var i=0;i<total_inquires;i++){
                   var is_seen='';
                   if(inquires[i]['inquiry_is_seen']==1)
                   {
                       if(inquires[i]['inquiry_reply_is_seen']==1 || inquires[i]['inquiry_reply_is_seen']=='')
                       {
                           is_seen='font-color';
                       }
                   }
                   var is_product='Product';
                   if(inquires[i]["ref_inquiry_product_id"]==null)
                   {
                       is_product='Offer';
                   }
                   $('#table_inquires').find('tbody').append('<tr class="'+is_seen+'">\n' +
                       '                    <td>'+is_product+'</td>\n' +
                       '                    <td>'+inquires[i]["inquiry_full_name"]+'</td>\n' +
                       '                    <td>'+inquires[i]["inquiry_phone_number"]+'</td>\n' +
                       '                    <td>\n' +
                       '                        <a href="<?php echo site_url("inquiry_reply/")?>'+inquires[i]["inquiry_id"]+'" class="action action-view"><i class="fas fa-eye"></i></a>\n' +
                       '                    </td>\n' +
                       '                </tr>');
               }
               starting_inquiry_limit=parseInt(starting_inquiry_limit,10)+<?php echo DEFAULT_DATA_LIMIT?>;
           },
            error: function (error) {
                console.log(error);
            }
        });
    });

</script>



