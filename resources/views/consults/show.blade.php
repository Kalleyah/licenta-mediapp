@extends('admin_template')

@section('content')

{{ Breadcrumbs::render('consults.show', $consults, $pacient) }}

<section class="content">
    <div class="row panel">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{$consults->consultdate}} : {{$consults->diagnostics}} ({{$consults->codboala}})</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body no-padding">
                <div  class="col-lg-5 col-md-5 col-xs-12">
                    <span><b>Simptome</b><br/> {{$consults->simpthoms}}</span>
                    <hr/>
                    <span><b>Tratament recomandat</b> <br/> {{$consults->threatment}}</span>
                    <hr/>
                    <span><b>Concediu medical</b> - 
                    @if($consults->medicalbreak == 0)
                        Nu s-a acordat
                        <hr/>
                        <a class="btn btn-xs btn-warning" 
                            href="{{ route('concedii.add' , ['pacientid' =>$pacient->id, 'consultid' =>$consults->id]) }}">
                                Adauga concediu medical
                        </a>
                    @else
                        Acordat <br/>
                    @endif
                    
                    @if(empty($concedii))
                        - 
                    @else
                        <h5>CM cu SERIA: {{$concedii->serie}}</h5> <br/>
                        <span >PERIOADA: {{$concedii->startdate}} - {{$concedii->enddate}} <br/>
                           <sub> Data acordarii {{$concedii->created_at}}, Modificat la {{$concedii->updated_at}} </sub>
                         </span>
                    @endif
                    
                    </span>
                </div>
                <div  class="col-lg-6 col-md-1 col-xs-12">
                    <span><h4>
                        <a href="{{ route('pacients.show' , ['id' =>$pacient->id ]) }}">
                            {{$pacient->firstname}} {{$pacient->lastname}}
                        </a>
                    </h4><br/>
                    CNP: {{$pacient->cnp}}<br/>
                    Data nasterii: {{$pacient->birthdate}}<br/>
                    Contact: {{$pacient->address}} {{$pacient->phone}}</span>
                    <hr/>
                    <span><b>Alergii</b> <br/> {{$pacient->alergii}}<br/>
                    <b>Observatii</b> <br/> {{$pacient->note}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <a href="{{ route('program.add' , ['pacientid' =>$pacient->id ]) }}" class="edit-modal btn btn-success">
            <span class="glyphicon glyphicon-plus"></span> Introduce programare noua
        </a>
        <a href="{{ route('consults.add', ['pacientid' =>$pacient->id]) }}" class="edit-modal btn btn-info">
            <span class="glyphicon glyphicon-plus"></span> Introduce consultatie
        </a>
    </div>
</section>
@endsection