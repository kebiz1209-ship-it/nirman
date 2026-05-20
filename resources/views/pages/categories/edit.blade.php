@extends('layouts.app')

@section('content')

<section class="main-content-wrapper">

    <section class="content-header">
        <h3 class="top-left-header">
            Edit Category
        </h3>
    </section>

    <div class="box-wrapper">
        <div class="table-box">

            <form action="{{ route('categories.update', $category->id) }}"
                  method="POST"
                  id="common-form">

                @csrf
                @method('PUT')

                @include('pages.categories.form')

            </form>

        </div>
    </div>

</section>

@endsection