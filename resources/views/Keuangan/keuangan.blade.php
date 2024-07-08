<x-app-layout>
  <x-slot name="header">
  {{ __('Keuangan') }}
  </x-slot>
    <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">
        <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
          <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
          Keuangan
          </span>   
        </div>
        <div class="flex flex-row w-fit box-sizing-border">
          <a href="/keuangan/tarik" class="rounded-[0.6rem] bg-[#009EE2] relative flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
            <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
            Tarik Saldo
            </span>
          </a>
        </div>
      </div>
      <div class="m-[0_0.3rem_3.1rem_0.3rem] flex flex-row self-start w-[fit-content] box-sizing-border">
        @if (Auth::user()->role == 'Admin')
        <div class="rounded-[0.3rem] border border-[#21AA93] m-[0_1.9rem_0_0] flex flex-col p-[0.3rem_0.6rem_0.3rem_0.6rem] box-sizing-border">
          <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
          Total Saldo Bank
          </div>
          <span class="self-start break-words font-['Poppins'] font-light text-[1rem] text-[rgba(19,19,19,0.6)]">
            Rp {{ $saldo_bank }}
          </span>
        </div>
        @endif
        <div class="rounded-[0.3rem] border border-[#21AA93] m-[0rem_0_0rem_0] flex flex-col p-[0.3rem_0.6rem_0.3rem_0.6rem] box-sizing-border">
          <div class="m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
          {{ Auth::user()->role == 'Nasabah' ? 'Saldo Nasabah' : 'Saldo Pengurus' }}
          </div>
          <span class="self-start break-words font-['Poppins'] font-light text-[1rem] text-[rgba(19,19,19,0.6)]">
          Rp {{ $saldo}}
          </span>
        </div>
      </div>
      <div class="break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] my-2">Riwayat Penarikan</div>
      <div class="flex flex-col items-center self-start w-full box-sizing-border p-[0_5rem_0_0]">
        <div class="m-[0_0_1.8rem_0] flex flex-col items-center w-full box-sizing-border">
          <div class="m-[0_0_1.6rem_1.6rem] flex flex-row justify-start w-full box-sizing-border">
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
            Tanggal
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
            Jumlah Penarikan
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
                Status
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
                Kwitansi
            </div>
          </div>
          <div class="bg-[#F2F2F2] w-full h-[0.1rem] ">
          </div>
        </div>
        @isset($data)
          
        @foreach ($data as $data)
        <div class="w-full cursor-pointer" onclick="window.location.href='{{ url('keuangan/edit/' . ($data->id ?? 'default')) }}'">
          <div class="m-[0_0_1.8rem_0] flex flex-col items-center w-full box-sizing-border">
            <div class="m-[0_0_1.6rem_1.6rem] flex flex-row justify-start w-full box-sizing-border">
              <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[15%]">
                {{ $data->created_at}}
              </div>
              <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[15%]">
                {{ $data->saldo}}
              </div>
              <div class="w-[15%]">
                @if ($data->status == 'Dalam Proses')
                  <div class="rounded-[0.6rem] bg-[#0958D9] relative flex p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                    <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#FFFFFF]">
                      {{ $data->status}}
                    </span>
                  </div>
                @else
                  <div class="rounded-[0.6rem] bg-[#4E9C00] relative flex p-[0.1rem_0.3rem_0.1rem_0.3rem] box-sizing-border w-fit">
                    <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#FFFFFF]">
                      {{ $data->status}}
                    </span>
                  </div>
                @endif
              </div>
              <div class="w-[15%]">
                <button onclick="event.stopPropagation(); redirectTo('{{ url('/generate/kwitansi/'.$data->id) }}')" class="rounded-[0.6rem] bg-[#D9D9D9] relative flex p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                  <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                     Unduh
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>
        
        <script>
          function redirectTo(url) {
            window.location.href = url;
          }
        </script>
        
        @endforeach
        @endisset

      </div>



      <script>
        function redirectTo(url) {
            window.location.href = url;
        }
      </script>
</x-app-layout>


