<style>

/* =========================================
   PROCESS TABLE UI
========================================== */

.process-table{
    table-layout: fixed;
    width: 100%;
}

.process-table th,
.process-table td{
    vertical-align: middle !important;
    font-size: 11px;
    padding: 6px !important;
}

.process-table thead th{
    background: #f3f4f6;
    font-weight: 700;
    color: #111827;
    white-space: nowrap;
    text-align: center;
}

.process-table .form-control{
    height: 32px;
    font-size: 11px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    padding: 4px 8px;
    box-shadow: none;
    width: 100%;
}

.process-table textarea.form-control{
    height: 55px;
    resize: vertical;
}

.process-table .btn-sm{
    font-size: 10px;
    padding: 4px 8px;
    border-radius: 6px;
}

.section-title{
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #1f2937;
}

.table-responsive{
    overflow-x: auto;
}

.process-table td input,
.process-table td select,
.process-table td textarea{
    min-width: 100%;
}

</style>



<!-- =========================================
     OVERALL PRODUCTION TIME
========================================== -->

<div class="border rounded p-3 mb-3">

    <div class="section-title">
        Entire Production Process Time
    </div>

    <div class="row">

        <div class="col-md-3">

            <label>Minimum Days</label>

            <input type="text"
                   name="production_min_time"
                   class="form-control"
                   placeholder="e.g. 2 Days">

        </div>

        <div class="col-md-3">

            <label>Maximum Days</label>

            <input type="text"
                   name="production_max_time"
                   class="form-control"
                   placeholder="e.g. 5 Days">

        </div>

    </div>

</div>



<!-- =========================================
     PROCESS TABLE
========================================== -->

<div class="table-responsive">

    <table class="table table-bordered process-table">

        <thead>

            <tr>

                <th width="4%">#</th>
                <th width="16%">Process</th>
                <th width="7%">Seq</th>
                <th width="10%">Min Days</th>
                <th width="10%">Max Days</th>
                <th width="12%">Duration</th>
                <th width="14%">SOP</th>
                <th width="27%">Description</th>

            </tr>

        </thead>

        <tbody id="process-wrapper">

            <!-- =========================================
                 PROCESS ROW
            ========================================== -->

            <tr class="process-row">

                <!-- SERIAL -->
                <td>1</td>

                <!-- PROCESS -->
                <td>

                    <select name="process[0][name]" class="form-control">

                        <option value="">Select</option>

                        <option value="Mixing">Mixing</option>
                        <option value="Heating">Heating</option>
                        <option value="Cooling">Cooling</option>
                        <option value="Filling">Filling</option>
                        <option value="Packing">Packing</option>
                        <option value="Quality Check">Quality Check</option>

                    </select>

                </td>

                <!-- SEQUENCE -->
                <td>

                    <input type="number"
                           name="process[0][sequence]"
                           class="form-control"
                           value="1">

                </td>

                <!-- MIN DAYS -->
                <td>

                    <input type="number"
                           name="process[0][min_days]"
                           class="form-control"
                           placeholder="Min">

                </td>

                <!-- MAX DAYS -->
                <td>

                    <input type="number"
                           name="process[0][max_days]"
                           class="form-control"
                           placeholder="Max">

                </td>

                <!-- DURATION -->
                <td>

                    <input type="text"
                           name="process[0][duration]"
                           class="form-control"
                           placeholder="Duration">

                </td>

                <!-- SOP -->
                <td>

                    <input type="file"
                           name="process[0][sop_upload]"
                           class="form-control">

                </td>

                <!-- DESCRIPTION -->
                <td>

                    <textarea name="process[0][description]"
                              class="form-control"
                              placeholder="Enter Description"></textarea>

                </td>

            </tr>

        </tbody>

    </table>

</div>



<!-- =========================================
     ADD PROCESS BUTTON
========================================== -->

<button type="button"
        class="btn btn-success btn-sm mt-2"
        id="add-process-row">

    + Add Process

</button>



<script>

$(function () {

    /* =========================================
       ADD PROCESS ROW
    ========================================== */

    $('#add-process-row').click(function () {

        let index = $('.process-row').length;

        let processRow = $('.process-row:first').prop('outerHTML');



        /* =========================================
           UPDATE INDEX
        ========================================== */

        processRow = processRow.replaceAll(
            'process[0]',
            'process[' + index + ']'
        );



        /* =========================================
           APPEND ROW
        ========================================== */

        $('#process-wrapper').append(processRow);



        /* =========================================
           LAST ROW
        ========================================== */

        let lastProcessRow =
            $('#process-wrapper .process-row:last');



        /* =========================================
           RESET VALUES
        ========================================== */

        lastProcessRow.find('select').val('');

        lastProcessRow.find('textarea').val('');

        lastProcessRow
            .find('input:not([type=file])')
            .val('');



        /* =========================================
           UPDATE SERIAL NUMBER
        ========================================== */

        lastProcessRow.find('td:first')
            .text(index + 1);



        /* =========================================
           DEFAULT SEQUENCE
        ========================================== */

        lastProcessRow
            .find('input[name*="[sequence]"]')
            .val(index + 1);

    });

});

</script>