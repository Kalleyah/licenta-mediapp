@extends('admin_template')

@section('content')

{{ Breadcrumbs::render('users.updatepass', $user) }}

<section class="content">
    <div class="row col-md-6 panel">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="box-header with-border">
                    <h3 class="box-title">Editare {{$user->name}} ({{$user->email}})</h3>
                </div>
            </div>
          
            <form action = "{{ route('users.storepassword', ['id' => $user->id]) }}" method = "post">
                <div class="box-body">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="text" class="form-control" placeholder="Parola curenta" value="" id="oldpassword" name="oldpassword">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-unlock"></i></span>
                        <input type="password" class="form-control" placeholder="Parola noua" value="" id="password" name="password">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                        <input type="password" class="form-control" placeholder="Repeta parola noua" value="" id="password_confirmation" name="password_confirmation">
                    </div>
                    <br>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Salvare</button>
                </div>
            </form>
           
        </div>
    </div>
   
</section>
@endsection