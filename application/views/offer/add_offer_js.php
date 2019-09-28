<script type="text/javascript" rel="script">

    $('.date-time-picker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });

    $('.date-time').datetimepicker({
        timepicker: true,
    });



    $(function () {
        $("#slider-range").slider({
            range: true,
            min: 1,
            max: 100,
            values: [10, 60],
            slide: function (event, ui) {
                $("#age_limit").val(" " + ui.values[0] + " - " + ui.values[1]);
            }
        });
        $("#age_limit").val(" " + $("#slider-range").slider("values", 0) +
            " - " + $("#slider-range").slider("values", 1));
    });

    $('.btn-offer-option').click(function () {
        $('.btn-offer-option').removeClass('offer-active');
        $(this).addClass('offer-active');
        var name=$(this).attr('name');
        if(name=='btn_target_offer'){
            $('#div_offer_target').css('display','block');
            $('#btn_offer_form_submit').attr('name','submit_target_offer');
        }
        else
        {
            $('#div_offer_target').css('display','none');
            $('#btn_offer_form_submit').attr('name','submit_general_offer');
        }
    });


    var openFile = function(event) {
        event.preventDefault();
        var input = event.target;


        var filesAmount = input.files.length;

        var reader = new FileReader();

        function readFiles(fileIndex)
        {
            if(fileIndex>=filesAmount)
            {
                return;
            }
            reader.onload = function(event) {
                event.preventDefault();

                $('#upload_display_images').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4 pip'><img src='"+event.target.result+"' width='100%'><span  class='btn btn-danger single_remove_"+fileIndex+"' style='width: 100%;display: block;' ><?php echo $this->lang->line('delete') ?></span></div>");
                $('#upload_display_images').append("<input type='hidden' id='single_image_deleted_"+fileIndex+"' name='single_image_deleted_"+fileIndex+"' value='0'>");
                $(".single_remove_"+fileIndex).click(function(){
                    $(this).parent(".pip").remove();

                    $('#single_image_deleted_'+fileIndex).val('1');
                });

                readFiles(fileIndex+1)
            }
            reader.readAsDataURL(input.files[fileIndex]);

        }

        readFiles(0);
    };



    var openFileMultiple=function (event) {
        event.preventDefault();
        var input = event.target;


        var filesAmount = input.files.length;

        var reader = new FileReader();

        function readFiles(fileIndex)
        {
            if(fileIndex>=filesAmount)
            {
                return;
            }
            reader.onload = function(event) {
                event.preventDefault();

                $('#upload_more_images').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4 pip'><img src='"+event.target.result+"' width='100%'><span  class='btn btn-danger remove_"+fileIndex+"' style='width: 100%;display: block;' ><?php echo $this->lang->line('delete') ?></span></div>");
                $('#upload_more_images').append("<input type='hidden' id='image_deleted_"+fileIndex+"' name='image_deleted_"+fileIndex+"' value='0'>");
                $(".remove_"+fileIndex).click(function(){
                    $(this).parent(".pip").remove();

                    $('#image_deleted_'+fileIndex).val('1');
                });

                readFiles(fileIndex+1)
            }
            reader.readAsDataURL(input.files[fileIndex]);

        }

        readFiles(0);
    };





    function remove_img(number) {
        alert(number);
    }


//******************************************for auto complete **********************************


    selected_product_name=null;
    selected_product_id=null;
    availableTags = [
        { label: "HTML", value: "Hypertext Markup Language"}, { label: "CSS", value: "Cascading Style Sheets"}
    ];
    function offer_product() {
        $( "#offer_products_search" ).autocomplete({
            source: availableTags,
            select: function (event, ui) {
                this.value = ui.item.label;
                selected_product_name=ui.item.label;
                selected_product_id=ui.item.value;
                return false;
            }
        });
    }
    $('#offer_products_search').keyup(function () {
            var product_name=$(this).val();
            if(product_name!=''){
                $.ajax({
                    url: '<?php echo uri_string();?>',
                    type: 'POST',
                    data:{product: product_name},
                    success: function (result) {
                        products=$.parseJSON(result);
                        total_product=products.length;
                        availableTags=[];
                        for(var i=0; i<total_product;i++){
                            availableTags.push({label: products[i]['product_name'], value: products[i]['product_id']});
                        }
                        offer_product();


                    },
                    error: function (error) {
                        alert(error);
                    },
                });
            }


    });

    $('body').on('click','.btn-delete-product-offer',function () {
        $(this).parent().remove();
    });


    $('#btn_add_offer_product').click(function () {
        if(selected_product_name!=null && selected_product_id!=null){
            $('#product_list').append('<li><label>'+selected_product_name+'</label>\n' +
                '                        <button class="action action-delete float-right btn-delete-product-offer"><i class="far fa-trash-alt"></i></button>\n' +
                '                        <input type="hidden" name="offer_products[]" value="'+selected_product_id+'"></li>');
            selected_product_id=null;
            selected_product_name=null;
            $('#offer_products_search').val('');
        }
    });
    //************************************************************************auto complete end************************************************


    $('#is_target_gender').change(function () {
        if($(this).prop('checked')==true)
        {
            $('.target-gender-type').prop('disabled',false);
        }
        else
        {
            $('.target-gender-type').prop('disabled',true);
            $('.target-gender-type').prop('checked',false);
        }
    });
    $('#is_target_city').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#city_id').prop('disabled',false);
        }
        else
        {
            $('#city_id').prop('disabled',true);
        }
    });
    $('#is_target_occupation').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#occupation_id').prop('disabled',false);
        }
        else
        {
            $('#occupation_id').prop('disabled',true);
        }
    });
    $('#is_target_age_limit').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#age_limit').prop('disabled',false);
        }
        else
        {
            $('#age_limit').prop('disabled',true);
        }
    });
    $('#is_target_birthday').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#birthday').prop('disabled',false);
        }
        else
        {
            $('#birthday').prop('disabled',true);
        }
    });
    $('#is_target_marital_status').change(function () {
        if($(this).prop('checked')==true)
        {
            $('#marital_status').prop('disabled',false);
        }
        else
        {
            $('#marital_status').prop('disabled',true);
        }
    });
    jQuery.validator.addMethod("greaterThan", function(value, element, params) {
        if ($(params[0]).val() != '') {
            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params[0]).val());
            }
            return isNaN(value) && isNaN($(params[0]).val()) || (Number(value) > Number($(params[0]).val()));
        };
        return true;
    },'Must be greater than {1}.');

    $('#form_offer').validate({
        rules: {
            offer_title:{
                required: true,
            },
            offer_description: {
                required: true
            },
            offer_end_date_time: {
                greaterThan: ["#offer_start_date_time","Start Date"]
            }
        },
        messages: {
            offer_title: 'Offer Title Is Required',
        }
    });


    function get_all_cities() {
        $.ajax({
            url:'<?php echo site_url('get_all_city')?>',
            type: 'GET',
            success: function (result) {
//                alert(result);
                var cities=$.parseJSON(result);
                var total_cities=cities.length;
                for (var i=0;i<total_cities;i++){
                    $('#city_id').append('<option value="'+cities[i]['cities_id']+'">'+cities[i]['cities_name']+'</option>');
                }

            },
            error: function (error) {
                alert(error);
            }
        });
    }
    get_all_cities();

</script>