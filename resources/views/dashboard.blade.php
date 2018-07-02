@extends('admin_template')

@section('content')

<section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Progr/Consult</span>
              <span class="info-box-number">
              @if($consultsmonth > 0)
                {{$rezervmonth/$consultsmonth}}
              @else
                Nu sunt date
              @endif
                <small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-tags"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Programari luna curenta</span>
              <span class="info-box-number">{{$rezervmonth}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-medkit"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Consultatii luna curenta</span>
              <span class="info-box-number">{{$consultsmonth}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pacienti noi luna curenta</span>
              <span class="info-box-number">{{$newpacient}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
      <div class="col-md-4">
       <!-- Rezervation LIST -->
       <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ date('Y-m-d') }} programari </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach($upcomingrez->all() as $upcoming)
                  <li class="item">
                  <div class="product-img" style="font-size:1.5em">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">{{$upcoming->starthour}}
                      <span class="label label-warning pull-right">{{$upcoming->duration}} minute</span></a>
                    <span class="product-description">
                      {{$upcoming->firstname}} {{$upcoming->lastname}}
                      </span>
                  </div>
                  <hr/>
                </li>
                  @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ route('program')}}" class="uppercase">Lista completa</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>

      <div class="col-md-4">
       <!-- Rezervation LIST -->
       <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Boli frecvente (ultimele 30 zile) </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach($bolilunaasta->all() as $boala)
                  <li class="item">
                  <div class="col-md-3">
                      <span class="description-percentage text-success" style="font-size:1.2em">
                      <i class="fa fa-caret-left"></i> 
                      {{number_format((float)$boala->total * 100 / $totalboli->cnt,2,'.','')}}%</span>
                  </div>
                  <div class="col-md-7">
                     <b style="font-size:1.2em"> {{ucfirst($boala->diagnostics)}} ({{ $boala->codboala}})</b>
                      <br/>
                      {{$boala->total}} pacient/i din {{$totalboli->cnt}}</span>
                  </div>
                  <hr/>
                </li>
                  @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ route('program')}}" class="uppercase">Lista completa</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
      <!--div class="row">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Bar Chart</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height: 239px; width: 694px;" width="694" height="239">
                </canvas>
              </div>
            </div>
          </div>
      </div-->
</div>
</section>

<script>
 
 $(document).ready(function() 
{
 $.getJSON('http://127.0.0.1:8085/concediiconsult', function(result) {

var labels = result.map(function(e) {
      return e.date;
   }),
   source1 = result.map(function(e) {
      return e.source1;
   }),
   source2 = result.map(function(e) {
      return e.source2;
   }),

var ctx = document.getElementById("barChart").getContext("2d");
var myChart = new Chart(ctx, {
   type: 'line',
   data: {
      labels: labels,
      datasets: [{
         label: "Source 1",
         data: source1,
         borderWidth: 2,
         backgroundColor: "rgba(6, 167, 125, 0.1)",
         borderColor: "rgba(6, 167, 125, 1)",
         pointBackgroundColor: "rgba(225, 225, 225, 1)",
         pointBorderColor: "rgba(6, 167, 125, 1)",
         pointHoverBackgroundColor: "rgba(6, 167, 125, 1)",
         pointHoverBorderColor: "#fff"
      }, {
         label: "Source 2",
         data: source2,
         borderWidth: 2,
         backgroundColor: "rgba(246, 71, 64, 0.1)",
         borderColor: "rgba(246, 71, 64, 1)",
         pointBackgroundColor: "rgba(225, 225, 225, 1)",
         pointBorderColor: "rgba(246, 71, 64, 1)",
         pointHoverBackgroundColor: "rgba(246, 71, 64, 1)",
         pointHoverBorderColor: "#fff"
      }]
   }
});
});
});
</script>
@endsection