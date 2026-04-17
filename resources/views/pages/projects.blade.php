@extends('layouts.app')
@section('title','Projects')

@section('content')
<div class="container my-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold display-5">Featured Portfolios</h2>
    <p class="text-muted lead">A showcase of dynamic AI platforms and applications.</p>
  </div>
  <div class="row g-4 justify-content-center">
    
    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0 bg-white">
        <div class="card-body p-4 text-center">
          <div class="mb-4 text-primary bg-primary bg-opacity-10 d-inline-flex p-3 rounded-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-robot" viewBox="0 0 16 16">
                <path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5ZM3 8.062C3 6.76 4.235 5.765 5.53 5.889a2.81 2.81 0 0 1 1.884-.336c1.155.228 2.378-.4 2.875-1.464a.5.5 0 0 1 .922.384c-.378.904-1.258 1.488-2.222 1.493a2.766 2.766 0 0 1-1.393.38c-.37-.023-.74-.08-1.077-.184-1.135-.35-2.235-.125-2.915.683-.695.824-.895 2.05-.333 3.013a.5.5 0 0 1-.864.502C1.512 8.948 2.213 7.558 3 8.062"/>
                <path d="M12.5 5a1.5 1.5 0 0 0-1.5 1.5V7a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 3 7V6.5A1.5 1.5 0 0 0 1.5 5 1.5 1.5 0 0 0 0 6.5v1A1.5 1.5 0 0 0 1.5 9h1A1.5 1.5 0 0 0 4 7.5V7h5v.5A1.5 1.5 0 0 0 10.5 9h1A1.5 1.5 0 0 0 13 7.5v-1A1.5 1.5 0 0 0 11.5 5Z"/>
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm11-1a3.992 3.992 0 0 0-.8-2H2.8a3.992 3.992 0 0 0-.8 2h12Z"/>
            </svg>
          </div>
          <h5 class="card-title fw-bold">Agent Client SDK</h5>
          <p class="card-text text-muted mb-4">A developer-focused library enabling seamless integration of AI agents into apps, supporting chatbots and function calling.</p>
          <a href="https://www.npmjs.com/package/@rizal_ncc/agent-client" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">View NPM Package</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0 bg-white">
        <div class="card-body p-4 text-center">
          <div class="mb-4 text-primary bg-primary bg-opacity-10 d-inline-flex p-3 rounded-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-window" viewBox="0 0 16 16">
              <path d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
              <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm13 2v2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zM1 13V6h14v7a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z"/>
            </svg>
          </div>
          <h5 class="card-title fw-bold">AI Agent Service</h5>
          <p class="card-text text-muted mb-4">An intelligent platform for contextual AI chatbots, featuring Learning Assistants, Mentors, and AI Smart Search.</p>
          <a href="https://ncc.bawana.com/" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">View BAWANA LMS</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0 bg-white">
        <div class="card-body p-4 text-center">
          <div class="mb-4 text-info bg-info bg-opacity-10 d-inline-flex p-3 rounded-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
              <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.91 4a9.27 9.27 0 0 0-.64-1.539 6.7 6.7 0 0 0-.597-.933A7.025 7.025 0 0 1 13.745 4h-1.835z"/>
            </svg>
          </div>
          <h5 class="card-title fw-bold">ClimaFund Platform</h5>
          <p class="card-text text-muted mb-4">A sustainability platform leveraging Google Earth Engine to translate complex satellite data into mangrove monitoring details.</p>
          <a href="https://climafund.co/" target="_blank" class="btn btn-outline-info btn-sm rounded-pill px-3">View Climafund</a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection