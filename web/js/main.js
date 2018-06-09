$('document').ready(function(){
    const normalPrice = $('#normalPrice').html().substring($('#normalPrice').html().indexOf(':') + 2);
    const handicappedPrice = $('#handicappedPrice').html().substring($('#handicappedPrice').html().indexOf(':') + 2);

    $('.priceFields').change(function(){
        var result = 0;
        $('.priceFields').each(function(index, element){
            if($(this).val() < 0){
                return;
            }
            if($(this).is("#appbundle_reservation_numberOfSeatsNormal")){
                result += $(element).val() * normalPrice;
            }else {
                result += $(element).val() * handicappedPrice;
            }
        });
        $('#result').html(result + ' &euro;');
    });
});