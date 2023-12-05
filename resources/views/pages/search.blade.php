@extends('layouts.base')
@section('title', 'Search Results')

@section('content')
    <!-- <div class="grid grid-cols-3 gap-4">
        @foreach ($searchResults as $result)
             <x-cards.article :article="$result"/>
        @endforeach
    </div> -->
    <!-- <section class="vi-magzin-header-section"> -->
		<!-- <div class="vigrid-wide"> -->
        <div class="ecosystem-wrap">
					<div class="search-bar-wrapper">
						<span class="vi-icons search"></span>
						<input type="text" class="vi-search-bar" placeholder="Hydrid Warfare" required="">
					</div>
					<div class="eco-menu">
						<ul>
							<li><a href="#">All</a></li>
							<li><a href="#">News Today</a></li>
							<li><a href="#">Monthly Magazine</a></li>
							<li><a href="#">Weekly Focus</a></li>
							<li><a href="#">Notes</a></li>
							<li><a href="#">Images</a></li>
							<li><a href="#">Others</a></li>
						</ul>
						<a href="#" class="hybrid-filter">Filter</a>
					</div>
				</div>
				<div class="filter-row mt-2">
					<div class="filter-select-wrap">
						<button>All Results</button>
						<ul>
							<li value="">All Results 1</li>
							<li value="">All Results 2</li>
							<li value="">All Results 3</li>
						</ul>
					</div>
					<div class="filter-select-wrap ml-2">
						<button>All Results</button>
						<ul>
							<li value="">All Results 1</li>
							<li value="">All Results 2</li>
							<li value="">All Results 3</li>
						</ul>
					</div>
				</div>
                <div class="divider mt-8"></div>
			<!-- hybrid body section start -->
			<div class="hybrid-text-wrapper">
				<div class="hybrid-left-panel">
					<div class="hybrid-text-row">
						<h3>Hybrid Warframe</h3>
						<p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim asperiores aut molestias ratione sit molestias iste in galisum maiores! Sit quibusdam omnis cum perferendis officia et molestiae beatae hic dolores architecto. </p>
						<span>Monthly Magazine | 24-01-2023</span>
					</div>
					<div class="hybrid-text-row">
						<h3>Hybrid Warframe</h3>
						<p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim asperiores aut molestias ratione sit molestias iste in galisum maiores! Sit quibusdam omnis cum perferendis officia et molestiae beatae hic dolores architecto. </p>
						<span>Monthly Magazine | 24-01-2023</span>
					</div>
					<div class="hybrid-img-wrapper">
						<div class="hybrid-img-row">
							<h3>Images Section</h3>
							<ul>
								<li>
									<img src="{{ URL::asset('images/hybrid-img.jpg') }}">
									<p>Hybrid Warfare : A New Face of Warfare</p>
								</li>
								<li>
									<img src="{{ URL::asset('images/hybrid-img.jpg') }}">
									<p>Hybrid Warfare : A New Face of Warfare</p>
								</li>
								<li>
									<img src="{{ URL::asset('images/hybrid-img.jpg') }}">
									<p>Hybrid Warfare : A New Face of Warfare</p>
								</li>
								<li>
									<img src="{{ URL::asset('images/hybrid-img.jpg') }}">
									<p>Hybrid Warfare : A New Face of Warfare</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="hybrid-text-row">
						<h3>Hybrid Warframe</h3>
						<p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim asperiores aut molestias ratione sit molestias iste in galisum maiores! Sit quibusdam omnis cum perferendis officia et molestiae beatae hic dolores architecto. </p>
						<span>Monthly Magazine | 24-01-2023</span>
					</div>
					<div class="hybrid-text-row">
						<h3>Hybrid Warframe</h3>
						<p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim asperiores aut molestias ratione sit molestias iste in galisum maiores! Sit quibusdam omnis cum perferendis officia et molestiae beatae hic dolores architecto. </p>
						<span>Monthly Magazine | 24-01-2023</span>
					</div>
				</div>
				<div class="hybrid-right-panel">
					<div class="video-cont-wrapper mb-6">
						<h4>Hybrid Warfare</h4>
						<p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim asperiores </p>
						<div class="hybrid-video"></div>
					</div>
					<div class="video-cont-wrapper mb-6">
						<h4>Hybrid Warfare</h4>
						<p>Lorem ipsum dolor sit amet. Aut praesentium molestiae sit amet consectetur id consequuntur velit et enim asperiores </p>
						<div class="hybrid-video"></div>
					</div>
				</div>
			</div>
		<!-- </div> -->
	<!-- </section> -->
@endsection
