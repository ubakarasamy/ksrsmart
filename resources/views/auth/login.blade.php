@extends('layout.app-wnav')

@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Login Now</h2>
		    <form class="login-form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
    {{-- <input type="text" class="form-control" placeholder=""> --}}
    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    {{-- <input type="password" class="form-control" placeholder=""> --}}
    <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
  </div>
  
  
    <div class="form-check">
    <label class="form-check-label">
      {{-- <input type="checkbox" class="form-check-input"> --}}
      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
      <small>Remember Me</small>
    </label>
    <button type="submit" class="btn btn-login float-right">Submit</button>
  </div>
  
</form>
<div class="copy-text">Created By <i class="fa fa-heart"></i> by <a href="http://ivisual.in">Ivisual</a></div>
		</div>
		<div class="col-md-8 banner-sec">
           
	    </div>
</div>
</div></section>
<style>
    .login-block{
    background: #0081c2;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom right, #009688, #0081c2));  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom right, #009688, #0081c2); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
float:left;
width:100%;
height: 100vh;
padding : 20vh 0;
}
.banner-sec{background:url(/img/ksrce_bg.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
.container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
.carousel-inner{border-radius:0 10px 10px 0;}
.carousel-caption{text-align:left; left:5%;}
.login-sec{padding: 50px 30px; position:relative;}
.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
.login-sec .copy-text i{color:#E91E63;}
.login-sec .copy-text a{color:#009687;}
.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #0085b6;}
.login-sec h2:after{content:" "; width:100px; height:5px; background:#009688; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
.btn-login{background: #0085b6; color:#fff; font-weight:600;}
.banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
.banner-text h2{color:#fff; font-weight:600;}
.banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
.banner-text p{color:#fff;}

.copyright{
    color: #fff;
}
.copyright a{
    color: #fff;
}
</style>


@endsection
