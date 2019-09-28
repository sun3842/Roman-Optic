<style type="text/css" rel="stylesheet">
    .btn-md-circle{
        height: 35px;
        width: 35px;
        border-radius: 20px;
    }

    .btn-social{
        background: transparent;
        border: 1px solid #515151;
        color: #515151;
    }
    .btn-social.btn-active{
        background-color: #34CAA7;
        border: none;
        color: white;
    }
    .social-site .btn-social{
        margin: 0 10px 0 10px;
    }
    .div-paste{
        background-color: #35C9A7;
        color: white;
        padding: 15px 10px 15px 10px;
    }

    table>thead>tr{
        color: #35C9A7;
        background-color: transparent;
    }

</style>
<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading">CONTACT US</label>
            <a href="#" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> BACK</a>
        </div>
    </div>

    <div class="row">
        <h3 class="mb-5">ADD CONTACT</h3>

        <div class="col-12 my-3">
            <label>SHOP/ORGANIZATION NAME<span class="text-red"><b>*</b></span></label>
            <input type="text" class="form-control">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>SHOP REGISTER NO.</label>
            <input type="text" class="form-control">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>BRANCH</label>
            <input type="text" class="form-control">
        </div>

        <div class="col-12 my-3">
            <label>ABOUT SHOP<span class="text-red"><b>*</b></span></label>
            <textarea></textarea>
        </div>
        <div class="col-12">
            <h5 class="my-3">LOCATION</h5>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>COUNTRY</label>
            <select>
                <option value=""></option>
            </select>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>REGION</label>
            <select>
                <option value=""></option>
            </select>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>CITY</label>
            <select>
                <option value=""></option>
            </select>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 my-3">
            <label>ADDRESS</label>
           <input type="text" class="form-control">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>POST CODE</label>
           <input type="text" class="form-control">
        </div>

        <div class="col-12">
            <h5 class="my-3">CONTACT</h5>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>PHONE</label>
            <select>
                <option value=""></option>
            </select>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>EMAIL</label>
            <input type="email" class="form-control">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 my-3">
            <label>WEBSITE</label>
            <input type="text" class="form-control">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 my-3">
            <label class="label-block">SHARE ON SOCIAL MEDIA</label>
            <div class="social-site">
                <button class="btn-md-circle btn-social btn-active"><i class="fab fa-facebook-f"></i></button>
                <button class="btn-md-circle btn-social btn-active"><i class="fab fa-twitter"></i></button>
                <button class="btn-md-circle btn-social"><i class="fab fa-google-plus-g"></i></button>
            </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 my-3">
            <label>EMAIL</label>
            <input type="text" class="form-control">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 my-5">
            <button class="btn-off-white btn-block py-2">ADD</button>
        </div>

        <div class="col-12">
            <h5 class="my-3">SET SCHEDULE</h5>
        </div>
        <div class="col-12 div-paste">
            <div class="row">
                <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <select>
                        <option>SELECT DAY</option>
                    </select>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <select>
                        <option>OPEN</option>
                    </select>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
                   <input type="time" class="form-control time-picker" placeholder="START TIME">
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <input type="time" class="form-control time-picker" placeholder="END TIME">
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <button class="btn btn-block">ADD</button>
                </div>

            </div>
        </div>
        <div class="col-12 table-responsive my-3">
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>DAY</th>
                            <th>STATUS</th>
                            <th>START</th>
                            <th>END</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>MON</td>
                        <td>OPEN</td>
                        <td><span>9 AM</span> <br/><span>2PM</span></td>
                        <td><span>3 PM</span> <br/><span>12PM</span></td>
                        <td>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                            <br>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>TUE</td>
                        <td>OPEN</td>
                        <td><span>9 AM</span> <br/><span>2PM</span></td>
                        <td><span>3 PM</span> <br/><span>12PM</span></td>
                        <td>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                            <br>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>WED</td>
                        <td>OPEN</td>
                        <td><span>9 AM</span> <br/><span>2PM</span></td>
                        <td><span>3 PM</span> <br/><span>12PM</span></td>
                        <td>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                            <br>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>THURS</td>
                        <td>OPEN</td>
                        <td><span>9 AM</span> <br/><span>2PM</span></td>
                        <td><span>3 PM</span> <br/><span>12PM</span></td>
                        <td>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                            <br>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>FRI</td>
                        <td>OPEN</td>
                        <td><span>9 AM</span> <br/><span>2PM</span></td>
                        <td><span>3 PM</span> <br/><span>12PM</span></td>
                        <td>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                            <br>
                            <a href="#" class="action action-edit"><i class="far fa-edit"></i></a>
                            <a href="#" class="action action-delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    </tbody>
            </table>
        </div>

        <div class="col-12 text-center">
            <button class="btn-common">CONFIRM</button>
        </div>
    </div>
</div>
<script type="text/javascript" rel="script"
        src="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.full.js') ?>"></script>
<script type="text/javascript" rel="script">


</script>