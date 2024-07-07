<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Keuangan') }}
      </x-slot>
      @if (Auth::user()->is_lengkap == '0' && Auth::user()->role == 'Nasabah')
      <div id="alert" class="fixed top-0 left-0 z-10 w-full h-full">
        <div class="bg-white rounded-lg border border-gray-300 p-[2rem_5rem_5rem_5rem] flec flex-col justify-center items-center absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2" style="z-index: 9999;">
          <div class="flex justify-center items-center">
            <lottie-player
              src="/assets/json/alert.json" 
              background="transparent" 
              speed="1" 
              style="width: 4rem; height: 4rem;" 
              loop 
              autoplay>
            </lottie-player>
          </div>
          <p class="text-gray-800 pt-2">
            Pastikan anda sudah melengkapi profile anda</p>
          <a href="/profile/edit-profile"  class="absolute top-[60%] mt-2 left-1/2 -translate-x-1/2 w-20 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white">
            OK
          </a>
        </div>
      </div>
      @endif
      <div id="alert_warning" class="hidden fixed top-0 left-0 z-10 w-full h-full">
        <div class="bg-white rounded-lg border border-gray-300 p-[2rem_5rem_5rem_5rem] flec flex-col justify-center items-center absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2" style="z-index: 9999;">
          <div class="flex justify-center items-center">
            <lottie-player
              src="/assets/json/alert.json" 
              background="transparent" 
              speed="1" 
              style="width: 4rem; height: 4rem;" 
              loop 
              autoplay>
            </lottie-player>
          </div>
          <p class="text-gray-800 pt-2" id="text_alert">
            </p>
          <button onclick="close_alert()"  class="absolute top-[60%] mt-2 left-1/2 -translate-x-1/2 w-20 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white">
            OK
          </button>
        </div>
      </div>
    <form action="{{ route('keuangan.tarik-insert') }}" method="post" class="w-full" enctype="multipart/form-data">
    @csrf
    @isset($data->id)
        <input name="id_keuangan" value="{{ $data->id_keuangan }}" hidden></input>
        <input name="id_user" value="{{ $data->id_user }}" hidden></input>
    @endisset
        <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">
            <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
            <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
            Keungan
            </span>   
            </div>
            <div class="flex flex-row w-fit box-sizing-border">
                @if (Auth::user()->role == 'Admin')
                    @isset($data)
                        <a href="{{ route('keuangan.penarikan', $data->id)}}" class="rounded-[0.6rem] bg-[#009EE2] relative m-[0_2.1rem_0_0] flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
                            <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
                            Menyetujui
                            </span>
                        </a>
                    @endisset
                @endif
                
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
                    Nama Lengkap Rekening
                </div>
                <input name="nama_lengkap_rekening" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Nama" value="{{ Auth::user()->nama }}"></input>
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Tipe Penarikan
                </div>
                <div class="relative w-full h-fit overflow-hidden rounded-[0.5rem]">
                    <select name="tipe_penarikan" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" style="appearance: none;" id="tipe_penarikan">
                        <option value="">Pilih Tipe</option>
                        <option value="Manual" @if(isset($data->tipe_penarikan) && $data->tipe_penarikan == 'Manual') selected @endif>Manual</option>
                        <option value="Online" @if(isset($data->tipe_penarikan) && $data->tipe_penarikan == 'Online') selected @endif>Online</option>
                    </select>
                    <div class="absolute inset-y-0 right-[23%] flex items-center pl-3 pointer-events-none">
                        <img class="w-[0.9rem] h-[0.4rem]" src="../../assets/vectors/vector_3_x2.svg" />
                    </div>
                </div>
            </div>
        </div>
        <div class=" m-[1rem_0.1rem_0_0.1rem] flex flex-row justify-between self-start w-full box-sizing-border form_manual" style="display: none">
            <div class="rounded-[0.6rem] flex flex-col w-[50%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Saldo yang Dicairkan
                </div>
                <input name="saldo" onchange="validate_saldo(this)" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Rp" value="@isset($data->saldo){{$data->saldo}}@endisset"></input>
            </div>
        </div>
        <div class=" m-[1rem_0.1rem_0_0.1rem] flex flex-row justify-between self-start w-full box-sizing-border form_online" style="display: none">
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Nomor Rekening
                </div>
                <input name="nomor_rekening" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="123456789" value="@isset($data->nomor_rekening){{$data->nomor_rekening}}@endisset"></input>
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Nomor Whatsapp
                </div>
                <input name="nomor" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="08*********" value="@isset($data->nomor){{$data->nomor}}@endisset"></input>
            </div>
        </div>
        <div class=" m-[1rem_0.1rem_0_0.1rem] flex flex-row justify-between self-start w-full box-sizing-border form_online" style="display: none">
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Bank
                </div>
                <div class="relative w-full h-fit overflow-hidden rounded-[0.5rem]">
                    <select name="bank" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" style="appearance: none;" id="tipe_penarikan">
                        <option value="">Pilih Bank</option>
                        <option value="BCA" @if(isset($data->bank) && $data->bank == 'BCA') selected @endif>BCA</option>
                        <option value="BNI" @if(isset($data->bank) && $data->bank == 'BNI') selected @endif>BNI</option>
                        <option value="MANDIRI" @if(isset($data->bank) && $data->bank == 'MANDIRI') selected @endif>MANDIRI</option>
                        <option value="BRI" @if(isset($data->bank) && $data->bank == 'BRI') selected @endif>BRI</option>
                    </select>
                    <div class="absolute inset-y-0 right-[23%] flex items-center pl-3 pointer-events-none">
                        <img class="w-[0.9rem] h-[0.4rem]" src="../../assets/vectors/vector_3_x2.svg" />
                    </div>
                </div>
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Saldo yang Dicairkan
                </div>
                <input name="saldo" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Rp" onchange="validate_saldo(this)" value="@isset($data->saldo){{$data->saldo}}@endisset"></input>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            const data = <?php echo isset($data) ? json_encode($data) : 'null' ?>;
            const forms = document.getElementsByClassName('form_online');
            const formsManual = document.getElementsByClassName('form_manual');

            if (data) {
                Array.from(formsManual).forEach(form => {
                    form.style.display = data.tipe_penarikan == 'Manual' ? 'flex' : 'none';
                });

                Array.from(forms).forEach(form => {
                    form.style.display = data.tipe_penarikan == 'Online' ? 'flex' : 'none';
                });

            }
        })

        document.getElementById('tipe_penarikan').onchange = function(){
            const forms = document.getElementsByClassName('form_online');
            const formsManual = document.getElementsByClassName('form_manual');
            Array.from(forms).forEach(form => {
                form.style.display = this.value == 'Online' ? 'flex' : 'none';
            });
            Array.from(formsManual).forEach(form => {
                form.style.display = this.value == 'Manual' ? 'flex' : 'none';
            });
        }
        function validate_saldo(input){
            const max_tarik = <?php echo isset($max_tarik) ? $max_tarik : 'null' ?>;
            if (input.value > max_tarik) {
                input.value = 0;
                document.getElementById('text_alert').innerHTML = "Saldo yang dicairkan tidak boleh melebihi saldo yang tersedia";
                document.getElementById('alert_warning').style.display = 'flex';
            }
        }

        function close_alert(){
            document.getElementById('alert_warning').style.display = 'none';
        }

    </script>
</x-app-layout>



