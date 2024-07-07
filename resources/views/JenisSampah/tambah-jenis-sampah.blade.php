<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Jenis Sampah') }}
      </x-slot>
    <form action="{{ route('jenis-sampah.tambah-insert') }}" method="post" class="w-full" enctype="multipart/form-data">
    @csrf   
        <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">
            <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
            <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
            Jenis Sampah 
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
                    Nama
                </div>
                @isset($data->id)
                <input name="id_jenis_sampah" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="id" value="{{ $data->id_jenis_sampah }}" hidden></input>
                <input name="nama" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Nama" value="{{ $data->nama }}"></input>
                @else
                <input name="nama" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Nama"></input>

                @endisset
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Harga per Kg
                </div>
                @isset($data->id)
                <input name="harga_per_kg" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Rp" value="{{ $data->harga_per_kg }}"></input>
                @else
                <input name="harga_per_kg" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Rp"></input>
                @endisset
            </div>
        </div>
    </form>
</x-app-layout>


