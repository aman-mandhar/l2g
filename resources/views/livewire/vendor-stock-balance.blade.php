<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div x-data="{ open: false }">
                <button @click="open = !open">Stock-in-Hand</button>
                <div x-show="open" @click.outside="open = false">
                    <div class="col-md-12">
                        {{ $weight_remaining }}
                        {{ $qty_remaining }}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>