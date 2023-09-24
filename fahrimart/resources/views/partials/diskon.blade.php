<form>
@foreach ($diskon as $item)
<li><button type="button" class="dropdown-item" onclick="diskon({{ $item->discount }})">Discount {{ $item->discount * 100 }}%</button></li>
@endforeach
</form>

