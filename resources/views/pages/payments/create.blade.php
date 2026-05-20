@extends('layouts.app')

@section('content')

<section class="main-content-wrapper">

    <section class="content-header">
        <h3 class="top-left-header">
            Add Payment
        </h3>
    </section>

    <div class="box-wrapper">
        <div class="table-box">

            <form action="{{ route('payments.store') }}"
                  method="POST"
                  id="common-form">

                @csrf

                @include('pages.payments.form')

            </form>

        </div>
    </div>

</section>

@endsection