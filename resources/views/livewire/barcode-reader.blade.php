<div>
    <input type="text" wire:model="barcode" placeholder="Scan barcode here" autofocus />

    @if ($errorMessage)
        <div class="alert alert-danger">
            {{ $errorMessage }}
        </div>
    @endif

    @if ($successMessage)
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    @if ($inventory)
        <div>
            <strong>Product Name:</strong> {{ $inventory->product_name }}<br>
            <strong>Price:</strong> {{ $inventory->price }}<br>
            <strong>GST Rate:</strong> {{ $inventory->gst_rate }}%
        </div>

        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" wire:model="quantity" id="quantity" placeholder="Enter quantity" />

            <label for="weight">Weight:</label>
            <input type="number" wire:model="weight" id="weight" placeholder="Enter weight" />
        </div>

        <button wire:click="addToCart">Add to Cart</button>
    @endif
</div>
