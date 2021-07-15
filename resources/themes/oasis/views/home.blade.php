@extends('layouts.app')

@section('title', trans('messages.home'))

@section('content')
    <div class="container text-center">
        <div class="row article">
            <!-- Youtube -->
            @if(theme_config('youtube_link'))
                <div class="col-md-12">
                    <div class="post-preview">
                        <iframe class="video-youtube" src="https://www.youtube.com/embed/{{ theme_config('youtube_link') }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            @endif 
        </div>
        
        <div class="row article">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('posts.show', $post->slug) }}" class="link-unstyled">
                            @if($post->hasImage())
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="img-fluid rounded">

                                <div class="title p-3">
                                    <h4>{{ $post->title }}</h4>
                                    <h6>{{ format_date($post->published_at) }}</h6>
                                </div>
                            @else
                                <div class="preview-content p-4">
                                    <h4>{{ $post->title }}</h4>
                                    {{ Str::limit(strip_tags($post->content), 450) }}
                                </div>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="col-md-4">

                <!-- Shop -->
                @plugin('shop')
                    @if(theme_config('image-shop-1'))
                        <div class="post-preview shop-home">
                            <div class="shop-content p-4">
                                <h4>{{ trans('theme::oasis.header.shop') }}</h4>
                                @if(theme_config('image-shop-1'))
                                    <a href="{{ route('shop.home') }}">
                                        <img class="card-img-top" src="{!! theme_config('image-shop-1') !!}" alt="">
                                    </a>
                                @endif
                                @if(theme_config('image-shop-2'))
                                    <a href="{{ route('shop.home') }}">
                                        <img class="card-img-top" src="{!! theme_config('image-shop-2') !!}" alt="">
                                    </a>
                                @endif
                                @if(theme_config('image-shop-3'))
                                    <a href="{{ route('shop.home') }}">
                                        <img class="card-img-top" src="{!! theme_config('image-shop-3') !!}" alt="">
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                @endplugin
                
                <!-- Discord -->
                @if(theme_config('discord_id'))
                    <div class="post-preview">
                        <h4>{{ trans('theme::oasis.links.'.'discord') }}</h4>
                        <iframe class="discord" src="https://discordapp.com/widget?id={!! theme_config('discord_id') !!}&theme=dark"></iframe>
                    </div>
                @endif
                
                <!-- Twitter -->
                @if(theme_config('twitter_name'))
                    <div class="post-preview">
                        <h4>{{ trans('theme::oasis.links.'.'twitter') }}</h4>
                        <div>
                            <a class="twitter-timeline" href="https://twitter.com/{!! theme_config('twitter_name') !!}" data-widget-id="408255561281462272" style="text-decoration: none; transition: .3s;">{!! theme_config('twitter_name') !!}</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        </div>
                    </div>  
                @endif
            </div>
        </div>
    </div>
@endsection