@extends('layouts.app')

@section('title', $post->title)
@section('description', $post->description)
@section('type', 'article')

@push('meta')
    <meta property="og:article:author:username" content="{{ $post->author->name }}">
    <meta property="og:article:published_time" content="{{ $post->published_at->toIso8601String() }}">
    <meta property="og:article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
@endpush

@section('content')
    <div class="container content-parent post">
        <div class="page-article">
            <h1 class="title-block">{{ $post->title }}</h1>

            @if(!$post->isPublished())
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ trans('posts.not-published') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($post->hasImage())
                <img class="rounded img-fluid mb-4" src="{{ $post->imageUrl() }}" alt="{{ $post->title }}">
            @endif

            <div class="content mb-4">
                <div class="card-text">
                    {!! $post->content !!}
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-primary @if($post->isLiked()) active @endif" @guest disabled @endguest data-like-url="{{ route('posts.like', $post) }}">
                        @lang('messages.likes', ['count' => '<span class="likes-count">'.$post->likes->count().'</span>'])
                        <span class="d-none spinner-border spinner-border-sm like-spinner" role="status"></span>
                    </button>

                    <span>{{ trans('messages.posts.posted', ['date' => format_date($post->published_at), 'user' => $post->author->name]) }}</span>
                </div>
            </div>
        </div>

        <div class="commentaire">
            @foreach($post->comments as $comment)
                <div class="content mb-3">
                    <div class="media">
                        <img class="d-flex mr-3 rounded" src="{{ game()->getAvatarUrl($comment->author) }}" alt="{{ $comment->author->name }}" height="55">
                        <div class="media-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="content-body">
                                    <h5>@lang('messages.comments.author', ['user' => $comment->author->name, 'date' => format_date($comment->created_at)])</h5>

                                    {{ $comment->content }}
                                </div>
                                @can('delete', $comment)
                                    <a class="btn btn-danger" href="{{ route('posts.comments.destroy', [$post, $comment]) }}" data-confirm="delete">{{ trans('messages.actions.delete') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @can('create', \Azuriom\Models\Comment::class)
            <div class="content mt-4">
                <h2>{{ trans('messages.comments.create') }}</h2>

                <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="content">{{ trans('messages.comments.your-comment') }}</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4" required></textarea>

                        @error('content')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('messages.actions.comment') }}</button>
                </form>
            </div>
        @endcan

        @guest
            <div class="alert alert-info mt-4" role="alert">
                {{ trans('messages.comments.guest') }}
            </div>
        @endguest
    </div>

    <!-- Delete confirm modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="confirmDeleteLabel">{{ trans('messages.comments.delete-title') }}</h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">{{ trans('messages.comments.delete-description') }}</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ trans('messages.actions.cancel') }}</button>

                    <form id="confirmDeleteForm" method="POST">
                        @method('DELETE')
                        @csrf

                        <button class="btn btn-danger" type="submit">{{ trans('messages.actions.delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
