<script type="text/javascript" rel="script">
    $('.date-time-picker').datetimepicker({
    });
    $('.date-picker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });
    $('#product_category').change(function () {
        if ($(this).val() == '') {
            $('#product_subcategory').children('option:not(:first)').remove();
            $('#product_subcategory').prop("disabled", true);
            $('#product_subcategory').removeClass("product-category");
        }
        else {
            selected_category_id=$(this).val();
            $('#product_subcategory').children('option:not(:first)').remove();
//            alert(category_id);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('add_product');?>',
                data: { category_id:selected_category_id},
                success: function (result) {
//                   alert(result);
                    subcategories=$.parseJSON(result);
                    totat_subcategory=subcategories.length;
                    for (var i=0;i<totat_subcategory;i++){
                        $('#product_subcategory').append('<option value="'+subcategories[i]['subcategory_id']+'">'+subcategories[i]['subcategory_name']+'</option>');
                    }
                    $('#product_subcategory').prop("disabled", false);
                    $('#product_subcategory').addClass("product-category");
                },
                error: function (error) {
                    console.log(error);
                }

            });
        }
    });

    $('#btn_add_new_attr').click(function () {
        $('#product_attr').append(' <div class="row mt-3 p-2">\n' +
            '\n' +
            '                    <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">\n' +
            '                        <label><?php echo $this->lang->line('attribute_name')?></label>\n' +
            '                        <input type="text" class="form-control" name="product_attr_name[]" required>\n' +
            '                    </div>\n' +
            '                    <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">\n' +
            '                        <label><?php echo $this->lang->line('attribute_value')?></label>\n' +
            '                        <input type="text" class="form-control" name="product_attr_value[]" required>\n' +
            '                        <label class="text-red"><?php echo $this->lang->line('if_more_seperate_with_coma')?>(,)</label>\n' +
            '                    </div>\n' +
            '                    <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-4">\n' +
            '                        <button class="btn btn-danger btn-block mt-2 btn-attr-remove" type="button"><?php echo $this->lang->line('remove')?></button>\n' +
            '                    </div>\n' +
            '            </div>');
    });



    $('#product_attr').on('click','.btn-attr-remove',function () {
        $(this).parent().parent().remove();

    });


    $('input[type=radio][name=display_product]').change(function () {
        if($(this).val()=='select_p_display_time'){
            $('.select_p_display_time').css('display','block');
            $('.custom_p_display_time').css('display','none');
        }
        else{
            $('.select_p_display_time').css('display','none');
            $('.custom_p_display_time').css('display','block');
        }
    });


    $('input[type=radio][name=product_price]').change(function () {
        if($(this).val()=='no_price'){
            $('.fixed_price').css('display','none');
            $('.custom_price').css('display','none');
            $('#div_offer').css('display','none');
        }
        else if($(this).val()=='fixed_price'){
            $('.fixed_price').css('display','block');
            $('.custom_price').css('display','none');
            $('#div_offer').css('display','block');
        }
        else{
            $('.fixed_price').css('display','none');
            $('.custom_price').css('display','block');
            $('#div_offer').css('display','block');
        }
    });

    $('input[type=radio][name=offer_product]').change(function () {
        if($(this).val()=='select_reduce_price'){
            $('.select_reduce_price').css('display','block');
            $('.custom_reduce_price').css('display','none');
        }
        else{
            $('.select_reduce_price').css('display','none');
            $('.custom_reduce_price').css('display','block');
        }
    });

    $('#product_has_offer').change(function () {
        if($(this).prop('checked')){
            $('.offer-div').css('display','block');

        }
        else{
            $('.offer-div').css('display','none');
        }
    });

//    var dislpay_img_openFile = function (event) {
//        var input = event.target;
//        $('#div_disp_img_preview').empty();
//        var filesAmount = input.files.length;
//
//        for (i = 0; i < filesAmount; i++) {
//            var reader = new FileReader();
//
//            reader.onload = function (event) {
//                $('#div_disp_img_preview').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2'><img src='" + event.target.result + "' width='100%'></div>");
//            }
//
//
//            reader.readAsDataURL(input.files[i]);
//        }
//
//    };
//
//    var more_img_openFile = function (event) {
//        var input = event.target;
////        $('#div_more_img_preview').empty();
//        var filesAmount = input.files.length;
//
//        for (i = 0; i < filesAmount; i++) {
//            var reader = new FileReader();
//
//            reader.onload = function (event) {
//                $('#div_more_img_preview').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 p-2'><img src='" + event.target.result + "' width='100%'></div>");
//            }
//
//
//            reader.readAsDataURL(input.files[i]);
//        }
//
//    };



    //////////////////////////////////////////////////////////////////////
    var dislpay_img_openFile = function(event) {
        event.preventDefault();
        $('#div_disp_img_preview').empty();
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

                $('#div_disp_img_preview').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4 pip'><img src='"+event.target.result+"' width='100%'><span  class='btn btn-danger single_remove_"+fileIndex+"' style='width: 100%;display: block;' ><?php echo $this->lang->line('delete') ?></span></div>");
                $('#div_disp_img_preview').append("<input type='hidden' id='single_image_deleted_"+fileIndex+"' name='single_image_deleted_"+fileIndex+"' value='0'>");
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



    var more_img_openFile=function (event) {
        event.preventDefault();
        var input = event.target;


      $('.pip').css('display','none');
//      alert('hi');
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

                $('#div_more_img_preview').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4 pip'><img src='"+event.target.result+"' width='100%'><span  class='btn btn-danger remove_"+fileIndex+"' style='width: 100%;display: block;' ><?php echo $this->lang->line('delete') ?></span></div>");
                $('#div_more_img_preview').append("<input type='hidden' id='image_deleted_"+fileIndex+"' name='image_deleted_"+fileIndex+"' value='0'>");
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
    //////////////////////////////////////////////////////////////////////


    $('.remove-uploaded-product-img').click(function () {
        var img_id=$(this).attr('content');
        $(this).parent().remove();
        $.ajax({
            url: "<?php echo site_url('edit_product/'.$product_details[0]['product_id']);?>",
            type: 'POST',
            data: {delete_img_id: img_id},
            success: function (result) {
                if(result==-1)
                {
                    alert('Image Not Found');
                }
                else if(result==0)
                {
                    alert('Image Deleted Failed');
                }
            } ,
            error: function (error) {
                alert(error);
            },

        });
    });


    $('#form-product').validate({
        rules: {
            new_product_title: {
                required: true
            },
            p_fixed_price: {
                number: true,
                required: true
            },
            p_custom_price_from: {
                number: true,
                required: true
            },
            p_custom_price_to: {
                number: true,
                required: true
            },
            p_price_abs_reduce: {
                number: true,
                required: true
            },
            p_price_percent_reduce: {
                number: true,
                required: true
            },
        },
        messages: {
            new_product_title: "PRODUCT IS REQUIRED",
        }
    });

</script>