@extends('admin.layouts.admin')

@section('title', trans('changelog::admin.categories.title-edit', ['category' => $category->id]))

@include('admin.elements.editor')

@section('content')
<div class="card shadow mb-4">
 <div class="card-body">
  <form action="{{ route('changelog.admin.categories.update', $category) }}" method="POST"
   enctype="multipart/form-data">
   @method('PUT')

   @include('changelog::admin.categories._form')

   <button type="submit" class="btn btn-primary">
    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
   </button>

   <a href="{{ route('changelog.admin.categories.destroy', $category) }}" class="btn btn-danger" data-confirm="delete">
    <i class="fas fa-trash"></i> {{ trans('messages.actions.delete') }}
   </a>
  </form>
 </div>
</div>
@endsection