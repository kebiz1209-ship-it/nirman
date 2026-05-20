@extends('layouts.app')

@section('content')

<section class="main-content-wrapper">

    <section class="content-header">
        <h3 class="top-left-header">
            Region List
        </h3>
    </section>

    <div class="box-wrapper">

        <div class="table-box">

            <div class="d-flex justify-content-between mb-3">

                <a href="{{ route('categories.create') }}"
                   class="btn bg-blue-btn">

                    Add Category

                </a>

            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($categories as $key => $category)

                            <tr>

                                <td>{{ $key + 1 }}</td>

                                <td>{{ $category->name }}</td>

                                <td>
                                    @if($category->status == 1)
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this category?')">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    No Data Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

@endsection