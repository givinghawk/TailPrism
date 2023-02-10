@extends('layouts.base')

@section('title', trans('messages.home'))

@section('app')
<div class="bg-cover bg-center bg-no-repeat" style="background-image: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}'); height: 500px;">
<div class="container h-100">
<div class="flex items-center justify-center h-100">
<div class="text-center">
<h1 class="text-white text-4xl font-bold mb-4">{{ theme_config('title') }}</h1>
</div>
</div>
</div>
</div>

<div class="container mx-auto px-6 py-12">
    @include('elements.session-alerts')

    @if($message)
        <div class="mb-5 bg-white rounded p-5 shadow">
            {{ $message }}
        </div>
    @endif

    @if(! $servers->isEmpty())
        <h2 class="text-center mb-3 text-2xl font-bold">
            {{ trans('messages.servers') }}
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-5">
            @foreach($servers as $server)
                <div class="bg-white rounded p-5 shadow">
                    <h3 class="text-center mb-3 font-bold">{{ $server->name }}</h3>

                    @if($server->isOnline())
                        <div class="mb-1 rounded bg-blue-500">
                            <div class="rounded bg-blue-400" style="width: {{ $server->getPlayersPercents() }}%; height: 8px;"></div>
                        </div>

                        <p class="mb-1 text-center text-sm text-gray-500">
                            {{ trans_choice('messages.server.total', $server->getOnlinePlayers(), [
                                'max' => $server->getMaxPlayers(),
                            ]) }}
                        </p>
                    @else
                        <p class="text-center">
                            <span class="bg-red-500 text-white px-2 py-1 rounded-full">
                                {{ trans('messages.server.offline') }}
                            </span>
                        </p>
                    @endif

                    @if($server->joinUrl())
                        <a href="{{ $server->joinUrl() }}" class="block w-full bg-blue-500 text-center text-white rounded py-3 mt-4 hover:bg-blue-400">
                            {{ trans('messages.server.join') }}
                        </a>
                    @else
                        <p class="text-center text-sm text-gray-500 mt-4">{{ $server->fullAddress() }}</p>
                    @endif
                </div>
            @endforeach
            </div>
        @endif

        @if(! $posts->isEmpty())
<h2 class="text-center my-3">
{{ trans('messages.news') }}
</h2>
@endif
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach($posts as $post)
            <div class="post-preview bg-white rounded-lg overflow-hidden shadow-md">
                <a href="{{ route('posts.show', $post->slug) }}" class="link-unstyled">
                    @if($post->hasImage())
                        <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full">

                        <div class="title py-3 px-4">{{ $post->title }}</div>
                    @else
                        <div class="preview-content py-4 px-4">
                            <h4 class="text-lg font-medium">{{ $post->title }}</h4>
                            <p class="text-sm leading-normal text-gray-700">{{ Str::limit(strip_tags($post->content), 450) }}</p>
                        </div>
                    @endif
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
