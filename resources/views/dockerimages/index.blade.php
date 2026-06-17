@extends('laravel-usp-theme::master')
@section('content')
<div class="card">
    <div>
        <p>Imagens docker:</p>
    </div>
    <div>
        <ul>
            @foreach ($docker_images as $image)
                <li><a href="/dockerimages/{{ $image->id }}">{{ $image->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>

@endsection