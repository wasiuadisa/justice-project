
@extends('layouts.public_template')

@section('main_contents')
	<section id="gtco-hero" class="gtco-cover" style="background-image: url({{ asset('storage/public_template/images/' . $index_contents->banner_image) }});"  data-section="home"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="display-t">
						<div class="display-tc">
							<h1 class="animate-box" data-animate-effect="fadeIn">{{ htmlspecialchars_decode($index_contents->banner_title) }}</h1>
							<p class="gtco-video-link animate-box" data-animate-effect="fadeIn"><a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-controller-play"></i></a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="gtco-about" data-section="about">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-8 col-md-offset-2 heading animate-box" data-animate-effect="fadeIn">
					<h1>{{ htmlspecialchars_decode($about_us_contents->title) }}</h1>
					<p class="sub">{{ htmlspecialchars_decode($about_us_contents->description) }}</p>
					<p class="subtle-text animate-box" data-animate-effect="fadeIn">Welcome</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-pull-1 animate-box" data-animate-effect="fadeInLeft">
					<div class="img-shadow">
						<img src="{{ asset('storage/public_template/images/' . $about_us_contents->image) }}" class="img-responsive" alt="{{ htmlspecialchars_decode($about_us_contents->subtitle) }}">
					</div>
				</div>
				<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
					<h2 class="heading-colored">{{ htmlspecialchars_decode($about_us_contents->subtitle) }}</h2>
					<p>{{ htmlspecialchars_decode($about_us_contents->details) }}</p>
					<p><a href="#" class="read-more">Read more <i class="icon-chevron-right"></i></a></p>
				</div>
			</div>
		</div>
	</section>

	<section id="gtco-practice-areas" data-section="practice-areas">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-8 col-md-offset-2 heading animate-box" data-animate-effect="fadeIn">
					<h1>{{ htmlspecialchars_decode($service_page_contents->title) }}</h1>
					<p class="sub">{{ htmlspecialchars_decode($service_page_contents->description) }}</p>
					<p class="subtle-text animate-box" data-animate-effect="fadeIn">Practice <span>Areas</span></p>
				</div>
			</div>
			<div class="row">

@if(count($service_contents) > 0)
		@foreach($service_contents as $service)
				<div class="col-md-6">
					<div class="gtco-practice-area-item animate-box">
						<div class="gtco-icon">
							<img src="{{ asset('storage/public_template/images/' . $service->icon) }}" alt="{{ htmlspecialchars_decode($service->title) }}">
						</div>
						<div class="gtco-copy">
							<h3>{{ htmlspecialchars_decode($service->title) }}</h3>
							<p>{{ htmlspecialchars_decode($service->text) }}</p>
						</div>
					</div>
				</div>
		@endforeach
@endif
			</div>
		</div>
	</section>

	<section id="gtco-our-team" data-section="our-team">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-8 col-md-offset-2 heading animate-box" data-animate-effect="fadeIn">
					<h1>{{ htmlspecialchars_decode($team_page_contents->title) }}</h1>
					<p class="sub">{{ htmlspecialchars_decode($team_page_contents->text) }}</p>
					<p class="subtle-text animate-box" data-animate-effect="fadeIn">Our Team</p>
				</div>
			</div>
@if(count($teams) > 0)
		@foreach($teams as $team_member)
			<div class="row team-item gtco-team-reverse">
				<div class="col-md-6 col-md-push-7 animate-box" data-animate-effect="fadeInRight">
					<div class="img-shadow">
						<img src="{{ asset('storage/public_template/images/' . $team_member->image_filename) }}" class="img-responsive" alt="{{ htmlspecialchars_decode($team_member->fullname) }}">
					</div>
				</div>
				<div class="col-md-6  col-md-pull-6 animate-box" data-animate-effect="fadeInRight">
					<h2>{{ htmlspecialchars_decode($team_member->fullname) }}</h2>
					<h4>{{ htmlspecialchars_decode($team_member->job_title) }}</h4>
					<p>{{ htmlspecialchars_decode($team_member->details) }}</p>
				</div>
			</div>
		@endforeach
@endif
		</div>
	</section>

	<section id="gtco-contact" data-section="contact">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-8 col-md-offset-2 heading animate-box" data-animate-effect="fadeIn">
					<h1>{{ htmlspecialchars_decode($contactusPageMiddlewareData->title) }}</h1>
					<p class="sub">{{ htmlspecialchars_decode($contactusPageMiddlewareData->details) }}</p>
					<p class="subtle-text animate-box" data-animate-effect="fadeIn">Contact</p>
				</div>
			</div>
			<div class="row">

				<div class="col-md-6 col-md-push-6 animate-box">

			    @if( session('contactUsInfo') )
					<div class="col-md-12 ">
				        <!-- Errors for message -->
				        <ul class="alert alert-success text-center">
				        	<li>{{ session('contactUsInfo') }}</li>
				        </ul>
			    	</div>
			    @endif

			    @if( $errors ->any() )
					<div class="col-md-12 ">
						<!-- Errors for message -->
						<h4 class="alert alert-danger text-center">
							Your message could not be mailed:
						</h4>
						<ul class="alert alert-danger text-center list-unstyled">
			        @foreach( $errors->all() as $error )
			            	<li>{{ $error }}</li>
			        @endforeach
						</ul>
					</div>
		    	@endif

					<form action="{{ route('public_contactus_post') }}" method="post">
						@csrf
						<div class="form-group row" id="errorOrMessage">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="category">Message Category</label>
								<select name="category" id="category" class="form-control">
				                    <option value=""> -- Type of message -- </option>
				                @foreach( $categories as $category )
				                    <option value="{{ $category->name }}" @if(old('category') == $category->name){{ 'selected' }} @endif>
				                        {{ htmlspecialchars_decode(ucfirst($category->name)) }}
				                    </option>
				                @endforeach
								</select>
							</div>
							<div class="col-md-6" style="margin-top:10px;">
								<label for="title">Sender's Title</label>
								<select name="title" id="title" class="form-control">
									<option value="">Choose title</option>
									<option value="">Ms</option>
									<option value="">Mrs</option>
									<option value="">Mr</option>
									<option value="">Dr</option>
									<option value="">Chief</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="surname">Surname</label>
								<input type="text" class="form-control" value="{{ old('surname') }}" id="surname">
							</div>
							<div class="col-md-6" style="margin-top:10px;">
								<label for="firstname">First Name</label>
								<input type="text" class="form-control" id="firstname" value="{{ old('firstname') }}">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="phone">Phone</label>
								<input type="text" class="form-control" value="{{ old('phone') }}" id="phone">
							</div>
							<div class="col-md-6" style="margin-top:10px;">
								<label for="email">Email</label>
								<input type="text" class="form-control" value="{{ old('email') }}" id="email">
							</div>
						</div>
						<div class="form-group">
							<label for="message">Message</label>
							<textarea name="message" id="message" class="form-control" cols="30" rows="7">{{ old('message') }}</textarea>
						</div>
						<div class="form-group">
					    @if(config('app.captcha_setting') == true)
					        @if(config('app.captcha_setting_test') == false)
					            <!-- reCaptcha Version 2 -->
				            	<div class="g-recaptcha" data-sitekey="{{ config('app.recaptchaGenuineSite') }}"></div>
					        @else
					            <!-- reCaptcha Version 2 -->
					            <div class="g-recaptcha" data-sitekey="{{ config('app.recaptchaSampleSite') }}"></div>
					        @endif
					    @endif
							<input type="submit" value="Send Message" class="btn btn-primary">
						</div>
					</form>
				</div>
				<div class="col-md-4 col-md-pull-6 animate-box">
					<div class="gtco-contact-info">
						<ul>
							<li class="address">{{ htmlspecialchars_decode($contactusPageMiddlewareData->contact_address) }}</li><?php /*
							<li class="phone"><a href="tel://1235235598">{{ htmlspecialchars_decode($contactusPageMiddlewareData->contact_phone) }}</a></li>*/ ?>
							<li class="phone"><a href="tel://{{ htmlspecialchars_decode($contactusPageMiddlewareData->contact_phone) }}">{{ htmlspecialchars_decode($contactusPageMiddlewareData->contact_phone) }}</a></li>
							<li class="email"><a href="mailto:{{ htmlspecialchars_decode($contactusPageMiddlewareData->contact_email) }}">{{ htmlspecialchars_decode($contactusPageMiddlewareData->contact_email) }}</a></li>
							<li class="url"><a href="{{ $contactusPageMiddlewareData->contact_website }}">{{ htmlspecialchars_decode($contactusPageMiddlewareData->contact_website) }}</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection