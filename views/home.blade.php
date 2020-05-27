@extends('layouts.app')

@section('title', trans('messages.home'))
@section('title', trans('vote::messages.title'))

@plugin('vote')
@php
    $votes = \Illuminate\Support\Facades\Cache::remember('theme.top-votes', 5, function () {
            $votes = DB::table('vote_votes')
            ->select(['user_id', DB::raw('COUNT(user_id) AS count')])
            ->where('created_at', '>', now()->startOfMonth())
            ->groupBy('user_id')
            ->orderByDesc('count')
            ->take(3)
            ->get();

        $users = \Azuriom\Models\User::findMany($votes->pluck('user_id'))->keyBy('id');

        return $votes->mapWithKeys(function ($vote, $position) use ($users) {
            return [
                $position + 1 => [
                    'user' => $users->get($vote->user_id),
                    'votes' => $vote->count,
                ],
            ];
        });
    })
@endphp
@endplugin

@section('content')
    <div class="home-background mb-4 p-4" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') no-repeat center; background-size: cover">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center text-center text-white h-100">
                <div class="col-md-12">
                    @if(config('theme.title'))
                        <h1 class="title">{{ config('theme.title') }}</h1>
                    @endif
                    @if(config('theme.subtitle'))
                        <h3  class="font-link subtitle">{{ config('theme.subtitle') }}</h3>
                    @endif

                </div>
                <div class="col-mb-5">
                    @if($server && ($playersCount = $server->getOnlinePlayers()) >= 0)
                    	<h1 class="server-title">{{ trans('theme::modernity.config.player') }}</h4>
                        <h3 class="server-subtitle"><i class="fas fa-play"></i> {{ $playersCount }}</h3>
                    @else
                    
					<h4 class="font-link">{{ trans('theme::modernity.config.srvoff') }}</h4>					  
					@endif
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <div class="post-preview mb-3">
                        @if($post->image !== null)
                            <img src="{{ $post->imageUrl() }}" class="post-img img-fluid" alt="{{ $post->title }}">
                        @endif

                        <div class="post-body">
                            <h3><a href="{{ route('posts.show', $post->slug) }}" style="color: #ffffff;">{{ $post->title }}</a></h3>
                            @if($post->image === null)
                                <p>{{ Str::limit(strip_tags($post->content), 250, '...') }}
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ trans('messages.posts.read') }}</a>
                                </p>
                            @endif

                            {{ trans('messages.posts.posted', ['date' => format_date($post->published_at), 'user' => $post->author->name]) }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <h2 class="top-vote-title" style="text-align: center">{{ trans('theme::modernity.config.topvote') }}</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ trans('theme::modernity.config.pseudo') }}</th>
                            <th scope="col">{{ trans('theme::modernity.config.nbr') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @isset($votes)
                        <tr>
                            @foreach($votes as $id => $vote)
                            <td scope="row">#{{ $vote['user']->id }}</td>
                            <td>{{ $vote['user']->name }}</td>
                            <td>{{ $vote['votes'] }} votes</td>
                            @endforeach
                        </tr>
                    @endisset

                    </tbody>
                </table> 

                @if(config('theme.discord-id'))
                    <iframe src="https://discordapp.com/widget?id={{ config('theme.discord-id') }}&theme=dark" title="Discord" height="500" class="discord-widget shadow mb-3" allowtransparency="true"></iframe>
                @endif

                @if(config('theme.twitter'))
                    <div class="twitter-widget shadow">
                        <a class="twitter-timeline" data-theme="dark" data-height="500" href="{{ config('theme.twitter') }}">Tweets de {{ site_name() }}</a>
                    </div>
                @endif

                
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://platform.twitter.com/widgets.js" async></script>
@endpush

