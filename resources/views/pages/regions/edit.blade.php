@extends('layouts.app')

@section('content')

<section class="main-content-wrapper">

    <section class="content-header">
        <h3 class="top-left-header">
            Edit Region
        </h3>
    </section>

    <div class="box-wrapper">
        <div class="table-box">

            <form action="{{ route('regions.update', $region->id) }}"
                  method="POST"
                  id="common-form">

                @csrf
                @method('PUT')

                @include('pages.regions.form')

            </form>

        </div>
    </div>

</section>

@endsection