@extends('layouts.app')

@if(request()->route('category') === null)
@section('title', trans('changelog::messages.home'))
@else
@section('title', $category->name)
@endif

@section('content')
<div class="container content">
 <div class="row">
  <div class="col-md-3">
   @include('changelog::sidebar')
  </div>
  <div class="col-md-9">
   <div class="row">
    @if(request()->route('category') === null)
    <div class="list-group w-100 px-3">
     @forelse($updates as $update)
     <div class="list-group-item d-flex align-items-center update">
      <div class="description mr-auto">
       {!! $update->description !!}
      </div>
      <div class="badge badge-primary category mr-1">
       <i class="fas fa-folder"></i>
       {{ $update->category->name }}
      </div>
      <div class="badge badge-primary date">
       <i class="fas fa-calendar-week"></i>
       {{ date_format($update->created_at, 'd/m/Y') }}
      </div>
     </div>
     @empty
     <div class="alert alert-warning" role="alert">
      {{ trans('changelog::messages.categories.empty') }}
     </div>
     @endforelse
    </div>
    @else
    <div class="list-group w-100 px-3">
     @forelse($category->updates as $update)
     <div class="list-group-item d-flex align-items-center update">
      <div class="description mr-auto">
       {!! $update->description !!}
      </div>
      <div class="badge badge-primary category mr-1">
       <i class="fas fa-folder"></i>
       {{ $update->category->name }}
      </div>
      <div class="badge badge-primary date">
       <i class="fas fa-calendar-week"></i>
       {{ date_format($update->created_at, 'd/m/Y') }}
      </div>
     </div>
     @empty
     <div class="alert alert-warning" role="alert">
      {{ trans('changelog::messages.categories.empty') }}
     </div>
     @endforelse
    </div>
    @endif
   </div>
  </div>
 </div>
</div>
<style>
 .update:nth-child(even) {
  background: rgba(0, 0, 0, 0.025);
 }

 .update p {
  margin-bottom: 0;
 }

 .update .badge {
  font-size: 9px;
 }
</style>
@endsection