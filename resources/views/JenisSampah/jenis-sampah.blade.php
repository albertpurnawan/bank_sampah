<x-app-layout>
  <x-slot name="header">
    {{ __('Jenis Sampah') }}
  </x-slot>
    <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">      
      <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
          <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
          Jenis Sampah
          </span>   
        </div>
        <div class="flex flex-row w-fit box-sizing-border">
          <a href="/jenis-sampah/tambah" class="rounded-[0.6rem] bg-[#21AA93] relative m-[0_2.1rem_0_0] flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
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
      <div class="flex flex-col items-center self-start w-full box-sizing-border p-[0_5rem_0_0]">
        <div class="m-[0_0_1.8rem_0] flex flex-col items-center w-full box-sizing-border">
          <div class="m-[0_0_1.6rem_1.6rem] flex flex-row justify-start w-full box-sizing-border">
            <div class="m-[0.1rem_0_0_0] flex w-[5%] h-[1.3rem] box-sizing-border ">
              <input type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" id="all-checkbox"/>
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
            Nama
            </div>
            <div class="m-[0_0_0.2rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%]">
            Harga per Kg
            </div>
          </div>
          <div class="bg-[#F2F2F2] w-full h-[0.1rem] ">
          </div>
        </div>
        <form id="form-hapus" action="/jenis-sampah/delete" method="post" enctype="multipart/form-data" class="w-full">
        @csrf
          @foreach($data as $data)
          <a href="jenis-sampah/edit/{{$data->id}}" class="w-full">
            <div class="m-[0_0_1.8rem_0] flex flex-col items-center w-full box-sizing-border">
              <div class="m-[0_0_1.6rem_1.6rem] flex flex-row justify-start w-full box-sizing-border">
                <div class="m-[0.1rem_0_0_0] flex w-[5%] h-[1.3rem] box-sizing-border ">
                    <input name="ids[]" type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" value="{{$data->id}}" />
                </div>
                <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[15%]">
                {{$data->nama}}
                </div>
                <div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] w-[15%]">
                Rp {{$data->harga_per_kg}}
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
          if (allCheckbox.checked) {
            deleteBtn.style.backgroundColor = '#FF4A4A';
            deleteBtn.disabled = false;
          } else {
            deleteBtn.style.backgroundColor = '#BEBEBE';
            deleteBtn.disabled = true;
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
            if (checkAnyChecked()) {
              deleteBtn.style.backgroundColor = '#FF4A4A';
              deleteBtn.disabled = false;
            } else {
              deleteBtn.style.backgroundColor = '#BEBEBE';
              deleteBtn.disabled = true;
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
                return '<a href="jenis-sampah/edit/' + data.id + '" class="w-full">' +
                    '<div class="m-[0_0_1.8rem_0] flex flex-col items-center w-full box-sizing-border">' +
                    '<div class="m-[0_0_1.6rem_1.6rem] flex flex-row justify-start w-full box-sizing-border">' +
                    '<div class="m-[0.1rem_0_0_0] flex w-[5%] h-[1.3rem] box-sizing-border ">' +
                    '<input name="ids[]" type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" value="' + data.id + '"/>' +
                    '</div>' +
                    '<div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-[`Poppins`] font-normal text-[1rem] text-[#000000] w-[15%]">' +
                      data.nama +
                    '</div>' +
                    '<div class="opacity-[0.65] m-[0_0_0.1rem_0] inline-block break-words font-[`Poppins`] font-normal text-[1rem] text-[#000000] w-[15%]">' +
                    'Rp ' + data.harga_per_kg +
                    '</div>' +
                    '</div>' +
                    '<div class="bg-[#F2F2F2] w-[70.6rem] h-[0.1rem]"></div>' +
                    '</div>' +
                    '</a>';
            });
            Container.append(htmls.join(''));
            if (data.length === 0) {
                Container.append('<p>No results found.</p>');
            }
        });


      </script>
</x-app-layout>


