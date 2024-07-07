<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pengguna') }}
      </x-slot>
    <form action="{{ route('pengguna.tambah-insert') }}" method="post" class="w-full">
    @csrf
        @isset($data->id)
            <input name="id_user" value="{{ $data->id_user }}" hidden></input>
        @endisset
        <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">
            <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
            <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
            Pengguna
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
                <input name="nama" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Nama" value="@isset($data->id){{$data->nama}}@else{{old('nama')}}@endisset"></input>
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Email Id
                </div>
                <input name="email" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="@mail.com" value="@isset($data->id){{$data->email}}@else{{old('email')}}@endisset"></input>
            </div>
        </div>
        <div class="m-[1rem_0.1rem_0_0.1rem] flex flex-row justify-between self-start w-full box-sizing-border">
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Nomor Whatsapp
                </div>
                <input name="nomor" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="08xxxxxxxx" value="@isset($data->id){{$data->nomor}}@else{{old('nomor')}}@endisset"></input>
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Role
                </div>
                <div class="relative w-full h-fit overflow-hidden rounded-[0.5rem]">
                    <select name="role" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" style="appearance: none;">
                        <option value="">Pilih Role</option>
                        <option value="Admin" {{ old('role', $data->role ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Nasabah" {{ old('role', $data->role ?? '') == 'Nasabah' ? 'selected' : '' }}>Nasabah</option>
                    </select>
                    <div class="absolute inset-y-0 right-[23%] flex items-center pl-3 pointer-events-none">
                        <img class="w-[0.9rem] h-[0.4rem]" src="../../assets/vectors/vector_3_x2.svg" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>


