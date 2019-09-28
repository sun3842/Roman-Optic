<script type="text/javascript" rel="script">

    var stating_product_list= '<?php echo DEFAULT_DATA_LIMIT ?>';

    $('.date-time-picker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });


    function product(product_id,event) {
        event.preventDefault();

        var all_index_array = p_same_id_index[product_id].split(',');

        var p_name=all_products_array[all_index_array[0]]['product_name'];
        var p_unique_id=all_products_array[all_index_array[0]]['product_unique_id'];
        var c_name=all_products_array[all_index_array[0]]['category_name']===null && all_products_array[all_index_array[0]]['category_name']==null && all_products_array[all_index_array[0]]['category_name']===undefined?"":all_products_array[all_index_array[0]]['category_name'];
        var p_last_display_date=all_products_array[all_index_array[0]]['product_last_displaying_date'] !== null && all_products_array[all_index_array[0]]['product_last_displaying_date'] !== undefined && all_products_array[all_index_array[0]]['product_last_displaying_date'] !="0000-00-00"?all_products_array[all_index_array[0]]['product_last_displaying_date']:"";
        var p_price=all_products_array[all_index_array[0]]['product_price']!=null && all_products_array[all_index_array[0]]['product_price'] !== undefined && all_products_array[all_index_array[0]]['product_price'] !="0"? all_products_array[all_index_array[0]]['product_price'] :"";
        var p_details=all_products_array[all_index_array[0]]['product_description'];
        var p_tags=all_products_array[all_index_array[0]]['product_tags']!=null && all_products_array[all_index_array[0]]['product_tags']!==null && all_products_array[all_index_array[0]]['product_tags']!==undefined?all_products_array[all_index_array[0]]['product_tags']:"";

       //checking attributes

        var attributes="";
        var array_attr_ids=new Array();
        for (var j = 0; j < all_index_array.length ; j++)
        {
            if(all_products_array[all_index_array[j]]['product_attributes_id']!=null && array_attr_ids.indexOf(all_products_array[all_index_array[j]]['product_attributes_id']) < 0)
            {

                array_attr_ids.push(all_products_array[all_index_array[j]]['product_attributes_id']);

                attributes=attributes+"<p>"+all_products_array[all_index_array[j]]['product_attributes_name']+": "+all_products_array[all_index_array[j]]['product_attributes_values']+"</p>";

            }
        }
        //checking images
        var images="";
        var array_img_ids=new Array();
        for (var i = 0; i < all_index_array.length; i++)
        {
            if(all_products_array[all_index_array[i]]['product_image_id']!=null && array_img_ids.indexOf(all_products_array[all_index_array[i]]['product_image_id']) < 0 && all_products_array[all_index_array[i]]['product_image_active']!=0)
            {
                array_img_ids.push(all_products_array[all_index_array[i]]['product_image_id']);

                if(all_products_array[all_index_array[i]]['product_image_is_display']==1)
                {
                    images=images+"<div class='col-12'>"+
                        "<img class='img-product' src='<?php echo base_url();?>"+all_products_array[all_index_array[i]]['product_image_location']+"'>"+
                        "</div>";
                }
//                else
//                {
//                    images=images+"<div class='col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4'>"+
//                        "<img class='img-product' src='<?php //echo base_url();?>//"+all_products_array[all_index_array[i]]['product_image_location']+"'>"+
//                        "</div>";
//                }

            }
        }

//         var more_images="";
        array_img_ids=new Array();
        for (var i = 0; i < all_index_array.length; i++)
        {
            if(all_products_array[all_index_array[i]]['product_image_id']!=null && array_img_ids.indexOf(all_products_array[all_index_array[i]]['product_image_id']) < 0 && all_products_array[all_index_array[i]]['product_image_active']!=0)
            {
                array_img_ids.push(all_products_array[all_index_array[i]]['product_image_id']);

//                if(all_products_array[all_index_array[i]]['product_image_is_display']==1)
//                {
//                    images=images+"<div class='col-12'>"+
//                        "<img class='img-product' src='<?php //echo base_url();?>//"+all_products_array[all_index_array[i]]['product_image_location']+"'>"+
//                        "</div>";
//                }
                if(all_products_array[all_index_array[i]]['product_image_is_display']==0)
                {
//                    alert(all_products_array[all_index_array[i]]['product_image_location']);
                    images=images+"<div class='col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4'>"+
                        "<img class='img-product' src='<?php echo base_url();?>"+all_products_array[all_index_array[i]]['product_image_location']+"'>"+
                        "</div>";
                }

            }
        }


        //Product offer
        var price_offer="Euro ";
        if(all_products_array[all_index_array[0]]['product_has_offer']==1)
        {
            if(all_products_array[all_index_array[0]]['product_offer_current_price']!=null && all_products_array[all_index_array[0]]['product_offer_current_price']!=0 )
            {
                price_offer=price_offer+all_products_array[all_index_array[0]]['product_offer_current_price'];
            }
            if(all_products_array[all_index_array[0]]['product_offer_price_percentage']!=null && all_products_array[all_index_array[0]]['product_offer_price_percentage']!=0 )
            {
                price_offer=price_offer+all_products_array[all_index_array[0]]['product_offer_price_percentage'];
            }
            if(all_products_array[all_index_array[0]]['product_offer_starting_date_time']!=null)
            {
                var db_date_time = all_products_array[all_index_array[0]]['product_offer_starting_date_time'].split(/[- :]/);
                price_offer=price_offer+" <br/> "+db_date_time[2]+"-"+db_date_time[1]+"-"+db_date_time[0]+" "+db_date_time[3]+":"+db_date_time[4]+" <b>-</b>";

            }
            if(all_products_array[all_index_array[0]]['product_offer_ending_date_time']!=null)
            {
                var db_date_time = all_products_array[all_index_array[0]]['product_offer_ending_date_time'].split(/[- :]/);
                price_offer=price_offer+db_date_time[2]+"-"+db_date_time[1]+"-"+db_date_time[0]+" "+db_date_time[3]+":"+db_date_time[4];

            }
        }

        $('#product_full_details').empty();

        var p_all_details= " <div class='col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6'>"+
            "<div class='row'>"+images+

            "</div>"+
            "</div>"+
            "<div class='col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6'>"+
            "<h4 id='product_title'>"+p_name+"</h4>"+
        "<p>"+p_unique_id+"</p>"+
        "<p><?php echo $this->lang->line('category')?>: <span>"+c_name+"</span></p>"+
        "<p><?php echo $this->lang->line('product_display_duration')?> : <span><strong>"+p_last_display_date+"</strong> </span></p>"+
        "<p class='text-paste'>PRICE:"+p_price+"</p>"+
        "<p><?php echo $this->lang->line('reduce_price')?>: <span>"+price_offer+"</span></p>"+

        "<p class='text-paste'><?php echo $this->lang->line('attribute')?></p>"+attributes+
        "</div>"+
        "<div class='col-12'>"+
            "<p class='text-justify'>"+p_details+"</p>"+
        "</div>"+
        "<div class='col-12'>"+
            "<p><strong>#<?php echo $this->lang->line('tag')?>:</strong> <label><span class='p-1'>"+p_tags+"</span> </label></p>"+
        "<p><strong><?php echo $this->lang->line('share')?>:</strong> <label></label></p>"+
        "<p><strong><?php echo $this->lang->line('shareable_link')?>:</strong> <label></label></p>"+
        "<div class='row'>"+
            "<div class='col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8'>"+
            "<input type='text' value='' id='clip_board_text' class='clip-board-text'>"+
            "<label class='text-red' style='font-size: small'><i>(<?php echo $this->lang->line('click_the_copy_link_button_get_the_shareable_link')?>)</i></label>"+
        "</div>"+
        "<div class='col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4' id='copy'>"+
            "<a href='#' id='clip_board_btn' class='clip-board-btn '><?php echo $this->lang->line('copy_link')?></a>"+
        "</div>"+
        "</div>"+
        "</div>"+
        "</div>";



        $('#product_full_details').append(p_all_details);
        $('#product_modal').modal('show');
    }
    function test()
    {
        alert("Hi"); $('#product_modal').modal('show');
    }

    function product_obj(product,event) {
        event.preventDefault();
//        $('#product_title').html(product.product_name);
        console.log(product);
        $('#product_modal').modal('show');
    }

    $('body').on('click','.clip-board-btn',function () {
        var copyText = document.getElementById("clip_board_text");
        copyText.select();
        document.execCommand("copy");
    });


    $('#load_more_product').click(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo uri_string()?>',
            data: {starting_limit : stating_product_list},
            success: function (result) {
                var temp_serial=stating_product_list;
                var product=$.parseJSON(result);
                var total_product=product.length;
//                console.log(product[0]);
                var last_product_id=0;

                for (var i=0;i<total_product;i++ ){

                    all_products_array[index]=product[i];
                    if(last_product_id==product[i]['product_id'])
                    {
                        p_same_id_index[product[i]['product_id']]=p_same_id_index[product[i]['product_id']]+","+index.toString();

                        index=index+1;
                        continue;
                    }
                    last_product_id=product[i]['product_id'];
                    p_same_id_index[product[i]['product_id']]=index.toString();
                    index=index+1;
                    var product_category='';
                    var product_sub_category='';
                    if(product[i]["category_name"]!=undefined && product[i]["category_name"]!=null)
                    {
                        product_category=product[i]["category_name"];
                    }
                    if(product[i]["subcategory_name"]!=undefined && product[i]["subcategory_name"]!=null)
                    {
                        product_sub_category=product[i]["subcategory_name"];
                    }
                    $('#product_table').find('tbody').append("  <tr>\n" +
                        "            <td>"+(parseInt(temp_serial,10)+1)+"</td>\n" +
                        "            <td>"+product[i]["product_unique_id"]+"</td>\n" +
                        "            <td>"+product[i]["product_name"]+"</td>\n" +
                        "            <td><a class='category' href='#'>"+product_category+"</a></td>\n"+
                        "            <td>"+product_sub_category+"</td>\n" +
                        "            <td>\n" +
                        "\t\t\t\t<a href='#' class='action action-view product' onclick='product("+product[i]['product_id']+",event)'><i class='fas fa-eye'></i></a>\n" +
                        "                <a href='<?php echo site_url('edit_product/')?>"+product[i]['product_id']+"' class='action action-edit'><i class='far fa-edit'></i></a>\n" +
                        "                <a href='#' class='action action-delete' onclick='delete_product("+product[i]['product_id']+",event)'><i class='far fa-trash-alt'></i></a>\n" +
                        "            </td>\n" +
                        "      </tr>");
                    temp_serial=parseInt(temp_serial)+1;
                }
                stating_product_list=parseInt(stating_product_list,10)+<?php echo DEFAULT_DATA_LIMIT?>;

            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    function delete_product(product_id,event) {
        event.preventDefault();
        $('#btn_delete_product').attr('href','<?php echo site_url('delete_product/')?>'+product_id);
        $('#delete_product_modal').modal("show");
    }

    function product_obj23(product,event) {
        event.preventDefault();
//        $('#product_title').html(product.product_name);
        console.log(product);
        $('#product_modal').modal('show');
    }

</script>