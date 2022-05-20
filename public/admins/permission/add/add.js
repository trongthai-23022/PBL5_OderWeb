$(function () {
    $('.wrapper-checkbox').on('click', function (){
        $(this).parents('.card').find('.child-checkbox').prop('checked', $(this).prop('checked'));
    });
})


