@extends('admin_template')

@section('content')

{{ Breadcrumbs::render('users.show', $user) }}

<section class="content">
    <div class="row panel">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$user->name}} ({{$user->email}})</h3>
                </div>
            </div>
          
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-calendar margin-r-5"></i> Creat la </strong>

                <p class="text-muted">
                    {{$user->created_at}}
                </p>

                <hr>
                
            </div>
            <!-- /.box-body -->
           
        </div>
    </div>
   
</section>
@endsection