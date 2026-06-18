@extends('pages.product_head.layout.app')


@section('content')

<style>
.activity-plan {
    font-size: 12px;
}

.activity-plan .card-header h4 {
    margin: 0;
    font-size: 18px;
}

.activity-plan table th {
    white-space: nowrap;
    font-size: 12px;
}

.activity-plan table td {
    vertical-align: middle;
}

.activity-plan .form-control {
    height: 32px;
    font-size: 12px;
}
</style>

<div class="container-fluid activity-plan" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h4>
                    Activity Planning — Assign Tasks, Dates & SOPs
                </h4>

                <small>
                    Each activity must have a planned start date,
                    end date, assigned person and SOP reference.
                </small>
            </div>

            <div>
                <a href="{{ route('pages.product-head.activity') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i>
                    Back
                </a>
            </div>

        </div>

        <div class="card-body">

            <!-- Order Details -->

            <div class="alert alert-info">
                <div><strong>Order :</strong> ORD-001 </div>
                <div> <strong>Customer :</strong> ABC Chemicals </div>
                <div> <strong>Product :</strong> Bio Fertilizer</div>




            </div>

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th width="300">Activity / Milestone</th>

                            <th>Planned Start</th>

                            <th>Planned End</th>

                            <th>Assigned To</th>

                            <th>Priority</th>

                            <th>SOP Reference</th>

                            <th width="50">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @php

                        $activities = [

                        'Order Review & Info Clarity',
                        'BOQ Preparation',
                        'Raw Material Arrangement',
                        'Technical Data Sheet Preparation',
                        'Packaging Instructions Finalization',
                        'Raw Material Weighing & Sieving',
                        'Technical Mixing',
                        'QC — Microbial Contamination Check',
                        'QC — CFU Count Verification',
                        'Secondary Packaging',
                        'Tertiary Packaging & Labelling',
                        'Packaging Integrity Verification',
                        'Invoicing & Document Preparation',
                        'Transport Booking & Logistics',
                        'Handover to Carrier'

                        ];

                        @endphp

                        @foreach($activities as $activity)

                        <tr>

                            <td>
                                {{ $activity }}
                            </td>

                            <td>
                                <input type="date" class="form-control">
                            </td>

                            <td>
                                <input type="date" class="form-control">
                            </td>

                            <td>

                                <select class="form-control">

                                    <option>
                                        -- Assign --
                                    </option>

                                    <option>
                                        Production Manager
                                    </option>

                                    <option>
                                        QC Manager
                                    </option>

                                    <option>
                                        Packaging Supervisor
                                    </option>

                                </select>

                            </td>

                            <td>

                                <select class="form-control">

                                    <option>Normal</option>

                                    <option>High</option>

                                    <option>Critical</option>

                                </select>

                            </td>

                            <td>

                                <input type="text" class="form-control" placeholder="SOP-001">

                            </td>

                            <td>

                                <button type="button" class="btn btn-danger btn-sm">

                                    ✕

                                </button>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <button class="btn btn-success btn-sm">

                <i class="fa fa-plus"></i>

                Add Activity

            </button>




        </div>

    </div>

</div>

@endsection