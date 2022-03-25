@extends('layout.layout')

@section('head')
    <title>PMT Register</title>
    <style>
        .loginForm{
            margin-top: 20%
        }
    </style>
@endsection

@section('content')
    <div class="row loginWarp">
        <div class="col-md-4 offset-md-4 ">
            <div class="card loginForm">
                <div class="card-header text-center">
                    <h2>Register</h2>
                    <h5>Project Management Tool</h5>
                </div>
                <div class="card-body">
                    <form  id="register">
                        @csrf
                        <div>
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name"/>
                            <span class="error_msg text-danger" id="first_name_msg"></span>
                        </div>
                        <br>
                        <div>
                            <label>last Name</label>
                            <input type="text" class="form-control" name="last_name"/>
                            <span class="error_msg text-danger" id="last_name_msg"></span>
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"/>
                            <span class="error_msg text-danger" id="email_msg"></span>
                        </div>
                        <br>
                        <div>
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"/>
                            <span class="error_msg text-danger" id="password_msg"></span>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success  btn-lg btn-block">Register</button>
                    </form>
                    <br/>
                    <a href="{{url('login')}}">Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('jsblock')
<script>
    $("#register").submit(function(e) {
          $("input,textarea").removeClass("error");
          $(".error_msg").html("");
          var form_data = new FormData(this);
          e.preventDefault();
               $.ajax({
                   url: "{{url('register')}}",
                   type: "POST",
                   data: form_data,
                   async: false,
                   success: function (reponse) {
                           toastr.success("Register Successfully");
                           setTimeout(() => {
                               location.assign("{{route('login')}}")
                           }, 2000);
                   },error: function (xhr) {
                       setTimeout(function(){
                           $.each(xhr.responseJSON.errors, function(key,value) {
                               $("#"+key+"_msg").html(value);
                               $("input[name="+key+"],textarea[name="+key+"]").addClass("error");
                           }); 
                       },1000);
                   },
                   cache: false,
                   contentType: false,
                   processData: false
               });
           });
    
</script>
@endsection