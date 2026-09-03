<div class="space-y-6">

    @if($orders->count())

    @foreach($orders as $order)

        @include('admin.orders.partials.card')

    @endforeach

    @else
    
        <div class="bg-white rounded-3xl p-16 text-center shadow">
    
            <h3 class="text-2xl font-bold text-stone-700">
                Sargyt tapylmady
            </h3>
    
            <p class="text-stone-500 mt-2">
                Başga bir gözleg ýa-da süzgüç ulanyp görüň.
            </p>
    
        </div>
    
    @endif

</div>

<div class="pagination mx-6">
    {{ $orders->links() }}
</div>