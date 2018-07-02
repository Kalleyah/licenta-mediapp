@extends('admin_template')

@section('content')

{{ Breadcrumbs::render('pacients.show', $pacient) }}

<section class="content">
<div class="col-md-3">

<!-- Profile Image -->
<div class="box box-success">
  <div class="box-body box-profile">
    <h3 class="profile-username text-center">{{$pacient->firstname}} {{$pacient->lastname}}</h3>
    <p class="text-muted text-center">CNP: {{$pacient->cnp}}</p>

    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>Data nasterii</b> <a class="pull-right">{{$pacient->birthdate}}</a>
      </li>
      <li class="list-group-item">
        <b>Adresa</b> <a class="pull-right">{{$pacient->address}}</a>
      </li>
      <li class="list-group-item">
        <b>Telefon</b> <a class="pull-right">{{$pacient->phone}}</a>
      </li>
    </ul>
   
    <a href="{{ route('program.add', ['pacientid' => $pacient->id]) }}" class="btn btn-primary btn-xs"><b>Adauga programare</b></a>
    <a href="{{ route('consults.add', ['pacientid' => $pacient->id]) }}" class="btn btn-primary btn-xs"><b>Adauga consultatie</b></a>
    <br/>
    <a href="{{ route('pacients.edit', ['id' => $pacient->id]) }}" class="btn btn-primary btn-xs"><b>Editeaza</b></a>
    <a onclick="return confirm('Sigur vreti sa stergeti pacientul?')" href="{{ route('pacients.destroy', ['id' => $pacient->id]) }}" class="btn btn-primary btn-xs"><b>Sterge</b></a>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

<!-- About Me Box -->
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title">Despre pacient</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <strong><i class="fa fa-calendar margin-r-5"></i> Ultima programare</strong>

    <p class="text-muted">
        @if(empty($reservations))
          Nu are programare.
        @else
          {{$reservations->startdate}} {{$reservations->starthour}}
        @endif
    </p>

    <hr>

    <strong><i class="fa fa-pencil margin-r-5"></i> Alergii</strong>

    <p>
        @if(empty($pacient->alergii))
          Nu are alergii cunoscute.
        @else
           @foreach(explode(',',$pacient->alergii) as $info) 
            <span class="label label-danger">{{$info}}</span>
          @endforeach
        @endif

     <!-- <span class="label label-danger">UI Design</span>
      <span class="label label-success">Coding</span>
      <span class="label label-info">Javascript</span>
      <span class="label label-warning">PHP</span>
      <span class="label label-primary">Node.js</span>-->
    </p>

    <hr>

    <strong><i class="fa fa-file-text-o margin-r-5"></i> Note</strong>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
</div>

 <!-- /.col -->
 <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activity" data-toggle="tab">Istoric medical</a></li>
        <li><a href="#timeline" data-toggle="tab">Concedii medicale</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="activity">
        @foreach($consults->all() as $consult)
          <!-- Post -->
          <div class="post clearfix">
            <i class="fa fa-hospital-o pull-left" style="font-size:2.2em; margin-left:5px"></i> 
            <div class="user-block">
                  <span class="username">
                    <a href="{{ route('consults.show', ['id'=> $consult->id])}}">{{$consult->diagnostics}} {{$consult->codboala}} </a>
                  </span>
              <span class="description">{{$consult->consultdate}} ,  Medic: {{$consult->medicuser}}</span>
            </div>
            <!-- /.user-block -->
            <p>
              Simptome: {{$consult->simpthoms}}<br/>
              Tratament: {{$consult->threatment}}
            </p>
            <ul class="list-inline">
              <li><a href="{{ route('consults.edit', ['id' => $consult->id]) }}" class="link-black text-sm">
                <i class="fa fa-edit margin-r-5"></i> Editeaza</a></li>
              <li><a onclick="return confirm('Sigur vreti sa stergeti consultatia?')" href="{{ route('consults.destroy', ['id' => $consult->id]) }}" class="link-black text-sm">
                <i class="fa fa-trash margin-r-5"></i> Sterge</a>
              </li>
            </ul>
            
          </div>
          <!-- /.post -->
        @endforeach
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="timeline">
          <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                      <th>ID</th>
                      <th>Serie</th>
                      <th>Interval</th>
                      <th>Diagnostic</th>
                      <th>Medic</th>
                      <th></th>
                  </tr>
                  @foreach($concedii->all() as $concediu)
                      <tr>
                        <td>{{$concediu->id}}</td>
                        <td>{{$concediu->serie}}</td>
                        <td>{{ date('Y-m-d', strtotime($concediu->startdate))}} - 
                          {{date('Y-m-d', strtotime($concediu->enddate))}}
                           => nr. de zile: {{$concediu->duration}} 
                        </td>
                        <td>{{$concediu->diagnostic}}</td>
                       <td> {{$concediu->medicuser}}</td>
                        <td>
                        <a href="{{ route('concedii.edit', ['id' => $concediu->id]) }}" class="delete-modal btn btn-xs btn-warning">
                            <span class="glyphicon glyphicon-trash"></span> Editeaza
                        </a>
                        <a onclick="return confirm('Sigur vreti sa stergeti concediul?')" href="{{ route('concedii.destroy', ['id' => $concediu->id]) }}" class="delete-modal btn btn-xs btn-danger">
                            <span class="glyphicon glyphicon-trash"></span> Sterge
                        </a>

                        </td>
                      </tr>
                  @endforeach  
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.tab-pane -->

        
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
</div>
</section>
@endsection