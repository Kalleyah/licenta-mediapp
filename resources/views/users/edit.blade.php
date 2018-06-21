@extends('admin_template')

@section('content')

{{ Breadcrumbs::render('users.edit', $user) }}

<section class="content">
    <div class="row col-md-6 panel">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="box-header with-border">
                    <h3 class="box-title">Editare {{$user->name}} ({{$user->email}})</h3>
                </div>
            </div>
          
            <form action = "{{ route('users.update', ['id' => $user->id]) }}" method = "post">
                <div class="box-body">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="" value="{{$user->name}}" id="name" name="name">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="form-control" placeholder="" value="{{$user->email}}" id="email" name="email">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Salvare</button>
                </div>
            </form>
           
        </div>
    </div>
   
</section>
@endsection