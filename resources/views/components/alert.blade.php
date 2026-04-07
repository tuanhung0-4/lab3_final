<div class="alert alert-{{ $type }}">
    @if($type == 'success')
        <ion-icon name="checkmark-circle-outline"></ion-icon>
    @else
        <ion-icon name="alert-circle-outline"></ion-icon>
    @endif
    <span>{{ $message }}</span>
</div>
