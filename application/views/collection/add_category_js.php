<script type="text/javascript" rel="script">
    var selected_category=0;
    $('#div_category_list').on('click','.category-list',function (event) {
        event.preventDefault();
        $('.category-list').each(function () {
            $(this).removeClass('category-list-active');
        });
        selected_category=$(this).attr('role');
        $('#div_sub_category_list').empty();
        $(this).addClass('category-list-active');
        $.ajax({
            url: '<?php echo uri_string();?>',
            type: 'POST',
            data: {category_id: selected_category},
            success: function (result) {
                var subcategories=$.parseJSON(result);
                var num_subcategories=subcategories.length;
                for (var temp=0;temp<num_subcategories;temp++){
                    $('#div_sub_category_list').append('<a href="#" class="sub-category-list" role="'+subcategories[temp]['subcategory_id']+'">'+subcategories[temp]['subcategory_name']+'</a>');
                }
            },
            error: function (error) {
                alert(error);
            },
        });

    });

    $('#btn_add_category').click(function () {
        var ctg_name=$('#text_add_category').val();
        if(ctg_name==''){
            $('#text_msg_add_category').html('<?php echo $this->lang->line('please_enter_new_category_name')?>');
        }
        else {
            $.ajax({
                url: '<?php echo uri_string();?>',
                type: 'POST',
                data: {new_category_name: ctg_name},
                success: function (result) {
                    if(result==-1){
                        $('#text_msg_add_category').html('<?php echo $this->lang->line('category_name_already_exist')?>');
                    }
                    else if(result==0){
                        $('#text_msg_add_category').html('<?php echo $this->lang->line('category_add_failed')?>');
                    }
                    else {
                        $('#text_msg_add_category').html('');
                        $('#div_category_list').append('<a href="#" class="category-list" role="'+result+'">'+ctg_name+'</a>');
                        $('#text_add_category').val('');
                    }
                },
                error: function (error) {
                    
                },
            });
        }
    });


    $('#btn_add_sub_category').click(function () {
        var sub_ctg_name=$('#text_add_sub_category').val();
        if(selected_category==0){
            $('#text_msg_add_sub_category').html('<?php echo $this->lang->line('please_select_category_first')?>');
        }
        else if(sub_ctg_name==''){
            $('#text_msg_add_sub_category').html('<?php echo $this->lang->line('please_enter_new_sub_category_name')?>');
        }
        else {
            $.ajax({
                url: '<?php echo uri_string();?>',
                type: 'POST',
                data: {new_sub_category_name: sub_ctg_name, category: selected_category},
                success: function (result) {
//                    alert(result);
                    if(result==-1){
                        $('#text_msg_add_sub_category').html('<?php echo $this->lang->line('sub_category_name_already_exist')?>');
                    }
                    else if(result==0){
                        $('#text_msg_add_sub_category').html('<?php echo $this->lang->line('sub_category_add_failed')?>');
                    }
                    else {
                        $('#text_msg_add_sub_category').html('');
                        $('#div_sub_category_list').append('<a href="#" class="sub-category-list" role="'+result+'">'+sub_ctg_name+'</a>');
                        $('#text_add_sub_category').val('');
                    }
                },
                error: function (error) {

                },
            });
        }
    });

</script>