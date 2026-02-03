<div>
    @if ($record->product && $record->product->image)
        <img src="{{ asset($record->product->image) }}" alt="Product Image" style="max-width: 100%; height: auto;">
    @else
        <p>No image available</p>
    @endif
</div>
