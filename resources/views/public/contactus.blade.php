
@extends('layouts.public_template2')

@section('main_contents')

	<section id="gtco-contact" id="gtco-hero" class="gtco-cover" data-section="contact" style="margin-top: 20px; margin-bottom: 100px;">
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
					<form action="" method="post">
						<div class="form-group row">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="category" class="sr-only">Message Category</label>
								<select name="category" id="category" class="form-control">
									<option value="">Choose Message Category</option>
									<option value="">Complaint</option>
									<option value="">Observation</option>
									<option value="">Recommendation</option>
								</select>
							</div>
							<div class="col-md-6" style="margin-top:10px;">
								<label for="title" class="sr-only">Title</label>
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
								<label for="surname" class="sr-only">Surname</label>
								<input type="text" class="form-control" placeholder="Surname" id="surname">
							</div>
							<div class="col-md-6" style="margin-top:10px;">
								<label for="firstname" class="sr-only">First Name</label>
								<input type="text" class="form-control" placeholder="First Name" id="firstname">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6" style="margin-top:10px;">
								<label for="phone" class="sr-only">Phone</label>
								<input type="text" class="form-control" placeholder="Phone" id="phone">
							</div>
							<div class="col-md-6" style="margin-top:10px;">
								<label for="email" class="sr-only">Email</label>
								<input type="text" class="form-control" placeholder="Email" id="email">
							</div>
						</div>
						<div class="form-group">
							<label for="message" class="sr-only">Message</label>
							<textarea name="message" id="message" class="form-control" cols="30" rows="7" placeholder="Message"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" value="Send Message" class="btn btn-primary">
						</div>
					</form>
				</div>
				<div class="col-md-4 col-md-pull-6 animate-box">
					<div class="gtco-contact-info">
						<ul>
							<li class="address">{{ htmlspecialchars_decode($contactusPageMiddlewareData->contact_address) }}</li>
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