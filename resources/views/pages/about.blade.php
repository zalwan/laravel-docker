@extends('layouts.app')
@section('title', 'About')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-5">
                    <h1 class="fw-bold mb-4">Work Experience</h1>
                    
                    <div class="mb-4 pb-4 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="fw-bold mb-0">PT Netpolitan Cipta Cakrabuana</h4>
                            <span class="badge bg-secondary text-white rounded-pill px-3 py-2">Oct 2025 - Present</span>
                        </div>
                        <h6 class="text-primary mb-3">Full-Stack Developer &mdash; Tangerang, Indonesia</h6>
                        <ul class="text-muted">
                            <li>Led end-to-end development of AI-powered features for an LMS platform across web and mobile.</li>
                            <li>Built and integrated APIs with LLM (OpenAI) enabling intelligent automation.</li>
                            <li>Developed course recommendation systems and AI agents with function calling integration.</li>
                        </ul>
                    </div>

                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="fw-bold mb-0">CHANGEMAKR ASIA</h4>
                            <span class="badge bg-secondary text-white rounded-pill px-3 py-2">May 2025 - Present</span>
                        </div>
                        <h6 class="text-primary mb-3">Principal Engineer &amp; Full Stack Engineer &mdash; Singapore</h6>
                        <ul class="text-muted">
                            <li>Lead technical direction and architecture for scalable web and mobile applications in an async-first environment.</li>
                            <li>Drive end-to-end development ensuring performance and maintainability.</li>
                            <li>Built scalable web applications and developed responsive interfaces with consistent UI/UX.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-4">Technical Skills</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-start py-3 border-bottom">
                            <div>
                                <h6 class="fw-bold mb-1">AI & LLM Integration <span class="badge bg-info text-dark ms-2">Intermediate</span></h6>
                                <p class="text-muted small mb-0">OpenAI API, Prompt Engineering, AI Agents, Function Calling</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start py-3 border-bottom">
                            <div>
                                <h6 class="fw-bold mb-1">Full-Stack Development <span class="badge bg-info text-dark ms-2">Intermediate</span></h6>
                                <p class="text-muted small mb-0">React.js, CodeIgniter, Django, Golang (Echo), Node.js, Express.js, Nestjs, WordPress, REST API</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start py-3 border-bottom-0">
                            <div>
                                <h6 class="fw-bold mb-1">Mobile Development <span class="badge bg-success ms-2">Advanced</span></h6>
                                <p class="text-muted small mb-0">Flutter, Bloc, Provider, Cross-platform, Mobile UI, REST Integration</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
