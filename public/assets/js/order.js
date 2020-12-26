$('div#order_carries input').click(function() {
    let original_price = parseFloat($('b.order-price').data('price')); 
    let delivery_price = parseFloat($(this).data('deliveryprice'));
    let price = (original_price + (delivery_price / 100)).toFixed(2);
    $('b.order-price').text(price + "€");
});
