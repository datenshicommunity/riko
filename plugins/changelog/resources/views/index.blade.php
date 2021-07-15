@extends('layouts.app')

@section('title', 'Changelog')

@section('content')
<div class="container content">
    <div class="alert alert-warning" role="alert">
        {{ trans('changelog::messages.changelog-empty') }}
    </div>
</div>
@endsection