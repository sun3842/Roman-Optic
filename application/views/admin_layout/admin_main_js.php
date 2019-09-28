<script type="text/javascript" rel="script">

    $('.btn-sidebar-show').click(function () {
        $('.sidebar').css('display','block');
    });
    $('.btn-sidebar-close').click(function () {
        $('.sidebar').css('display','none');
    });


    $('#language').change(function () {
        var val=$(this).val();
        var url=$(this).attr('about');
        var location=$(this).attr('role');
        window.location.href=url+val+'/'+location;
    });

</script>