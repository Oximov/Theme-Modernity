@extends('admin.layouts.admin')

@section('title', trans('forum::admin.forums.title'))

@push('footer-scripts')
    <script src="{{ asset('vendor/sortablejs/Sortable.min.js') }}"></script>
    <script>
        const sortable = Sortable.create(document.getElementById('categories'), {
            group: {
                name: 'categories',
            },
            animation: 150,
            handle: '.sortable-handle'
        });

        document.querySelectorAll('.category-list').forEach(function (el) {
            Sortable.create(el, {
                group: {
                    name: 'forums',
                },
                animation: 150,
                handle: '.sortable-handle'
            });
        });

        function serialize(categories) {
            const serialized = [];

            [].slice.call(categories.children).forEach(function (category) {
                const forumsId = [];

                const forums = category.querySelector('.category-list');

                [].slice.call(forums.children).forEach(function (categoryforum) {
                    forumsId.push(categoryforum.dataset['forumId']);
                });

                serialized.push({
                    id: category.dataset['categoryId'],
                    forums: forumsId
                });
            });

            return serialized
        }

        const saveButton = document.getElementById('save');
        const saveButtonIcon = saveButton.querySelector('.btn-animation');

        saveButton.addEventListener('click', function () {
            saveButton.setAttribute('disabled', '');
            saveButtonIcon.classList.remove('d-none');

            axios.post('{{ route('forum.admin.forums.update-order') }}', {
                'categories': serialize(sortable.el)
            })
                .then(function (json) {
                    createAlert('success', json.data.message, true);
                })
                .catch(function (error) {
                    createAlert('danger', error, true)
                })
                .finally(function () {
                    saveButton.removeAttribute('disabled');
                    saveButtonIcon.classList.add('d-none');
                });
        });
    </script>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">

            <ol class="list-unstyled sortable" id="categories">
                @foreach($categories as $category)
                    <li class="sortable-item sortable-dropdown mb-5" data-category-id="{{ $category->id }}">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <span>
                                    <i class="fas fa-arrows-alt sortable-handle"></i> {{ $category->name }}
                                </span>
                                <span>
                                    <a href="{{ route('forum.admin.categories.edit', $category) }}" class="mx-1" title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('forum.admin.categories.destroy', $category) }}" class="mx-1" title="{{ trans('messages.actions.delete') }}" data-toggle="tooltip" data-confirm="delete"><i class="fas fa-trash"></i></a>
                                </span>
                            </div>
                        </div>
                        <ol class="list-unstyled sortable sortable-list category-list">
                            @foreach($category->forums as $forum)
                                <li class="sortable-item" data-forum-id="{{ $forum->id }}">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-between">
                                            <span>
                                                <i class="fas fa-arrows-alt sortable-handle"></i>
                                                <a href="{{ route('forum.show', $forum->slug) }}">{{ $forum->name }}</a>
                                            </span>
                                            <span>
                                                <a href="{{ route('forum.admin.forums.edit', $forum) }}" class="mx-1" title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('forum.admin.forums.destroy', $forum) }}" class="mx-1" title="{{ trans('messages.actions.delete') }}" data-toggle="tooltip" data-confirm="delete"><i class="fas fa-trash"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </li>
                @endforeach
            </ol>

            <a href="{{ route('forum.admin.categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{ trans('forum::admin.forums.create-category') }}</a>

            @if(! $categories->isEmpty())
                <a href="{{ route('forum.admin.forums.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{ trans('forum::admin.forums.create-forum') }}
                </a>

                <button type="button" class="btn btn-success" id="save">
                    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
                    <i class="fas fa-sync fa-spin d-none btn-animation"></i>
                </button>
            @endif
        </div>
    </div>
@endsection
