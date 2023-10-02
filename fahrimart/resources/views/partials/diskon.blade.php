@foreach ($diskon as $key => $item)
<form>
    <li><button type="button" style="display: none" class="dropdown-item diskonBtn" id="diskon-{{ $item->price }}" 
        onclick="diskon('{{ $item->discount }}')">Discount {{ $item->discount * 100 }}%</button></li>
</form>
<form>
    <li><button type="button" style="display: none" class="dropdown-item disabled disabled-btn" id="disabledDiskon-{{ $item->price }}" 
         onclick="diskon('{{ $item->discount }}')">Discount {{ $item->discount * 100 }}%</button></li>
</form>

@endforeach

<script>
    $(document).ready(function(){
        getPrice();
    });

    function diskon(discount){
        $.ajax({
            type: "POST",
            url: "/keranjang/totalHarga/"+discount,
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response){
            let totalHarga = $('.total-harga');
            let discount = $('.discount');
            totalHarga.text(response.harga);
            discount.text(response.diskon);
            getPrice();

            },
            error: function(error){
                console.log(error);
            }
        });
    }

    function getPrice(){
        $.ajax({
            type: "GET",
            url: "/keranjang/get-price",
            success: function(response){
                let price = response.price;
                let totalHargaValue = response.totalHarga;
                console.log(totalHargaValue);

                if(totalHargaValue === 0){
                    $('#use-discount').hide();
                }else{
                    $('#use-discount').show();
                }

                for(let i = 0; i < price.length; i++){
                    let iPrice = price[i];
                    if (totalHargaValue == iPrice){
                        $('#diskon-' + iPrice).show();
                        $('#disabledDiskon-' + iPrice).hide();
                    } else if (totalHargaValue > iPrice) {
                        $('#diskon-' + iPrice).show();
                        $('#disabledDiskon-' + iPrice).hide();
                    } else if(totalHargaValue < iPrice) {
                        $('#diskon-' + iPrice).hide();
                        $('#disabledDiskon-' + iPrice).show();
                    }
                }

            },
            error: function(error){
                console.log(error);
            }
        });
    }

</script>