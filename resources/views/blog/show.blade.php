@extends('layouts.alternative')

@section('canonical', '')

@section('additional_head')
    <main id="afterHeader">
        <div class="container" style="margin-top: 94px;">
            <article>
                <h1>{{ $post->title }}</h1>

                <div class="blog-meta">
                    <p>Автор: {{ $post->author }}</p>
                    <p>Опубликовано: {{ $post->created_at->format('d.m.Y') }}</p>
                    @if($post->tags)
                        <p>Теги: {{ implode(', ', $post->tags) }}</p>
                    @endif
                </div>

                @if($post->hasMedia('images'))
                    <div class="blog-image">
                        <img src="{{ $post->getFirstMediaUrl('images', 'full') }}" alt="{{ $post->title }}" class="img-fluid">
                    </div>
                @endif

                <div class="blog-content">
                    {!! $post->content !!}
                </div>
            </article>

            <div class="mt-4">
                <a href="{{ route('blog.index') }}" class="btn btn-secondary">Назад к списку</a>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
@endsection