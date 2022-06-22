$(function () {
    setTimeout(function () {
        $(".response_message").remove();
    }, 2000);

    $(document).on('click', '.action_delete', actionDelete);


    $("#fileupload").change(function () {
        $("#dvPreview").html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        if (regex.test($(this).val().toLowerCase())) {
            if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                $("#dvPreview").show();
                $("#dvPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
            } else {
                if (typeof (FileReader) != "undefined") {
                    $("#dvPreview").show();
                    $("#dvPreview").append("<img />");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#dvPreview img").attr("src", e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            }
        } else {
            alert("Please upload a valid image file.");
        }
    });
});


$("#fileupload").change(function () {
    $("#dvPreview").html("");
    let regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
    if (regex.test($(this).val().toLowerCase())) {
        if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
            $("#dvPreview").show();
            $("#dvPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
        } else {
            if (typeof (FileReader) != "undefined") {
                $("#dvPreview").show();
                $("#dvPreview").append("<img />");
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#dvPreview img").attr("src", e.target.result);
                }
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        }
    } else {
        alert("Please upload a valid image file.");
    }
});

// add to cart
$(document).on('click', '.add-to-cart', function () {
    let urlRequest = $(this).data('url');
    let id = $(this).data('product_item');
    let cart_product_id = $('.cart_product_id_' + id).val();
    let cart_product_qty = $('.cart_product_qty_' + id).val();
    // let cart_product_name = $('.cart_product_name_' + id).val();
    // let cart_product_price = $('.cart_product_price_' + id).val();
    // let cart_product_main_image_path = $('.cart_product_main_image_path_' + id).val();
    // let cart_product_main_image_name = $('.cart_product_main_image_name_' + id).val();
    let _token = $('input[name = "_token"]').val();

    $.ajax({
        url: urlRequest,
        method: 'post',
        data: {
            cart_product_id: cart_product_id,
            cart_product_qty: cart_product_qty,
            // cart_product_name:cart_product_name,
            // cart_product_price:cart_product_price,
            // cart_product_main_image_path:cart_product_main_image_path,
            // cart_product_main_image_name:cart_product_main_image_name,
            _token: _token,

        },
        success: function (data) {
            if (data.code === 200) {
                Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: "Đã thêm " + data.product_type + " vào giỏ hàng!",
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#cart-items-count').text(data.cart_items_count + " items");
            } else {
                Swal.fire({
                    position: 'middle',
                    icon: 'warning',
                    title: "Something went wrong!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    })
});
// update order status
$(document).on('click', '.update-status', function () {
    let urlRequest = $(this).data('url');
    let orderId = $('.order-id').val();
    let status = $('#order-status option:selected').val();
    let _token = $('input[name = "_token"]').val();
    $.ajax({
        type: 'POST',
        url: urlRequest,
        data: {
            order_id:orderId,
            status:status,
            _token:_token
        },
        success:function (data){
            if(data.code === 200) {
                Swal.fire({
                    position: 'middle',
                    icon: 'success',
                    title: "Cập nhật thành công!",
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#order-status').val(data.status);
            }
            else {
                Swal.fire({
                    position: 'middle',
                    icon: 'warning',
                    title: "Cập nhật thất bại!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }

    })

});
//cancel order
$(document).on('click', '.cancel', function () {
    let urlRequest = $(this).data('url');
    let orderId = $('.order-id').val();
    let status = $('.order-status').val();
    let _token = $('input[name = "_token"]').val();
    Swal.fire({
        title: 'Bạn chắc chắn muốn hủy?',
        text: "Bạn có thể vào phần đã hủy để đặt lại",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Vâng, hủy đi!',
        cancelButtonText: 'Thôi'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: urlRequest,
                data: {
                    order_id:orderId,
                    status:status,
                    _token:_token
                },
                success:function (data){
                    if(data.code === 200) {
                        Swal.fire({
                            position: 'middle',
                            icon: 'success',
                            title: "Đã hủy đơn!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    }
                    else {
                        Swal.fire({
                            position: 'middle',
                            icon: 'warning',
                            title: "Hủy thất bại!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }

            })
        }

    })

});

//order now



function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

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
                    if (data.code === 200) {
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

