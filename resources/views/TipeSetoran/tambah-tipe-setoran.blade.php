<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Tipe Setoran') }}
      </x-slot>
    <form action="{{ route('tipe-setoran.tambah-insert') }}" method="post" class="w-full" enctype="multipart/form-data">
    @csrf
        <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">
            <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
            <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
            Tipe Setoran
            </span>   
            </div>
            <div class="flex flex-row w-fit box-sizing-border">
            <button class="rounded-[0.6rem] bg-[#21AA93] relative m-[0_2.1rem_0_0] flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
                <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
                Simpan
                </span>
            </button>
            </div>
        </div>
        <div class="m-[0_0.1rem_0_0.1rem] flex flex-row justify-between self-start w-full box-sizing-border">
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Tipe
                </div>
                @isset($data->id)
                <input name="id_tipe_setoran" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="id" value="{{ $data->id_tipe_setoran }}" hidden></input>
                <input name="tipe" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Tipe"  value="{{ $data->tipe }}"></input>
                @else
                <input name="tipe" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Tipe"></input>
                @endisset

            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Potongan per Transaksi
                </div>
                @isset($data->id)
                <input name="potongan_per_transaksi" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="%" value="{{ $data->potongan_per_transaksi }}"></input>
                @else
                <input name="potongan_per_transaksi" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="%"></input>
                @endisset
                
            </div>
        </div>
    </form>
</x-app-layout>


    