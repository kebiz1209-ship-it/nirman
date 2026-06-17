@extends('layouts.app')

@section('content')

<div class="container-fluid" style="margin-left:20px;">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Packaging Category List</h4>

            <a href="{{ route('packagingcategory.create') }}"
               class="btn btn-primary btn-sm">
                Add Category
            </a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Category Code</th>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->category_code }}</td>
                        <td>{{ $category->status }}</td>
                        <td>{{ $category->description }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection