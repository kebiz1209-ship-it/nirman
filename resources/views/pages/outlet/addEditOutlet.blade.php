@extends('layouts.app')
@section('script_top')
@endsection

@section('content')
    <section class="main-content-wrapper">
        <section class="content-header">
            <h3 class="top-left-header">
                {{ isset($title) && $title ? $title : '' }}
            </h3>
        </section>


        <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">
                <!-- form start -->
                {!! Form::model(isset($obj) && $obj ? $obj : '', [
                    'method' => isset($obj) && $obj ? 'PATCH' : 'POST',
                    'route' => isset($obj) && $obj ? ['outlets.update', encrypt_decrypt($obj->id, 'encrypt')] : 'outlets.store',
                ]) !!}
                @csrf
                <div>
                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-6">
                            <div class="form-group">
                                <label for="outlet_name" class="col-form-label">@lang('index.outlet_name') <span
                                        class="required_star">*</span></label>
                                <input type="text" name="outlet_name" id="outlet_name"
                                    class="form-control @error('outlet_name') is-invalid @enderror"
                                    placeholder="{{ __('index.outlet_name') }}"
                                    value="{{ isset($obj) && $obj->outlet_name ? $obj->outlet_name : old('outlet_name') }}">
                                @error('outlet_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-6">
                            <div class="form-group">
                                <label for="outlet_phone" class="col-form-label">@lang('index.outlet_phone') <span
                                        class="required_star">*</span></label>
                                <input type="text" name="outlet_phone" id="outlet_phone"
                                    class="form-control @error('outlet_phone') is-invalid @enderror"
                                    placeholder="{{ __('index.outlet_phone') }}"
                                    value="{{ isset($obj) && $obj->outlet_phone ? $obj->outlet_phone : old('outlet_phone') }}">
                                @error('outlet_phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-6">
                            <div class="form-group">
                                <label for="outlet_email" class="col-form-label">@lang('index.outlet_email')</label>
                                <input type="email" name="outlet_email" id="outlet_email"
                                    class="form-control @error('outlet_email') is-invalid @enderror"
                                    placeholder="{{ __('index.outlet_email') }}"
                                    value="{{ isset($obj) && $obj->outlet_email ? $obj->outlet_email : old('outlet_email') }}">
                                @error('outlet_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-6">
                            <div class="form-group">
                                <label for="outlet_status" class="col-form-label">@lang('index.outlet_status') <span
                                        class="required_star">*</span></label>
                                <select name="outlet_status" id="outlet_status"
                                    class="form-control @error('outlet_status') is-invalid @enderror">
                                    <option value="">{{ __('index.select_status') }}</option>
                                    <option value="active"
                                        {{ (isset($obj) && $obj->outlet_status == 'active') || old('outlet_status') == 'active' ? 'selected' : '' }}>
                                        {{ __('index.active') }}</option>
                                    <option value="inactive"
                                        {{ (isset($obj) && $obj->outlet_status == 'inactive') || old('outlet_status') == 'inactive' ? 'selected' : '' }}>
                                        {{ __('index.inactive') }}</option>
                                </select>
                                @error('outlet_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2">
                            <div class="form-group">
                                <label for="outlet_address" class="col-form-label">@lang('index.outlet_address') <span
                                        class="required_star">*</span></label>
                                <textarea name="outlet_address" id="outlet_address" rows="3"
                                    class="form-control @error('outlet_address') is-invalid @enderror" placeholder="{{ __('index.outlet_address') }}">{{ isset($obj) && $obj->outlet_address ? $obj->outlet_address : old('outlet_address') }}</textarea>
                                @error('outlet_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="row mt-2">
                    <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                        <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon
                                icon="solar:check-circle-broken"></iconify-icon>@lang('index.submit')</button>
                        <a class="btn bg-second-btn" href="{{ route('outlets.index') }}"><iconify-icon
                                icon="solar:round-arrow-left-broken"></iconify-icon>@lang('index.back')</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

@section('script_bottom')
@endsection
