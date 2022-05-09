function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url')
    let btn = $(this);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data) {
                    if (data.code == 200) {
                        // remove product item in view
                        btn.parent().parent().remove();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }

                },
                error: function () {

                    Swal.fire(
                        'Oops!',
                        'Something went wrong bruh.',
                        'warning'
                    )
                }

            })
        }

    })
}

$(function () {
    $(document).on('click', '.action_delete', actionDelete)

});
