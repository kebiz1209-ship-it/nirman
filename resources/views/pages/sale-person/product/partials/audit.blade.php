<!-- =========================================
     ACTIVITY LOG
========================================= -->

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Activity Log</h5>

        <button type="button"
                class="btn btn-primary btn-sm"
                id="addActivity">
            + Add Activity
        </button>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Action</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>

                <tbody id="activityTableBody">

    <tr>
        <td>1</td>
        <td>
            <input type="date"
                   name="activity_date[]"
                   class="form-control"
                   value="2026-01-01">
        </td>

        <td>
            <select name="activity_user[]" class="form-control">
                <option value="">Select User</option>
                <option value="Admin" selected>Admin</option>
                <option value="R&D Head">R&D Head</option>
                <option value="QA Head">QA Head</option>
                <option value="Production">Production</option>
                <option value="Store Manager">Store Manager</option>
            </select>
        </td>

        <td>
            <select name="activity_action[]" class="form-control">
                <option value="">Select Action</option>
                <option value="Created" selected>Created</option>
                <option value="Modified">Modified</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Used in Batch">Used in Batch</option>
            </select>
        </td>

        <td>
            <button type="button" class="btn btn-danger btn-sm removeActivity">
                Remove
            </button>
        </td>
    </tr>

    <tr>
        <td>2</td>
        <td><input type="date" name="activity_date[]" class="form-control" value="2026-01-05"></td>

        <td>
            <select name="activity_user[]" class="form-control">
                <option value="">Select User</option>
                <option value="Admin">Admin</option>
                <option value="R&D Head" selected>R&D Head</option>
                <option value="QA Head">QA Head</option>
                <option value="Production">Production</option>
                <option value="Store Manager">Store Manager</option>
            </select>
        </td>

        <td>
            <select name="activity_action[]" class="form-control">
                <option value="">Select Action</option>
                <option value="Created">Created</option>
                <option value="Modified" selected>Modified</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Used in Batch">Used in Batch</option>
            </select>
        </td>

        <td>
            <button type="button" class="btn btn-danger btn-sm removeActivity">
                Remove
            </button>
        </td>
    </tr>

    <tr>
        <td>3</td>
        <td><input type="date" name="activity_date[]" class="form-control" value="2026-01-08"></td>

        <td>
            <select name="activity_user[]" class="form-control">
                <option value="">Select User</option>
                <option value="Admin">Admin</option>
                <option value="R&D Head">R&D Head</option>
                <option value="QA Head" selected>QA Head</option>
                <option value="Production">Production</option>
                <option value="Store Manager">Store Manager</option>
            </select>
        </td>

        <td>
            <select name="activity_action[]" class="form-control">
                <option value="">Select Action</option>
                <option value="Created">Created</option>
                <option value="Modified">Modified</option>
                <option value="Approved" selected>Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Used in Batch">Used in Batch</option>
            </select>
        </td>

        <td>
            <button type="button" class="btn btn-danger btn-sm removeActivity">
                Remove
            </button>
        </td>
    </tr>

    <tr>
        <td>4</td>
        <td><input type="date" name="activity_date[]" class="form-control" value="2026-01-15"></td>

        <td>
            <select name="activity_user[]" class="form-control">
                <option value="">Select User</option>
                <option value="Admin">Admin</option>
                <option value="R&D Head">R&D Head</option>
                <option value="QA Head">QA Head</option>
                <option value="Production" selected>Production</option>
                <option value="Store Manager">Store Manager</option>
            </select>
        </td>

        <td>
            <select name="activity_action[]" class="form-control">
                <option value="">Select Action</option>
                <option value="Created">Created</option>
                <option value="Modified">Modified</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Used in Batch" selected>Used in Batch</option>
            </select>
        </td>

        <td>
            <button type="button" class="btn btn-danger btn-sm removeActivity">
                Remove
            </button>
        </td>
    </tr>

</tbody>
            </table>
        </div>

    </div>
</div>


<script>
$(document).on('click', '#addActivity', function () {

    let rowCount = $('#activityTableBody tr').length + 1;

    let row = `
        <tr>
            <td>${rowCount}</td>

            <td>
                <input type="date"
                       name="activity_date[]"
                       class="form-control">
            </td>

            <td>
                <select name="activity_user[]" class="form-control">
                    <option value="">Select User</option>
                    <option value="Admin">Admin</option>
                    <option value="R&D Head">R&D Head</option>
                    <option value="QA Head">QA Head</option>
                    <option value="Production">Production</option>
                    <option value="Store Manager">Store Manager</option>
                </select>
            </td>

            <td>
                <select name="activity_action[]" class="form-control">
                    <option value="">Select Action</option>
                    <option value="Created">Created</option>
                    <option value="Modified">Modified</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Used in Batch">Used in Batch</option>
                </select>
            </td>

            <td>
                <button type="button"
                        class="btn btn-danger btn-sm removeActivity">
                    Remove
                </button>
            </td>
        </tr>
    `;

    $('#activityTableBody').append(row);
});

$(document).on('click', '.removeActivity', function () {

    $(this).closest('tr').remove();

    $('#activityTableBody tr').each(function (index) {
        $(this).find('td:first').text(index + 1);
    });

});
</script>