@extends('layouts.app')

@php
    $baseURL = getBaseURL();
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ $baseURL . 'frequent_changing/css/outlet.css' }}">
@endpush

@section('content')
    @php
        $baseURL = getBaseURL();
        $setting = getSettingsInfo();
        $base_color = '#6ab04c';
        if (isset($setting->base_color) && $setting->base_color) {
            $base_color = $setting->base_color;
        }
    @endphp
    <section class="main-content-wrapper">
        @include('utilities.messages')
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header">{{ isset($title) && $title ? $title : '' }}</h2>
                    <input type="hidden" class="datatable_name" data-title="{{ isset($title) && $title ? $title : '' }}"
                        data-id_name="datatable">
                </div>
                <div class="col-md-6 justify-content-end">
                    @if (routePermission('add-outlet'))
                        <a class="btn bg-blue-btn" href="{{ route('outlets.create') }}">
                            <iconify-icon icon="solar:add-circle-broken"></iconify-icon>
                            @lang('index.add_outlet')
                        </a>
                    @endif
                </div>
            </div>
        </section>

        <div class="outlets-grid-container">
            <div class="row">
                @if ($obj && !empty($obj))
                    @foreach ($obj as $value)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="outlet-card">
                                <div class="outlet-card-header">
                                    <div class="outlet-icon">
                                        <iconify-icon icon="solar:shop-2-bold" class="shop-icon"></iconify-icon>
                                    </div>
                                    <h4 class="outlet-title">{{ $value->outlet_name }}</h4>
                                    <div class="d-flex justify-content-between">
                                        <div class="outlet-code">
                                            <strong>@lang('index.outlet_code'): {{ $value->outlet_code }}</strong>
                                        </div>
                                        <div class="outlet-status">
                                            @if ($value->outlet_status == 'active')
                                                <span>{{ __('index.active') }}</span>
                                            @else
                                                <span>{{ __('index.inactive') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="outlet-card-body">
                                    <div class="outlet-info">
                                        <div class="info-item">
                                            <p>{{ $value->outlet_address }}</p>
                                        </div>
                                        <div class="info-item">
                                            <p>{{ $value->outlet_phone }}</p>
                                        </div>
                                        @if ($value->outlet_email)
                                            <div class="info-item">
                                                <p>{{ $value->outlet_email }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="outlet-card-footer">
                                    <div class="outlet-actions">
                                        @if (routePermission('edit-outlet'))
                                            <a href="{{ url('outlets') }}/{{ encrypt_decrypt($value->id, 'encrypt') }}/edit"
                                                class="btn btn-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="@lang('index.edit')">
                                                <iconify-icon icon="solar:pen-bold"></iconify-icon>
                                                @lang('index.edit')
                                            </a>
                                        @endif
                                        @if (routePermission('delete-outlet'))
                                            <a href="#" class="btn btn-delete delete"
                                                data-form_class="alertDelete{{ $value->id }}" type="submit"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('index.delete')">
                                                <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                                @lang('index.delete')
                                                <form action="{{ route('outlets.destroy', $value->id) }}"
                                                    class="alertDelete{{ $value->id }}" method="post"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="outlet-enter">
                                        <a href="{{ route('outlets.select', encrypt_decrypt($value->id, 'encrypt')) }}"
                                            class="btn btn-enter">
                                            <iconify-icon icon="solar:arrow-right-bold"></iconify-icon>
                                            @lang('index.enter')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center p-4">
                            <p class="text-muted">@lang('index.no_outlets_found')</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{!! $baseURL . 'assets/datatable_custom/jquery-3.3.1.js' !!}"></script>
    <script src="{!! $baseURL . 'frequent_changing/js/custom_report.js' !!}"></script>
@endsection
