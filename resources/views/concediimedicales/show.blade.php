@extends('admin_template')

@section('content')
<section class="content">
    <div class="row panel">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{$pacient->firstname}} {{$pacient->lastname}}</h3>
            </div>
            <div class="col-lg-1 col-md-2 col-xs-12">
                <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail picture hidden-xs" />
                <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail visible-xs picture_mob" />
           </div>
           <div  class="col-lg-5 col-md-5 col-xs-12">
                <h3>CNP: {{$pacient->cnp}}</h3>
                <h4>Data nasterii: {{$pacient->birthdate}}</h4>
                <span>Contact: {{$pacient->address}} {{$pacient->phone}}</span>
           </div>
           <div  class="col-lg-6 col-md-1 col-xs-12">
               Adauga programare
               Adauga consultatie
           </div>
        </div>
    </div>

    <div class="row panel">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Visitors Report</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body no-padding">
                skfydjvc
            </div>
        </div>
    </div>
</section>
@endsection