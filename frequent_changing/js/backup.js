// Backup Management JavaScript - Standalone version without Blade template syntax
$(document).ready(function () {
    "use strict";

    let base_url = $("#hidden_base_url").val();

    // Language strings from hidden inputs
    let hidden_alert = $("#hidden_alert").val();
    let hidden_cancel = $("#hidden_cancel").val();
    let hidden_ok = $("#hidden_ok").val();
    let create_backup = $("#create_backup").val();
    let are_you_sure_create_backup = $("#are_you_sure_create_backup").val();
    let yes_create = $("#yes_create").val();
    let restore_backup = $("#restore_backup").val();
    let are_you_sure_restore_backup = $("#are_you_sure_restore_backup").val();
    let yes_restore = $("#yes_restore").val();
    let delete_backup = $("#delete_backup").val();
    let are_you_sure_delete_backup = $("#are_you_sure_delete_backup").val();
    let yes_delete = $("#yes_delete").val();
    let success = $("#success").val();
    let error = $("#error").val();
    let backup_exists = $("#backup_exists").val();
    let today_backup_exists_message = $("#today_backup_exists_message").val();
    let backup_created_successfully = $("#backup_created_successfully").val();
    let backup_restored_successfully = $("#backup_restored_successfully").val();
    let backup_failed = $("#backup_failed").val();
    let restore_failed = $("#restore_failed").val();
    let something_went_wrong = $("#something_went_wrong").val();
    let creating_backup = $("#creating_backup").val();
    let restoring_backup = $("#restoring_backup").val();
    let backup_completed = $("#backup_completed").val();
    let restore_completed = $("#restore_completed").val();
    let failed_to_load_backup_details = $(
        "#failed_to_load_backup_details"
    ).val();

    // Create Backup Button Click
    $(document).on("click", "#createBackupBtn", function () {
        swal(
            {
                title: create_backup,
                text: are_you_sure_create_backup,
                icon: "question",
                showCancelButton: true,
                confirmButtonText: yes_create,
                cancelButtonText: hidden_cancel,
                confirmButtonColor: "#3c8dbc",
            },
            function (isConfirm) {
                if (isConfirm) {
                    createBackup();
                }
            }
        );
    });

    // View Backup Details
    $(document).on("click", ".view-backup", function () {
        let filename = $(this).data("filename");
        loadBackupDetails(filename);
    });

    // Restore Backup
    $(document).on("click", ".restore-backup", function () {
        let filename = $(this).data("filename");
        swal(
            {
                title: restore_backup,
                text: are_you_sure_restore_backup,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: yes_restore,
                cancelButtonText: hidden_cancel,
                confirmButtonColor: "#3c8dbc",
            },
            function (isConfirm) {
                if (isConfirm) {
                    restoreBackup(filename);
                }
            }
        );
    });

    // Delete Backup
    $(document).on("click", ".delete-backup", function () {
        let filename = $(this).data("filename");
        swal(
            {
                title: delete_backup,
                text: are_you_sure_delete_backup,
                icon: "error",
                showCancelButton: true,
                confirmButtonText: yes_delete,
                cancelButtonText: hidden_cancel,
                confirmButtonColor: "#d33",
            },
            function (isConfirm) {
                if (isConfirm) {
                    deleteBackup(filename);
                }
            }
        );
    });

    /**
     * Create Backup Function
     */
    function createBackup() {
        showProgress(creating_backup, 0);

        let progress = 0;
        let interval = setInterval(function () {
            progress += Math.random() * 30;
            if (progress > 90) progress = 90;
            updateProgress(progress, creating_backup + "...");
        }, 500);

        $.ajax({
            url: base_url + "backup/manual",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                clearInterval(interval);
                if (response.success) {
                    updateProgress(100, backup_completed);
                    setTimeout(function () {
                        hideProgress();
                        swal(
                            {
                                title: success,
                                text: backup_created_successfully,
                                icon: "success",
                                confirmButtonText: hidden_ok,
                            },
                            function () {
                                location.reload();
                            }
                        );
                    }, 1000);
                } else {
                    clearInterval(interval);
                    hideProgress();
                    swal({
                        title: error,
                        text: backup_failed,
                        icon: "error",
                        confirmButtonText: hidden_ok,
                    });
                }
            },
            error: function () {
                clearInterval(interval);
                hideProgress();
                swal({
                    title: error,
                    text: something_went_wrong,
                    icon: "error",
                    confirmButtonText: hidden_ok,
                });
            },
        });
    }

    /**
     * Restore Backup Function
     * @param {string} filename
     */
    function restoreBackup(filename) {
        showProgress(restoring_backup, 0);

        let progress = 0;
        let interval = setInterval(function () {
            progress += Math.random() * 25;
            if (progress > 90) progress = 90;
            updateProgress(progress, restoring_backup + "...");
        }, 500);

        $.ajax({
            url: base_url + "backup/restore/" + filename,
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                clearInterval(interval);
                if (response.success) {
                    updateProgress(100, restore_completed);
                    setTimeout(function () {
                        hideProgress();
                        swal({
                            title: success,
                            text: backup_restored_successfully,
                            icon: "success",
                            confirmButtonText: hidden_ok,
                        });
                    }, 1000);
                } else {
                    clearInterval(interval);
                    hideProgress();
                    swal({
                        title: error,
                        text: restore_failed,
                        icon: "error",
                        confirmButtonText: hidden_ok,
                    });
                }
            },
            error: function () {
                clearInterval(interval);
                hideProgress();
                swal({
                    title: error,
                    text: something_went_wrong,
                    icon: "error",
                    confirmButtonText: hidden_ok,
                });
            },
        });
    }

    /**
     * Delete Backup Function
     * @param {string} filename
     */
    function deleteBackup(filename) {
        $.ajax({
            url: base_url + "backup/delete/" + filename,
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    swal(
                        {
                            title: success,
                            text: response.message,
                            icon: "success",
                            confirmButtonText: hidden_ok,
                        },
                        function () {
                            location.reload();
                        }
                    );
                } else {
                    swal({
                        title: error,
                        text: response.error,
                        icon: "error",
                        confirmButtonText: hidden_ok,
                    });
                }
            },
            error: function () {
                swal({
                    title: error,
                    text: something_went_wrong,
                    icon: "error",
                    confirmButtonText: hidden_ok,
                });
            },
        });
    }

    /**
     * Load Backup Details Function
     * @param {string} filename
     */
    function loadBackupDetails(filename) {
        $.get(base_url + "backup/details/" + filename, function (response) {
            $("#modalFilename").text(response.filename);
            $("#modalTotalTables").text(response.total_tables);

            let tablesHtml = "";
            response.tables.forEach(function (table, index) {
                tablesHtml += "<tr>";
                tablesHtml += "<td>" + (index + 1) + "</td>";
                tablesHtml += "<td>" + table.name + "</td>";
                tablesHtml += "<td>" + table.rows.toLocaleString() + "</td>";
                tablesHtml += "</tr>";
            });

            $("#tablesListBody").html(tablesHtml);
            $("#backupDetailsModal").modal("show");
        }).fail(function () {
            swal({
                title: error,
                text: failed_to_load_backup_details,
                icon: "error",
                confirmButtonText: hidden_ok,
            });
        });
    }

    /**
     * Show Progress Function
     * @param {string} message
     * @param {number} percent
     */
    function showProgress(message, percent) {
        $("#progressMessage").text(message);
        $("#progressText").text(Math.round(percent) + "%");
        $("#progressBar").css("width", percent + "%");
        $("#progressContainer").show();
    }

    /**
     * Update Progress Function
     * @param {number} percent
     * @param {string} message
     */
    function updateProgress(percent, message) {
        $("#progressText").text(Math.round(percent) + "%");
        $("#progressBar").css("width", percent + "%");
        if (message) {
            $("#progressMessage").text(message);
        }
    }

    /**
     * Hide Progress Function
     */
    function hideProgress() {
        $("#progressContainer").hide();
    }
});
