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

                <a href="{{ route('regions.create') }}"
                   class="btn bg-blue-btn">

                    Add Region

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
                            <th>Region Name</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($regions as $key => $region)

                            <tr>

                                <td>{{ $key + 1 }}</td>

                                <td>{{ $region->name }}</td>

                                <td>
                                    @if($region->status == 1)
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

                                    <a href="{{ route('regions.edit', $region->id) }}"
                                       class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <form action="{{ route('regions.destroy', $region->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this region?')">

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