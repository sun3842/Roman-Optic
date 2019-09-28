<style type="text/css" rel="stylesheet">
    .box-white{
        display: block;
        background-color: white;
    }
    .icon-lg{
        font-size: 50px;
    }
</style>
<div class="content">

    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row my-3">
       <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3 p-5">
           <div class="box-white py-5 text-center">
               <i class="far fa-heart icon-lg text-paste"></i>
               <label class="font-color label-block font-weight-bold">LIKES</label>
               <h4>2346</h4>
               <small class="label-block font-color">475 this Month</small>
           </div>

       </div>
        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3  p-5">

            <div class="box-white py-5 text-center">
                <i class="far fa-heart icon-lg text-paste"></i>
                <label class="font-color label-block font-weight-bold">LIKES</label>
                <h4>2346</h4>
                <small class="label-block font-color">475 this Month</small>
            </div>

        </div>
        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3  p-5">

            <div class="box-white py-5 text-center">
                <i class="far fa-heart icon-lg text-paste"></i>
                <label class="font-color label-block font-weight-bold">LIKES</label>
                <h4>2346</h4>
                <small class="label-block font-color">475 this Month</small>
            </div>

        </div>
        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3  p-5">

            <div class="box-white py-5 text-center">
                <i class="far fa-heart icon-lg text-paste"></i>
                <label class="font-color label-block font-weight-bold">LIKES</label>
                <h4>2346</h4>
                <small class="label-block font-color">475 this Month</small>
            </div>

        </div>
    </div>

    <div class="row my-3">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <canvas id="myChart" class="form-control"  style="width: 100%;!important;height: 500px"></canvas>
        </div>
    </div>
</div>


<script type='text/javascript' rel="script" src="<?php echo site_url('assets/app_assets/plugins/chart.js')?>"></script>
<script type="text/javascript" rel="script">

    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: '# of Download',
                data: [12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1],
                backgroundColor: ['transparent'],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                xAxes: [{
                    ticks: {
                        maxRotation: 90,
                        minRotation: 80
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

</script>