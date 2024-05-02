$(document).ready(function(){
    $('.btn-plus').click(function() {
        var productId = $(this).data('product-id');
        updateQuantity(productId, 'increase');
    });

    $('.btn-minus').click(function() {
        var productId = $(this).data('product-id');
        updateQuantity(productId, 'decrease');
    });

    function updateQuantity(productId, action) {
        $.ajax({
            url: "{{ path('update_quantity') }}",
            method: "POST",
            data: {
                productId: productId,
                action: action
            },
            success: function(response) {
                // Mettre à jour la quantité affichée dans l'interface utilisateur avec la nouvelle quantité renvoyée par la requête AJAX
                var newQuantity = response.quantity;
                var quantityElement = $('.quantity[data-product-id="' + productId + '"]');
                quantityElement.text(newQuantity);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});
