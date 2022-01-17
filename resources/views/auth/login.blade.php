@extends('layouts.app')

@section('content')
       
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css') }}">


        <!-- Contact Form -->

	<div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 offset-lg-1" style="border: 1px solid gray;padding:20px;border-radius:25px;">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Sign in </div>

						<form action="{{ route('login') }}" id="contact_form" method="post">
                            @csrf
							<div class="form-group">
                                <label for="exampleInputEmail1">Email -or- Phone Number</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  aria-describedby="emailHelp">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
							<div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required  aria-describedby="emailHelp">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                              </div>
							<div class="contact_form_button">
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
						</form>
                        <br>
                        <a href="{{ route('password.request') }}">I Forget My Password</a><br><br>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fab fa-facebook"></i>  Login with Facebook</button>
                        <a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger btn-block"><i class="fab fa-google"></i> Login with Google </a> 					</div>
				</div>

                <div class="col-lg-5 offset-lg-1" style="border: 1px solid gray;padding:20px;border-radius:25px;">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Sign up </div>

						<form action="{{ route('register') }}" id="contact_form" method="post">
                            @csrf
							<div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter You Full Name" required  aria-describedby="emailHelp">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text"  class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Enter You Phone Number" required  aria-describedby="emailHelp">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter You Email Adderss" required  aria-describedby="emailHelp">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter You Password" required  aria-describedby="emailHelp">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Type You Password" required  aria-describedby="emailHelp">
                              </div>
							<div class="contact_form_button">
								<button type="submit" class="btn btn-primary">Sign Up</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>

@endsection
