$(document).ready(function() {
    $('form [name="form-sum"]').keydown(function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            $('.sum-input').blur();
            return false;
        }
    });
    $(".sum-input").change(flashOrder);
});


$(document).on('change', '.sum-input', flashOrder);
$(document).on('click', '.cate-checkbox', flashOrder);
$(document).on('change', '.use-chosen', flashOrder);


function flashOrder() {
    let urlRequest = $(this).data('url');
    let orderBy = $("#orderby").val();
    let sum = $("#sum-input").val();
    let cateIds = [];
    let checkedCates = [];
    let counter = 0;
    let csrf_token = $('meta[name="csrf-token"]').attr('content');
    let base_url = window.location.origin;
    let store_url = base_url+ '/cart/store';
    $.each($("input[name='cate']:checked"), function () {
        cateIds.push($(this).val());
        checkedCates.push($(this).attr('attr-name'));
        counter++;
    });
    $('.checked-cates').empty().append(
        `<b style="color: #6667AB">${checkedCates.join(", ")}</b>`
    );
    $.ajax({
        type: 'GET',
        url: urlRequest,
        data: {
            orderBy: orderBy,
            sum: sum,
            cateIds: cateIds,
        },
        success: function (data) {
            if (data.code === 200) {
                if (data.products.length == 0) {
                    $('#recommend-products').empty().append(`
                            <li class="col-lg-9 col-md-6 col-sm-6 col-xs-6 "><h2>Không có sản phẩm phù hợp nào! </h2></li>
                        `);
                } else {
                    $('#recommend-products').empty();
                    data.products.forEach(product => {
                        $('#recommend-products').append(
                            `<li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="${base_url + "/detail/" + product.id + "_" + product.slug }"
                                           title="${product.name}">
                                            <figure><img
                                                    style="width: 100%; height: 250px;object-fit: cover;"
                                                    src="${product.main_image_path}" alt="${product.main_image_name}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="${base_url + "/detail/" + product.id + "_" + product.slug }"
                                           class="product-name"><span>${product.name}</span></a>
                                        <div class="wrap-price">
                                            <span class="product-price">đ ${numberWithCommas(product.price)}</span>
                                            <span class="product-price" style="font-weight: normal; font-size: 12px;float: right;">Đã bán: ${product.amount}</span>
                                        </div>
                                        <form method="post">
                                            <div class="wrap-butons">
                                                <input type="hidden" name="_token" value="${csrf_token}">
                                                <input type="hidden" value="1" name="cart_product_qty"
                                                       class="cart_product_qty_${product.id}">
                                                <input type="hidden" value="${product.id}" name="cart_product_id"
                                                       class="cart_product_id_${product.id}">
                                                <input type="button" value="Thêm vào giỏ hàng" class="function-link add-to-cart"
                                                       data-product_item="${product.id}" data-url="${store_url}">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>`
                        );
                    })
                }
            }
        }
    });
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

