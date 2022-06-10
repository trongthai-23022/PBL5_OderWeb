function increaseValue(id) {
    var value = parseInt(document.getElementById('number'+ id).value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number' + id).value = value;
}

function decreaseValue(id) {
    var value = parseInt(document.getElementById('number'+id).value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    document.getElementById('number'+id).value = value;
}
