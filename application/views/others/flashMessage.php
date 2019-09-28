<div id="flashmessage">
    <?php if ($this->session->flashdata('message')) {
        ?>
        <div class="alert alert-success" style="text-align: center; font-weight: bold; font-size: 16px">
            <?php echo $this->session->flashdata('message') ?>
        </div>
        <?php
    }if ($this->session->flashdata('error')) {
        ?>
        <div class="alert alert-danger" style="text-align: center; font-weight: bold; font-size: 16px">
            <?php echo $this->session->flashdata('error') ?>
        </div>
        <?php
    }
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#flashmessage').delay(4000).fadeOut();
    });
</script>
