<script type="text/javascript" rel="script">

    $('.date-time-picker').datetimepicker({
        timepicker: true,

    });


    function eventDetails(id) {
        $('#product_modal').modal('show');
    }


    /*var openFile = function(event) {
        var input = event.target;
        $('#upload_display_images').empty();
        var filesAmount = input.files.length;



        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();


            reader.onload = function(event) {

                $('#upload_display_images').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4'><img src='"+event.target.result+"' width='100%' id='output'></div>");

            }

            reader.readAsDataURL(input.files[i]);
        }


    };*/



    var openFile = function(event) {
        event.preventDefault();
        var input = event.target;


        $('#upload_display_images').empty();
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

        $('.pip').css('display','none');
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
















    /*var openFileMultiple=function (event) {
        var input = event.target;
        $('#upload_more_images').empty();
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                $('#upload_more_images').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4'><img src='"+event.target.result+"' width='100%'></div>");
            }


            reader.readAsDataURL(input.files[i]);
        }
    };*/


    $('#event_country').change(function () {
        var country_id=$(this).val();
        $('#event_region').children('option:not(:first)').remove();
        $('#event_region').trigger('change');
        if(country_id!='')
        {

            $('#event_region').attr('disabled',false);
            $.ajax({
                url:'<?php echo site_url("event_states_with_country_id")?>',
                type: 'POST',
                data: {country:country_id},
                success: function (result) {
                    var regions = $.parseJSON(result);
                    var total_regions = regions.length;
                    for (var i = 0; i < total_regions; i++) {
                        $('#event_region').append('<option value="' + regions[i]['states_id'] + '">' + regions[i]['states_name'] + '</option>');
                    }
                },
                error: function (error) {

                }
            });
        }
        else
        {
            $('#event_region').attr('disabled',true);
        }
    });


    $('#event_region').change(function () {
        var states_id=$(this).val();
        $('#event_city').children('option:not(:first)').remove();
        if(states_id!='')
        {
            $('#event_city').attr('disabled',false);
            $.ajax({
                url:'<?php echo site_url("event_cities_with_state_id")?>',
                type: 'POST',
                data: { state :states_id},
                success: function (result) {
                    var cities = $.parseJSON(result);
                    var total_regions = cities.length;
                    for (var i = 0; i < total_regions; i++) {
                        $('#event_city').append('<option value="' + cities[i]['cities_id'] + '">' + cities[i]['cities_name'] + '</option>');
                    }
                },
                error: function (error) {

                }
            });
        }
        else
        {
            $('#event_city').attr('disabled',true);
        }
    });

    $('.delete-img').click(function () {
        var img_id=$(this).attr('content');
        $(this).parent().remove();
        $.ajax({
            url:'<?php echo site_url("remove_event_img")?>',
            type: 'POST',
            data: { image_id :img_id},
            success: function (result) {
                if(result==1)
                {
                    console.log('deleted');
                }
               else if(result==-1)
               {
                   console.log('image Not Found');
               }
            },
            error: function (error) {
                console.log(error);
            }
        });
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
    $('#form_event').validate({
        rules: {
            event_name: {
                required: true,
            },
            event_details: {
                required: true,
            },
            event_end_time: {
                greaterThan: ["#event_start_time","Start Date"]
            }

        }
    });
</script>