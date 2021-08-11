<a href="{{ route('balereceptions.bales.index', $balereception) }}" class="action-icon" data-toggle="tooltip" data-placement="bottom" title="View Reception"> <i style="color: rgb(15, 15, 240)" class="mdi mdi-eye"></i></a>

<a href="{{ route('balereceptions.edit', $balereception) }}" class="action-icon" data-toggle="tooltip" data-placement="bottom" title="Track Bale Reception"> <i style="color: green" class="mdi mdi-account-search"></i></a>

<a href="{{ route('balereceptions.destroy', $balereception) }}" class="action-icon" data-toggle="tooltip" data-placement="bottom" title="Delete balereception" onclick="event.preventDefault();document.getElementById('remove-balereception-form_{{ $balereception->id }}').submit();"> <i style="color: rgb(209, 25, 25)" class="mdi mdi-delete"></i></a>
<form id="remove-balereception-form_{{ $balereception->id }}" action="{{ route('balereceptions.destroy', $balereception) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>