<!-- Слайдер -->

<div class="uk-position-relative uk-visible-toggle uk-light uk-visible@s" uk-slideshow="autoplay: true; autoplay-interval: 3000; animation: fade">
    <ul class="uk-slideshow-items" uk-height-viewport="offset-top: true; offset-bottom: 30">
        @foreach($sliders as $slide)
            <li>
                <img src="{{ asset('images/'.$slide->image) }}" alt="{{ $slide->name }}" uk-cover>
                <h2 class="slide-title animated fadeIn">{{ $slide->name }}</h2>
            </li>
        @endforeach
    </ul>
    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
</div>
