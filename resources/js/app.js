$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

clearModalOnClose('lecturerModal');

$(document).ready(function () {
    $('#big-query').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dashboard/big-query/dataTables',
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'gender',
                name: 'gender'
            },
            {
                data: 'frequency',
                name: 'frequency'
            },
            {
                data: 'year',
                name: 'year'
            },
            {
                data: 'action',
                className: "text-center",
                orderable: false,
                searchable: false
            }
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records"
        }
    });

    $('#lecturers').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dashboard/employee/dataTables',
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        columns: [{
                data: 'first_name',
                name: 'first_name'
            },
            {
                data: 'last_name',
                name: 'last_name'
            },
            {
                data: 'gender',
                name: 'gender'
            },
            {
                data: 'age',
                name: 'age'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },
            {
                data: 'action',
                className: "text-center",
                orderable: false,
                searchable: false
            }
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records"
        }
    });

    $('#employees-frequency').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dashboard/employee/frequency/dataTables',
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        columns: [{
                data: 'first_name',
                name: 'first_name'
            },
            {
                data: 'first_name_frequency',
                name: 'first_name_frequency'
            },
            {
                data: 'last_name',
                name: 'last_name'
            },
            {
                data: 'last_name_frequency',
                name: 'last_name_frequency'
            },
            {
                data: 'gender',
                name: 'gender'
            },
            {
                data: 'age',
                name: 'age'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            }
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records"
        }
    });

    changeTitleAndAction('lecturerTableBtnAdd', 'lecturerModalLabel', 'Add new lecturer', 'lecturerModalButton', 'Add new', 'Add');

    $('#lecturerModalButton').click(function (e) {
        e.preventDefault();

        if ($('#action').val() == 'Add') {
            let timerInterval;
            var first_name = document.getElementById('first_name').value;
            var last_name = document.getElementById('last_name').value;
            var age = document.getElementById('age').value;
            var gender = $("input[name=gender]:checked").val();
            var phone_number = document.getElementById('phone_number').value;
            var address = document.getElementById('address').value;

            $.ajax({
                url: '/dashboard/employee',
                method: "POST",
                data: {
                    'first_name': first_name,
                    'last_name': last_name,
                    'age': age,
                    'gender': gender,
                    'phone_number': phone_number,
                    'address': address,
                },
                beforeSend: () => {
                    Swal.fire({
                        title: 'Sending....',
                        html: '<span class="text-success">Waiting for data to be sent</span>',
                        timer: 100000,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                            timerInterval = setInterval(() => {
                                Swal.getTimerLeft();
                            }, 100)
                        },
                    })
                    
                },
                success: (data) => {
                    Swal.disableLoading();
                    // console.log(data);
                    if (data.errors) {
                        Swal.close();
                        forEachError(data);
                    } else if (data.message) {
                        Swal.close();
                        displayErrorMessage(data.message);
                    } else {
                        $(".lecturerModal").hide();
                        Swal.close();
                        clearInterval(timerInterval);

                        Swal.fire({
                            type: 'success',
                            title: 'Success!',
                            html: '<span class="text-success">Your page will be refreshed shortly.</span>',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    formatErrorMessage(jqXHR, errorThrown)
                }
            })
        }

        if ($('#action').val() == 'Edit') {
            let timerInterval;

            var id = document.getElementById("id").value;
            var first_name = document.getElementById('first_name').value;
            var last_name = document.getElementById('last_name').value;
            var age = document.getElementById('age').value;
            var gender = $("input[name=gender]:checked").val();
            var phone_number = document.getElementById('phone_number').value;
            var address = document.getElementById('address').value;

            $.ajax({
                url: '/dashboard/employee/update',
                method: "PUT",
                data: {
                    'id': id,
                    'first_name': first_name,
                    'last_name': last_name,
                    'age': age,
                    'gender': gender,
                    'phone_number': phone_number,
                    'address': address,
                },
                beforeSend: () => {
                    Swal.fire({
                        title: 'Sending....',
                        html: '<span class="text-success">Waiting for data to be sent</span>',
                        timer: 100000,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                            timerInterval = setInterval(() => {
                                Swal.getTimerLeft();
                            }, 100)
                        },
                    })
                },
                success: (data) => {
                    Swal.disableLoading();

                    if (data.errors) {
                        Swal.close();
                        forEachError(data);
                    } else if (data.message) {
                        Swal.close();
                        displayErrorMessage(data.message);
                    } else {
                        $(".lecturerModal").hide();
                        Swal.close();
                        clearInterval(timerInterval);

                        Swal.fire({
                            type: 'success',
                            title: 'Success!',
                            html: '<span class="text-success">Your page will be refreshed shortly.</span>',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                },
                error: (jqXHR, textStatus, errorThrown) => {
                    formatErrorMessage(jqXHR, errorThrown)
                }
            })
        }
    })
});

$(document).on('click', '.lecturerEdit', function(e) {
    e.preventDefault();

    var parentElement = $(this).parent('.lecturerParent');

    var id = $(parentElement).find('.id').val();

    let timerInterval;

    $.ajax({
        url: '/dashboard/employee/edit',
        method: "GET",
        dataType: 'JSON',
        data: {
            id: id
        },
        beforeSend: () => {
            Swal.fire({
                title: 'Sending....',
                html: '<span class="text-success">Waiting for data to be sent</span>',
                showConfirmButton: false,
                timer: 100000,
                onBeforeOpen: () => {
                    Swal.showLoading();
                    timerInterval = setInterval(() => {
                        Swal.getTimerLeft();
                    }, 100)
                },
            })  
        },
        success: (data) => {
            Swal.disableLoading();
            changeTitleAndAction('', 'lecturerModalLabel', 'Updating Lecturer', 'lecturerModalButton', 'Update', 'Edit');

            $('#id').val(id);

            $.each(data, function (k, v) {
                $("input[value='" + v.gender + "']").prop("checked", true);
                $("input[name=first_name]").val(v.first_name);
                $("input[name=last_name]").val(v.last_name);
                $("input[name=age]").val(v.age);
                $("input[name=address]").val(v.address);
                $("input[name=phone_number]").val(v.phone_number);

                Swal.close();
                $('.lecturerModal').modal('show');
                clearInterval(timerInterval);
            })
        },
        error: function (jqXHR, textStatus, errorThrown) {
            formatErrorMessage(jqXHR, errorThrown)
        }
    })
})

$(document).on('click', '.lecturerRemove', function (e) {
    e.preventDefault();

    var parentElement = $(this).parent('.lecturerParent');

    var id = $(parentElement).find('.id').val();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            // console.log(id);

            $.ajax({
                url: '/dashboard/employee/destroy',
                method: "DELETE",
                data: {
                    'id': id,
                    '_token': $('input[name=_token]').val()
                },
                beforeSend: () => {
                    Swal.fire({
                        title: 'Sending....',
                        html: '<span class="text-success">Waiting for data to be sent</span>',
                        timer: 100000,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        },
                    })
                },
                success: function (data) {
                    Swal.disableLoading();
                    if (data.message) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops!!!',
                            html: '<span class="text-danger">' + data.message + '</span>',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else {
                        Swal.fire({
                            type: 'success',
                            title: 'Successfully delete data!',
                            html: '<span class="text-success">Your page will be refreshed shortly.</span>',
                            showConfirmButton: false,
                            timer: 1000
                        }, )
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    formatErrorMessage(jqXHR, errorThrown)
                }
            })

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Cancel button is pressed
            Swal.fire({
                type: 'info',
                title: 'Your data is safe!',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });
});

function displayErrorMessage(message) {

    $('.customAlert').show();
    $('.customAlert').append("<div class='alert alert-danger alert-dismissible fade show' id='errorAlert' role='alert'><strong>" + message + "</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

    $(".alert-danger").fadeTo(2000, 1000).slideUp(1000, function () {
        $('.customAlert').empty();
        $(".alert-danger").slideUp(1000);
    });
}

function forEachError(data) {
    $.each(data.errors, function (key, value) {
        $('.customAlert').show();
        $('.customAlert').append("<div class='alert alert-danger alert-dismissible fade show' id='errorAlert' role='alert'><strong>" + value + "</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    });

    $(".alert-danger").fadeTo(2000, 1000).slideUp(1000, function () {
        $('.customAlert').empty();
        $(".alert-danger").slideUp(1000);
    });
}

function sweetAlertError(message) {
    Swal.fire({
        type: 'error',
        title: message,
        showConfirmButton: false,
        timer: 1500
    })
}

function formatErrorMessage(jqXHR, exception) {
    if (jqXHR.status === 0) {
        return (
            sweetAlertError('Not connected.\nPlease verify your network connection.')
        );
    } else if (jqXHR.status == 404) {
        return (
            sweetAlertError('The requested page not found.')
        );
    } else if (jqXHR.status == 401) {
        return (
            sweetAlertError('Sorry!! You session has expired. Please login to continue access.')
        );
    } else if (jqXHR.status == 500) {
        return (
            sweetAlertError('Internal Server Error.')
        );
    } else if (exception === 'parsererror') {
        return (
            sweetAlertError('Requested JSON parse failed.')
        );
    } else if (exception === 'timeout') {
        return (
            sweetAlertError('Time out error.')
        );
    } else if (exception === 'abort') {
        return (
            sweetAlertError('Ajax request aborted.')
        );
    } else {
        return (
            sweetAlertError('Unknown error occured. Please try again.')
        );
    }
}

function changeTitleAndAction(buttonID, modalLabel, labelText, modalButton, buttonText, actionValue) {
    if (buttonID != '') {
        $('#' + buttonID).click(function (e) {
            e.preventDefault();
            $('#' + modalLabel).text(labelText);
            $('#' + modalButton).text(buttonText);
            $('#action').val(actionValue);
        });
    } else {
        $('#' + modalLabel).text(labelText);
        $('#' + modalButton).text(buttonText);
        $('#action').val(actionValue);
    }
}

function clearModalOnClose(classProps) {
    $('.' + classProps).on("hidden.bs.modal", function () {
        if (classProps == 'lecturerModal') {
            $("input[name=first_name]").val("");
            $("input[name=last_name]").val("");
            $("input[name=age]").val("");
            $("input[name=gender]").prop('checked', false);
        }
    })
}