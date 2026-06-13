@extends('layouts.app')

@section('content')

<div class="container-fluid" style="margin-left: 20px;">
    <div class="card">
        <div class="card-body">

        
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Demo Page</h3>

            </div>

            <a href="{{ route('pages.sales.dashboard') }}" class="btn btn-primary">
                Sales Person
            </a>

             <a href="{{ route('pages.product-head.dashboard') }}" class="btn btn-primary">
                Manufacturing head
            </a>

            <a href="{{ route('pages.production.dashboard') }}" class="btn btn-primary">
                Production
            </a>

             <a href="{{ route('pages.qc.dashboard') }}" class="btn btn-primary">
               Quality check (QC)
            </a>

            <a href="{{ route('pages.dispatch.dashboard') }}" class="btn btn-primary">
                Dispatch Team
            </a>



        </div>
    </div>
</div>

@endsection