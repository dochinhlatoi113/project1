@extends('layout.front.master')
@section('content')
<section id="form">
    <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="login-form"><!--login form-->
                            <h2>Login to your account</h2>
                            <form action="{{route('auth_login')}}" method="POST">
                            @csrf
                                
                                <input type="text" placeholder="Email" name="l_email" class="form-check-input is-invalid"/>
                                @if ($errors->has('l_email'))
                                  <div class="error invalid-feedback">{{ $errors->first('l_email') }}</div>
                                @endif     
                                <input type="password" placeholder="password" name="l_password" class="form-check-input is-invalid"/>
                                @if ($errors->has('l_password'))
                                  <div class="error invalid-feedback">{{ $errors->first('l_password') }}</div>
                                @endif     
                                <span>
                                    <input type="checkbox" class="checkbox"> 
                                    Keep me signed in
                                </span>
                                <h1>{{$message}}</h1>
                                <button type="submit" name="login" class="btn btn-default">Login</button>
                                
                            </form>
                        </div><!--/login form-->
                    </div>
                    <div class="col-sm-1">
                        <h2 class="or">OR</h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="signup-form"><!--sign up form-->                      
                            <h2>New User Signup!</h2>
                            <form action="{{route('auth_register')}}" method="POST">
                            @csrf
        
                                <input type="text" placeholder="Name" name="name"/>
                                @if ($errors->has('name'))
                                  <div class="error invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif   

                                <input type="email" placeholder="Email Address" name="email"/>
                                @if ($errors->has('email'))
                                  <div class="error invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif 

                                <input type="number" placeholder="phone" name="phone"/>
                                @if ($errors->has('phone'))
                                  <div class="error invalid-feedback">{{ $errors->first('phone')}}</div>
                                @endif 

                                <input type="password" placeholder="Password" name="password"/>
                                @if ($errors->has('password'))
                                  <div class="error invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif 

                                <input type="password" placeholder="Confirmation Password" name="password_confirmation"/>
                                @if ($errors->has('password_confirmation'))
                                  <div class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                @endif 

                                <button type="submit" name="signin" class="btn btn-default">Signup</button>
                              
                            </form>
                        </div><!--/sign up form-->
                    </div>
                </div>
            </div>
</section>
@stop