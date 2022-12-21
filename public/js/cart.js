$(document).ready(function() {

    //when plus btn click
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace('kyats', ''));
        // console.log($price);
        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;
        $parentNode.find('#total').html($total + 'kyats');

        summaryCalculation();
    })

    //when minus btn click
    $('.btn-minus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace('kyats', ''));
        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;
        $parentNode.find('#total').html($total + 'kyats');

        summaryCalculation();

    })



    //total summary
    function summaryCalculation() {
        $totalPrice = 0;
        $('#dataTable tr').each(function(index, row) {
            $totalPrice += ($(row).find('#total').text().replace('kyats', '')) * 1;
        });

        $('#subTotalPrice').html(`${$totalPrice} Kyats`);
        $('#finalPrice').html(`${$totalPrice+3000} Kyats`);
    }

    function countCalculation() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace('kyats', ''));
        // console.log($price);
        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;
        $parentNode.find('#total').html($total + 'kyats');
    }
})