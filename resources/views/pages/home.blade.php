@extends('layouts.app')
@section('title','Home')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center pt-2">
      <img src="{{ asset('images/profile.jpg') }}" alt="Rizal Suryawan" class="rounded-circle shadow mb-4" width="160" height="160" style="object-fit: cover; border: 4px solid #fff;">
      <h1 class="display-4 fw-bold mb-5">Hello, I'm Rizal Suryawan</h1>
      <p class="lead text-muted mb-5">
        Software Engineer with 5+ years of experience, currently serving as Principal Engineer.<br>
        Leading technical decisions and building scalable web/mobile applications with a focus on AI integration and full-stack architectures.
      </p>
      <div class="d-flex justify-content-center gap-3 mt-5">
        <a href="/projects" class="btn btn-primary btn-lg px-4 shadow-sm">View My Projects</a>
        <a href="/about" class="btn btn-outline-secondary btn-lg px-4">More About Me</a>
      </div>
    </div>
  </div>
</div>
@endsection