@extends('layout.layout')

@section('head')
    <title>PMT Login</title>
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
                    <h2>Login</h2>
                    <h5>Project Management Tool</h5>
                </div>
                <div class="card-body">
                    <form action="{{url('do-login')}}" method="post">
                        @csrf
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"/>
                        </div>
                        <br>
                        <div>
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"/>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success  btn-lg btn-block">Login</button>
                    </form>
                    <br/>
                    <a href="{{url('register')}}">Register Now</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('jsblock')
    
@endsection