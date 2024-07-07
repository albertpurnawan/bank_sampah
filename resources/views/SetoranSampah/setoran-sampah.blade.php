<x-app-layout>
  <x-slot name="header">
    {{ __('Setoran Sampah') }}
  </x-slot>
    <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">
        <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
          <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
          Setoran Sampah
          </span>   
        </div>
        <div class="flex flex-row w-fit box-sizing-border">
          <a href="/setoran-sampah/tambah" class="rounded-[0.6rem] bg-[#21AA93] relative m-[0_2.1rem_0_0] flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
            <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
            Tambah
            </span>
          </a>
          <button id="btn-hapus" class="rounded-[0.6rem] bg-[#BEBEBE] relative flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border" disabled>
            <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
            Hapus
            </span>
          </button>
        </div>
      </div>
      {{-- <div class="m-[0_0_2.1rem_0] flex flex-row justify-start w-full box-sizing-border">
        <div class="rounded-[0.2rem] flex flex-col w-[25%] box-sizing-border mr-10">
          <div class="m-[0_0_1rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
          Pengguna
          </div>
          <input type="text" class="rounded-[0.2rem] border-[0.1rem_solid_rgba(19,19,19,0.25)] bg-[#FFFFFF] p-[0.8rem_1.4rem_0.8rem_1.4rem] w-full box-sizing-border" placeholder="Nama Pengguna">
        </div>
        <div class="rounded-[0.2rem] flex flex-col  w-[25%] box-sizing-border mr-10">
          <div class="m-[0_0_1rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
          Status
          </div>
          <input type="text" class="rounded-[0.2rem] border-[0.1rem_solid_rgba(19,19,19,0.25)] bg-[#FFFFFF] p-[0.8rem_1.4rem_0.8rem_1.4rem] w-full box-sizing-border" placeholder="Nama Status">
        </div>
        <div class="rounded-[0.2rem] flex flex-col  w-[25%] box-sizing-border mr-10">
          <div class="m-[0_0_1rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
          Tanggal Penjualan
          </div>
          <input type="text" class="rounded-[0.2rem] border-[0.1rem_solid_rgba(19,19,19,0.25)] bg-[#FFFFFF] p-[0.8rem_1.4rem_0.8rem_1.4rem] w-full box-sizing-border" placeholder="DD/MM/YYYY">
        </div>
        <div class="rounded-[0.2rem] flex flex-col  w-[25%] box-sizing-border">
          <div class="m-[0_0_1rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
          Jenis Sampah
          </div>
          <input type="text" class="rounded-[0.2rem] border-[0.1rem_solid_rgba(19,19,19,0.25)] bg-[#FFFFFF] p-[0.8rem_1.4rem_0.8rem_1.4rem] w-full box-sizing-border" placeholder="Nama Jenis Sampah">
        </div>
      </div> --}}
      <div class="flex flex-col items-center self-start w-full box-sizing-border p-[0_5rem_0_0]">
        <div class="m-[0_0_1.8rem_0] flex flex-col items-center w-full box-sizing-border">
          <div class="m-[0_0_1.6rem_1.6rem] flex flex-row justify-start w-full box-sizing-border">
            <div class="m-[0.1rem_0_0_0] flex w-[5%] h-[1.3rem] box-sizing-border ">
              <input type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" id="all-checkbox"/>
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
            Setoran ID
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
            Tanggal
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
            Pengguna
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
            Status
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[20%]">
            Total Harga
            </div>
          </div>
          <div class="bg-[#F2F2F2] w-full h-[0.1rem] ">
          </div>
        </div>
        <form id="form-hapus" action="/setoran-sampah/delete" method="post" enctype="multipart/form-data" class="w-full">
        @csrf
        @foreach ($data as $data)
        <a href="setoran-sampah/edit/{{$data->id}}" class="w-full">
          <div class="m-[0_0_1.8rem_0] flex flex-col items-center w-full box-sizing-border">
            <div class="m-[0_0_1.6rem_1.6rem] flex flex-row justify-start w-full box-sizing-border">
              <div class="m-[0.1rem_0_0_0] flex w-[5%] h-[1.3rem] box-sizing-border ">
                <input name="ids[]" type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" value="{{ $data->id }}"/>
              </div>
              <span class="break-words font-['Poppins'] font-normal text-[1rem] text-[#0B63F8] w-[15%]">
                  {{$data->id_setoran_sampah}}
              </span>
              <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[15%]">
              {{$data->tanggal}}
              </div>
              <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[15%]">
              {{$data->nama}}
              </div>
              <div class="w-[15%]">
                @if($data->status == 'Pesanan Diterima')
                  <div class="rounded-[0.6rem] bg-[#FF9A03] bg-opacity-10 relative flex items-center justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                      <span class="opacity-100 break-words font-['Poppins'] font-normal text-[1rem] text-[#FF9A03]">
                        {{$data->status}}
                      </span>
                  </div>
                @endif
                @if($data->status == 'Penjemputan')
                  <div class="rounded-[0.6rem] bg-[#E6F4FF] relative flex items-center justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                      <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#0958D9]">
                        {{$data->status}}
                      </span>
                  </div>
                @endif
                  @if($data->status == 'Pesanan Baru')
                  <div class="rounded-[0.6rem] bg-[#F6FFED] relative flex justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                      <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#52C41A]">
                        {{$data->status}}
                      </span>
                    </div>
                  @endif
                  @if($data->status == 'Pesanan Ditolak')
                  <div class="rounded-[0.6rem] bg-[#FFF2F0] relative flex justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                      <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#FF4D4F]">
                        {{$data->status}}
                      </span>
                    </div>
                  @endif
                  @if($data->status == 'Pesanan Selesai')
                  <div class="rounded-[0.6rem] bg-[#4E9C00] relative flex justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                      <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#FFFFFF]">
                        {{$data->status}}
                      </span>
                    </div>
                  @endif
              </div>
              <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[20%]">
              Rp {{$data->total_harga}}
              </div>
            </div>
            <div class="bg-[#F2F2F2] w-[70.6rem] h-[0.1rem]">
            </div>
          </div>
        </a>        
        @endforeach
        </form>
      </div>
      <script>
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var allCheckbox = document.getElementById('all-checkbox');
        var deleteBtn = document.getElementById('btn-hapus');

        function checkAll() {
          checkboxes.forEach(function(checkbox) {
            checkbox.checked = allCheckbox.checked;
          });
          var hapus = document.getElementById('btn-hapus');
          if (allCheckbox.checked) {
            hapus.style.backgroundColor = '#FF4A4A';
            hapus.disabled = false;
          } else {
            hapus.style.backgroundColor = '#BEBEBE';
            hapus.disabled = true;
          }
        }
        function checkAnyChecked() {
          var anyChecked = false;
          checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
              anyChecked = true;
            }
          });
          return anyChecked;
        }

        checkboxes.forEach(function(checkbox) {
          checkbox.addEventListener('change', function() {
            var hapus = document.getElementById('btn-hapus');
            if (checkAnyChecked()) {
              hapus.style.backgroundColor = '#FF4A4A';
              hapus.disabled = false;
            } else {
              hapus.style.backgroundColor = '#BEBEBE';
              hapus.disabled = true;
            }
          });
        });
        allCheckbox.addEventListener('change', checkAll);
        deleteBtn.addEventListener('click', function() {
          var checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked');
          var ids = [];
          checkedBoxes.forEach(function(checkbox) {
            ids.push(checkbox.getAttribute('data-id'));
          });
          var formHapus = document.getElementById('form-hapus');
          if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            formHapus.submit();
          }
        });

        $(document).on('data', function (event, data) {
            var Container = $('#form-hapus');
            Container.empty();
            var htmls = data.map(function (data) {
                return `
                     <a href="/setoran-sampah/edit/${data.id}" class="w-full">
                      <div class="m-[0_0_1.8rem_0] flex flex-col items-center w-full box-sizing-border">
                        <div class="m-[0_0_1.6rem_1.6rem] flex flex-row justify-start w-full box-sizing-border">
                          <div class="m-[0.1rem_0_0_0] flex w-[5%] h-[1.3rem] box-sizing-border ">
                            <input name="ids[]" type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" value="${data.id}">
                          </div>
                          <span class="break-words font-['Poppins'] font-normal text-[1rem] text-[#0B63F8] w-[15%]">
                              ${data.id_setoran_sampah}
                          </span>
                          <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[15%]">
                          ${data.tanggal}
                          </div>
                          <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[15%]">
                          ${data.nama}
                          </div>
                          <div class="w-[15%]">
                            ${data.status === 'Pesanan Diterima' ? `
                              <div class="rounded-[0.6rem] bg-[#FF9A03] bg-opacity-10 relative flex items-center justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                                  <span class="opacity-100 break-words font-['Poppins'] font-normal text-[1rem] text-[#FF9A03]">
                                    ${data.status}
                                  </span>
                              </div>` : ''}
                            ${data.status === 'Penjemputan' ? `
                              <div class="rounded-[0.6rem] bg-[#E6F4FF] relative flex items-center justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                                  <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#0958D9]">
                                    ${data.status}
                                  </span>
                              </div>` : ''}
                              ${data.status === 'Pesanan Baru' ? `
                              <div class="rounded-[0.6rem] bg-[#F6FFED] relative flex justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                                  <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#52C41A]">
                                    ${data.status}
                                  </span>
                                </div>` : ''}
                              ${data.status === 'Pesanan Ditolak' ? `
                              <div class="rounded-[0.6rem] bg-[#FFF2F0] relative flex justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                                  <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#FF4D4F]">
                                    ${data.status}
                                  </span>
                                </div>` : ''}
                              ${data.status === 'Pesanan Selesai' ? `
                              <div class="rounded-[0.6rem] bg-[#4E9C00] relative flex justify-center p-[0.1rem_0.4rem_0.1rem_0.4rem] box-sizing-border w-fit">
                                  <span class="opacity-[0.65] break-words font-['Poppins'] font-normal text-[1rem] text-[#FFFFFF]">
                                    ${data.status}
                                  </span>
                                </div>` : ''}
                          </div>
                          <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[20%]">
                          Rp ${data.total_harga}
                          </div>
                        </div>
                        <div class="bg-[#F2F2F2] w-[70.6rem] h-[0.1rem]">
                        </div>
                      </div>
                    </a>`
            });
            Container.append(htmls.join(''));
            if (data.length === 0) {
                Container.append('<p>No results found.</p>');
            }
        });
      </script>
</x-app-layout>
