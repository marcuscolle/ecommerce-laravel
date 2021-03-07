@include('layouts.admin')
@yield('center')


<div class="container my-4">
    <hr class="my-4">

<p> Yearly Earnings </p>

    <hr class="my-4">

<div>
  <canvas id="pieChart" style="max-width: 500px;"></canvas>
</div>
</div>



<script>
//pie
var ctxP = document.getElementById("pieChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
  type: 'bar',
  
  data: {
    labels: ["2021"],
   
    datasets: [{
      data: [ {{ $earnings }}],

      backgroundColor: ["#0DDDFD"],
      hoverBackgroundColor: ["#0FC6E2"]
    }]
  },
  options: {
    responsive: true
  }
});

</script>
