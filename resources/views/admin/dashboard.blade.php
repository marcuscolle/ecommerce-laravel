@include('layouts.admin')
@yield('center')

<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
              <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                  <div class="float-left">
                    <span style="font-size: 70px; color: rgba(10, 150, 33, 0.822);">
                        <i class="fas fa-hand-holding-usd"></i>
                    </span>
                  </div>
                  <div class="float-right">
                    <p class="mb-0 text-right">Earnings</p>
                    <div class="fluid-container">
                      <h3 class="font-weight-medium text-right mb-0">£{{ $earnings }}</h3>
                    </div>
                  </div>
                </div>
                <p>Earning to date</p>
              </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
              <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                  <div class="float-left">
                    <span style="font-size: 70px; color: rgb(253, 234, 60);">  
                        <i class="fas fa-file-invoice"></i>
                    </span>
                  </div>
                  <div class="float-right">
                    <p class="mb-0 text-right">Orders</p>
                    <div class="fluid-container">
                      <h3 class="font-weight-medium text-right mb-0">{{ $order_number }}</h3>
                    </div>
                  </div>
                </div>
                <p>Orders to date</p>
              </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
              <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                  <div class="float-left">
                    <span style="font-size: 70px; color: rgba(9, 159, 197, 0.993);">  
                        <i class="fas fa-users"></i>
                    </span>
                  </div>
                  <div class="float-right">
                    <p class="mb-0 text-right">Customers</p>
                    <div class="fluid-container">
                      <h3 class="font-weight-medium text-right mb-0">{{ $register_users }}</h3>
                    </div>
                  </div>
                </div>
                <p>Customers registered to date</p>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-4">
        <hr class="my-4">

    <p> Sales by Month </p>

        <hr class="my-4">

    <div>
      <canvas id="pieChart" style="max-width: 500px;"></canvas>
    </div>
</div>



<script>
//pie
    var ctxP = document.getElementById("pieChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
      type: 'horizontalBar',
      
      data: {
        labels: ["{{ $graph[0]->month }}", "{{ $graph[1]->month}}"],
       
        datasets: [{
          data: [ {{ $graph[0]->sum }}, {{ $graph[1]->sum }} ],

          backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
          hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
        }]
      },
      options: {
        responsive: true
      }
    });

</script>
