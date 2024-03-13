<div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button"
        class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown"
        aria-expanded="false">
        Action
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        @if(isset($actions['Edit']))
            <li><a class="dropdown-item action" href="{{ $actions['Edit'] }}">Edit</a></li>
        @endif
        @foreach ($actions as $key => $item)
            @if($key !== 'Edit') <!-- Asumsi Anda tidak ingin menampilkan 'Edit' dua kali -->
                <li><a class="dropdown-item action" href="{{ $item }}">{{ $key }}</a></li>
            @endif
        @endforeach
    </ul>
</div>
