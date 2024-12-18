<div>
    <input type="text"
           wire:model.live="searchText"
           wire:keydown.enter="selectFirst()"
           class="rounded-lg mb-2 text-black">
    @if($toggleResults)
        <div class="text-white absolute bg-gray-800 p-2 rounded-lg">
            @forelse($searchResults as $result)
                <div wire:click="selectUser('{{ $result->name }}')"
                    class="rounded-lg hover:cursor-pointer p-2 hover:bg-gray-900">
                    <p>{{ $result->name }}</p>
                </div>
            @empty
                <div>
                    <p>No results found</p>
                </div>
            @endforelse
        </div>
    @endif
</div>
