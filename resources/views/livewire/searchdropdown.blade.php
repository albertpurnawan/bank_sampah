<div class="relative">

    <input

        type="text"

        class="form-input inline-block bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#0B63F8]"

        placeholder="Pilih"

        wire:model="query"

        wire:keydown.escape="resetFields"

        wire:keydown.tab="resetFields"

        wire:keydown.arrow-up="decrementHighlight"

        wire:keydown.arrow-down="incrementHighlight"

        wire:keydown.enter="selectContact"

        wire:change="updateQuery"

    /> 

    <div wire:loading class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">

        <div class="list-item">Searching...</div>

    </div>

    {{-- ga masuk
    {{$query}}
    @if(!empty($query))
    masuk --}}
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="reset"></div>

        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
            
            @if(!empty($list_data))
            
                @foreach($list_data as $i => $data)

                    <a

                        href="{{ route('show-data', $data['id']) }}"

                        class="list-item {{ $highlightIndex === $i ? 'highlight' : '' }}"

                    >{{ $data['nama'] }}</a>

                @endforeach

            @else

                <div class="list-item">No results!</div>

            @endif

        </div>

    {{-- @endif --}}

</div>