<style type="text/css" rel="stylesheet">

.row>div{
    margin: 4px 0 12px 0;
}


.service_details_text{

   font-weight: bold;
   font-size: small;
   font-weight: bold;
   color: #595959;
}

</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('service_list');?></label>
            <a href="<?php echo site_url('create_service') ?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('create_service');?><?php echo $this->lang->line('back');?></a><a href="<?php echo site_url('create_service') ?>"> <button class="btn-common" style="float: right;"><?php echo $this->lang->line('create_service');?></button></a>
        </div>
    </div>

    <div class="row">



        <div class="col-12 table-responsive ">
            <table class="table table-striped text-center ">
                <thead>
                    <tr>
                       <th><?php echo $this->lang->line('display_photo');?></th>
                       <th><?php echo $this->lang->line('service_name');?></th>
                       <th><?php echo $this->lang->line('action');?></th>
                   </tr>


               </thead>
               <tbody>

                   <?php
                   
                   foreach ($services as $service) {
                      ?>
                      <tr>
                    
                    

                        <td><img width="75px" height="75px" src="<?php if($service['services_image_location'] != "" ){

                             echo base_url($service['services_image_location']);

                        } else{echo "http://placehold.it/75x75&text=PHOTO";}?>"> </td>  



                        <td><?php echo $service['services_name'];?></td>  
                        

                        <td>
                            <a href="#" class="action action-view" onclick='ServiceDetails(<?php echo json_encode($service);?>,event)'><i class="fas fa-eye"></i></a>
                            <a href="<?php echo site_url('edit_service/'.$service["services_id"]) ?>" class="action action-edit" ><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete" onclick='delete_service(<?php echo $service["services_id"]?>,event)'><i class="far fa-trash-alt"></i></a>
                        </td>


                    </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
</div>

   <!-- service view model-->
<div class="modal fade bd-example-modal-lg" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="dialog_header text-align-center" id="exampleModalLongTitle"><center id="service_name"></center></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff">&times;</span>
                </button>
            </div>

            <div class="dialog_margin">

               <div class="col-12">
                <div class="row">
                    <div class="col-12" id="service_img">

                    </div>

                </div>
            </div>

            <div class= "service_details_text p-3" >


                <p class="text-justify" id="s_details">

                </p>

            </div>
        </div>
    </div>
</div>

</div>


<!--delete service-->
<div class="modal fade" id="delete_service_modal" tabindex="-1" role="dialog" aria-labelledby="delete_service_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('delete_service');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo site_url('d')?>">

                <div class="modal-body">
                    <?php echo $this->lang->line('are_you_sure_to_delete_this_service');?>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger" id="btn_delete_service"><?php echo $this->lang->line('delete');?></a>

                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js')?>"></script>


<script type="text/javascript" rel="script">


    function ServiceDetails(service_array,event) {
       // 
       event.preventDefault();
       $('#service_name').html("");
       $('#s_details').html("");
       $('#service_img').html("");
       var img=service_array['services_image_location'];
       $('#service_name').html(service_array['services_name']);
       $('#s_details').html(service_array['services_details']);
       $('#service_img').html('<img width = "50%" class="img-product" src="<?php echo base_url();?>'+img+'">');
       $('#product_modal').modal('show');
   }

   function delete_service(service_id,event) {
    event.preventDefault();
    $('#btn_delete_service').attr('href','<?php  echo site_url('delete_service/')?>'+service_id);
    $('#delete_service_modal').modal("show");
}








</script>



