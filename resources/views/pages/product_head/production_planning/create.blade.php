@extends('layouts.app')

@section('title', 'Production Planning')

@section('content')

<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="font-weight-bold mb-1">
                Production Planning
            </h3>

            <small class="text-muted">
                Production scheduling, resource planning and manufacturing execution planning
            </small>
        </div>

        <div>
            <a href="#" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Create Planning
            </a>
        </div>

    </div>

    <form>

        <!-- =========================================
             BASIC ORDER DETAILS
        ========================================== -->

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-header bg-light">
                <h5 class="mb-0">
                    Basic Order Details
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Planning No</label>
                        <input type="text"
                               class="form-control"
                               value="PLAN-00001"
                               readonly>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Linked Order No</label>
                        <select class="form-control">
                            <option>Select Order</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Customer Name</label>
                        <input type="text"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Product Name</label>
                        <input type="text"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Priority</label>
                        <select class="form-control">
                            <option>Low</option>
                            <option>Medium</option>
                            <option>High</option>
                            <option>Urgent</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Order Quantity</label>
                        <input type="number"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Unit</label>
                        <select class="form-control">
                            <option>KG</option>
                            <option>LTR</option>
                            <option>PCS</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Delivery Deadline</label>
                        <input type="date"
                               class="form-control">
                    </div>

                </div>

            </div>

        </div>

        <!-- =========================================
             FORMULA DETAILS
        ========================================== -->

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-header bg-light">
                <h5 class="mb-0">
                    Formula Details
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Formula Version ID</label>
                        <input type="text"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Formula Type</label>
                        <select class="form-control">
                            <option>Standard</option>
                            <option>Client</option>
                            <option>Custom</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Base Compound Used</label>
                        <input type="text"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>QC Critical Points</label>
                        <input type="text"
                               class="form-control"
                               placeholder="pH, Viscosity">
                    </div>

                    <div class="col-md-12">
                        <label>Special Formula Instructions</label>
                        <textarea class="form-control"
                                  rows="3"></textarea>
                    </div>

                </div>

            </div>

        </div>

        <!-- =========================================
             BATCH PLANNING
        ========================================== -->

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-header bg-light">
                <h5 class="mb-0">
                    Batch Planning
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Planned Batch Size</label>
                        <input type="number"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>No of Batches Required</label>
                        <input type="number"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Batch Splitting Logic</label>
                        <select class="form-control">
                            <option>Auto</option>
                            <option>Manual</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Expected Yield %</label>
                        <input type="number"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Wastage Allowance %</label>
                        <input type="number"
                               class="form-control">
                    </div>

                </div>

            </div>

        </div>

        <!-- =========================================
             MACHINE ALLOCATION
        ========================================== -->

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-header bg-light">
                <h5 class="mb-0">
                    Machine / Line Allocation
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Production Line</label>
                        <select class="form-control"></select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Machine Type</label>
                        <input type="text"
                               class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Machine ID</label>
                        <input type="text"
                               class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Capacity / Hour</label>
                        <input type="number"
                               class="form-control">
                    </div>

                    <div class="col-md-1 mb-3">
                        <label>Setup</label>
                        <input type="number"
                               class="form-control">
                    </div>

                    <div class="col-md-1 mb-3">
                        <label>Cleaning</label>
                        <input type="number"
                               class="form-control">
                    </div>

                </div>

            </div>

        </div>

        <!-- =========================================
             RAW MATERIAL AVAILABILITY
        ========================================== -->

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-header bg-light">
                <h5 class="mb-0">
                    Raw Material Availability
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Material Status</label>
                        <select class="form-control">
                            <option>Available</option>
                            <option>Partial</option>
                            <option>Shortage</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Inventory Location</label>
                        <select class="form-control">
                            <option>Store</option>
                            <option>Warehouse</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Substitute Allowed</label>
                        <select class="form-control">
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Procurement Trigger</label>
                        <select class="form-control">
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                </div>

            </div>

        </div>

        <!-- =========================================
             PRODUCTION SCHEDULE
        ========================================== -->

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-header bg-light">
                <h5 class="mb-0">
                    Production Schedule
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Planned Start Date</label>
                        <input type="datetime-local"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Planned End Date</label>
                        <input type="datetime-local"
                               class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Shift</label>
                        <select class="form-control">
                            <option>Shift A</option>
                            <option>Shift B</option>
                            <option>Shift C</option>
                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Working Hours</label>
                        <input type="number"
                               class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Buffer Time</label>
                        <input type="number"
                               class="form-control">
                    </div>

                </div>

            </div>

        </div>

        <!-- =========================================
             MANPOWER
        ========================================== -->

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-header bg-light">
                <h5 class="mb-0">
                    Manpower Planning
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label>Supervisor Assigned</label>
                        <select class="form-control"></select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Operators Required</label>
                        <input type="number"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Skill Type Required</label>
                        <input type="text"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>QC Support Needed</label>
                        <select class="form-control">
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                </div>

            </div>

        </div>

        <!-- =========================================
             COSTING
        ========================================== -->

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-header bg-light">
                <h5 class="mb-0">
                    Cost & Efficiency
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-2 mb-3">
                        <label>Production Cost</label>
                        <input type="number" class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Energy Cost</label>
                        <input type="number" class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Labour Cost</label>
                        <input type="number" class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Machine Utilization %</label>
                        <input type="number" class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Target Cost/Unit</label>
                        <input type="number" class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label>Efficiency Target %</label>
                        <input type="number" class="form-control">
                    </div>

                </div>

            </div>

        </div>

        <!-- QC + RISK + APPROVAL -->

        <div class="row">

            <div class="col-md-4">

                <div class="card shadow-sm border-0 mb-3">

                    <div class="card-header bg-light">
                        Quality Control
                    </div>

                    <div class="card-body">

                        <label>QC Plan Required</label>
                        <select class="form-control mb-3">
                            <option>Yes</option>
                            <option>No</option>
                        </select>

                        <label>Critical Control Points</label>
                        <textarea class="form-control mb-3"></textarea>

                        <label>Sampling Frequency</label>
                        <input type="text" class="form-control mb-3">

                        <label>COA Required</label>
                        <select class="form-control">
                            <option>Yes</option>
                            <option>No</option>
                        </select>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card shadow-sm border-0 mb-3">

                    <div class="card-header bg-light">
                        Risk & Constraints
                    </div>

                    <div class="card-body">

                        <label>Risk Level</label>
                        <select class="form-control mb-3">
                            <option>Low</option>
                            <option>Medium</option>
                            <option>High</option>
                            <option>Critical</option>
                        </select>

                        <label>Production Bottleneck</label>
                        <input type="text" class="form-control mb-3">

                        <label>Material Shortage Risk</label>
                        <input type="text" class="form-control mb-3">

                        <label>Formula Stability Risk</label>
                        <input type="text" class="form-control mb-3">

                        <label>Regulatory Constraints</label>
                        <textarea class="form-control"></textarea>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card shadow-sm border-0 mb-3">

                    <div class="card-header bg-light">
                        Approval Section
                    </div>

                    <div class="card-body">

                        <label>Prepared By</label>
                        <select class="form-control mb-3"></select>

                        <label>Reviewed By</label>
                        <select class="form-control mb-3"></select>

                        <label>Approved By</label>
                        <select class="form-control mb-3"></select>

                        <label>Approval Status</label>
                        <select class="form-control">
                            <option>Draft</option>
                            <option>Scheduled</option>
                            <option>Approved</option>
                            <option>On Hold</option>
                            <option>Rejected</option>
                        </select>

                    </div>

                </div>

            </div>

        </div>

        <!-- SAVE -->

        <div class="text-right mb-4">

            <button class="btn btn-secondary">
                Save Draft
            </button>

            <button class="btn btn-success">
                Save & Schedule
            </button>

        </div>

    </form>

</div>

@endsection