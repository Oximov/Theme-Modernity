@extends('admin.layouts.admin')

@section('title', trans('forum::admin.forums.title-create'))

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('forum.admin.forums.store') }}" method="POST">
                @include('forum::admin.forums._form')

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ trans('messages.actions.save') }}</button>
            </form>
        </div>
    </div>
@endsection
