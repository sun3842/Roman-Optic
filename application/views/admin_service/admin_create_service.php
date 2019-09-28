<style type="text/css" rel="stylesheet">

    .row>div{
        margin: 4px 0 12px 0;
    }


</style>

<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <form id="service_form" method="POST" enctype="multipart/form-data">

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading "><?php echo $this->lang->line('service');?></label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i><?php echo $this->lang->line('back');?></a>
        </div>
    </div>

    <label class="page-heading"><?php echo $this->lang->line('create_service');?></label>

    <div class="row">
        <div class="col-12">
            <label class="text-small"><?php echo $this->lang->line('service_name');?><span class="text-red">*</span></label>
            <input type="text" name="service_name" id="service_name" class="form-control">
        </div>

       

          <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <label class="text-small"><?php echo $this->lang->line('choose_picture');?></label>
            <div class="input-group mb-3">
                <input type="text"  class="form-control " style="font-size: small;" placeholder="CHOOSE A SERVICE ICON" disabled="">
            <div>

                <label for="service_image"  class="btn-paste btn btn-block"><i class="fas fa-image "></i><?php echo $this->lang->line('upload');?></label>
                <input type="file" class="collapse " id="service_image" name="service_image" onchange="openFile(event)">

            </div>

            <div class="col-12 box-off-white ">
                    <div class="row" id="upload_display_images" >

                       <div >
                           
                                  
                       </div>

                    </div>
                </div>

            </div>

        </div>



         <div class="col-12">
            <label class="text-small"><?php echo $this->lang->line('short_description');?><span class="text-red">*</span></label>
            <textarea name="service_description" id="service_description"></textarea>
        </div>


        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <button type="submit" class="btn-common"><?php echo $this->lang->line('confirm');?></button>
        </div>

    </div>

    </form>
    
</div>        

       
 
<script type="text/javascript">


var cancel = document.getElementById('cancel')
var openFile = function(event)

{
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function()
    {
    
        var dataURL = reader.result;
        var output = document.getElementById('output')
        output.src = dataURL; 

        output.style.display = "block";
        cancel.style.display = "block";

    };

    reader.readAsDataURL(input.files[0]);

};



   $('#cancel').click(function(e)
        {
           $('#inputImage').val("");
           $('#output').attr("src"," ");

           output.style.display = "none";
           cancel.style.display = "none";
        })


   var openFile = function(event) {
        var input = event.target;
        $('#upload_display_images').empty();
        var filesAmount = input.files.length;

        

        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            

            reader.onload = function(event) {

                $("<button type='button' onclick='remove_img(this)' class='btn btn-danger'><?php echo $this->lang->line('delete');?></button>");
                $('#upload_display_images').append("<div class='col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 pl-3 pb-4 photo-size'>" +
                    "<img src='"+event.target.result+"' width='100%' id='output'><button type='button' id= del onclick='remove_img()' class='btn btn-danger'><?php echo $this->lang->line('delete');?></button></div>");

            }

            reader.readAsDataURL(input.files[i]);
        }
  

    };

    function remove_img(){

       var output = document.getElementById('output')
       var del = document.getElementById('del')

        $('#service_image').val("");
        $('#output').attr("src"," ");
        output.style.display = "none";
        del.style.display = "none";

    }

 
</script>