@extends('layouts.app')

@section('content')

<section class="main-content-wrapper">

    <section class="content-header">
        <h3 class="top-left-header">
            Add Category
        </h3>
    </section>

    <div class="box-wrapper">
        <div class="table-box">

            <form action="{{ route('categories.store') }}"
                  method="POST"
                  id="common-form">

                @csrf

                @include('pages.categories.form')

            </form>

        </div>
    </div>

</section>

@endsection