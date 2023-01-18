
function deleteData(url) {
    Swal.fire({
        title: "Are you sure?",
        // text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        confirmButtonClass: "btn btn-warning mr-10",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    "_token": $('#csrfToken').val(),
                },
                success: function (result) {
                    Swal.fire({
                        title: "Delete",
                        text: result,
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    })
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: "Cancelled",
                text: "Your imaginary file is safe 🙂",
                type: "error",
                confirmButtonClass: "btn btn-success"
            })
            setTimeout(function () {
                location.reload();
            }, 1000);
        }
    });
}

function restoreData(url) {
    Swal.fire({
        title: "Are you sure?",
        // text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Active it!",
        confirmButtonClass: "btn btn-warning mr-10",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    "_token": $('#csrfToken').val(),
                },
                success: function (result) {
                    Swal.fire({
                        title: "Restore",
                        text: result,
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    })
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: "Cancelled",
                text: "No Active Taken 🙂",
                type: "error",
                confirmButtonClass: "btn btn-success"
            })
            setTimeout(function () {
                location.reload();
            }, 1000);
        }
    });
}

// admin filter
function adminFilterUrlGenerate(url, searchIteam) {
    if (searchIteam != '') {
        let filterUrl = url + '/' + searchIteam;
        $("#adminFilterUrl").attr('action', filterUrl);
    } else {
        let filterUrl = url + '/' + "All Data";
        $("#adminFilterUrl").attr('action', filterUrl);
    }
}

