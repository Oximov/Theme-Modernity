<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="border-color: #282828; background-color: #282828;">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"  style="color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 300;">{{ trans('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('forum.home') }}"  style="color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 300;">{{ trans('forum::messages.title') }}</a></li>

        @foreach(optional($current ?? null)->getNavigationStack() ?? [] as $breadcrumbLink => $breadcrumbName)
            <li class="breadcrumb-item"><a href="{{ $breadcrumbLink }}"  style="color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 300;">{{ $breadcrumbName }}</a></li>
        @endforeach
    </ol>
</nav>

@push('styles')
    <style>
        .forum-big-icon i {
            font-size: 3em;
        }

        @media (max-width: 575px) {
            .forum-big-icon {
                padding-left: 5px;
                padding-right: 0;
            }

            .forum-big-icon i {
                font-size: 2em;
            }
        }
    </style>
@endpush
