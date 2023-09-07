  <div id="trx">
    @if (count($keranjang))        
    <table class="table border mt-5">
          <tbody>
              @foreach ($keranjang as $data)
              <tr class="col-sm-2">
                  <td class="d-flex align-items-center">trx<span class="text-danger">{{ date('Ymd', strtotime($data->date)) }}</span> - 
                      <form>
                          <button type="button" class="btn text-info border-0" onclick="tombolBuka({{ $data->id }})">Buka</button>
                      </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    @else
     <div class="container d-flex align-items-end justify-content-center" style="height: 40vh">
        <h5 class="text-secondary">there is no hold item.</h5>
    </div>
    @endif
    </div>