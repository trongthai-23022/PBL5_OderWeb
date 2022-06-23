
//delete cart item
$(document).on('click', '.delete_cart_action', function (event) {
    event.preventDefault();
    let urlRequest = $(this).data('url')
    let btn = $(this);
    $.ajax({
        type: 'GET',
        url: urlRequest,
        success: function (data) {
            if (data.code === 200) {
                btn.parent().parent().remove();
                $('#cart-items-count').text(data.cart_items_count + " items");
                $('#cart-sub-total').text(data.sub_total + " đ");
                $('#cart-tax').text(data.tax + " đ");
                $('#cart-total').text(data.total + " đ");

            }
        }

    })

})

//update cart item
$(document).on('click', '.qty-change', function () {
    let urlRequest = $(this).data('url');
    let rowId = $(this).data('row_id');
    let qty = $("#" + rowId).val();
    let price = $("#cart-item-price-hidden-" + rowId).val();
    $.ajax({
        type: 'GET',
        url: urlRequest,
        data: {
            'rowId': rowId,
            'qty': qty,
        },
        success: function (data) {
            if (data.code === 200) {
                let item_total = numberWithCommas(parseInt(qty) * parseInt(price));
                $('#cart-items-count').text(data.cart_items_count + " items");
                $('#cart-item-total-' + rowId).text(item_total + " đ");
                $('#cart-sub-total').text(data.sub_total + " đ");
                $('#cart-tax').text(data.tax + " đ");
                $('#cart-total').text(data.total + " đ");
            }
        },
    })


})
$(document).on('change', '.qty-input', function () {
    let urlRequest = $(this).data('url');
    let rowId = $(this).data('row_id');
    let qty = $("#" + rowId).val();
    $.ajax({
        type: 'GET',
        url: urlRequest,
        data: {
            'rowId': rowId,
            'qty': qty,
        },
        success: function (data) {
            if (data.code === 200) {
                $('#cart-items-count').text(data.cart_items_count + " items");
            }
        },

    });

});


