@extends('layouts.app')

@section('content')

<section class="main-content-wrapper">

    <section class="content-header">
        <h3 class="top-left-header">
            Add Region
        </h3>
    </section>

    <div class="box-wrapper">
        <div class="table-box">

            <form action="{{ route('regions.store') }}"
                  method="POST"
                  id="common-form">

                @csrf

                @include('pages.regions.form')

            </form>

        </div>
    </div>

</section>

@endsection