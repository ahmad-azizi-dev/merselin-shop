<div class="hero-slides owl-carousel">
	@foreach($slides as $slide)
		<div class="single-hero-slide" style="background-image: url('{{url('storage/slides/').'/'.$slide->img}}')">
			<div class="slide-content h-100 d-flex align-items-center">
				<div class="container">
					<h4 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">
						{{$slide->title}}
					</h4>
					<p class="text-white" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">
						{{$slide->content}}
					</p>
					<a class="btn btn-primary btn-sm ml-2" href="{{$slide->link}}" data-animation="fadeInUp"
					   data-delay="800ms" data-wow-duration="1000ms">
						{{$slide->button_name}}
					</a>
				</div>
			</div>
		</div>
	@endforeach
</div>