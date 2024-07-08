
<x-app-layout>

  <style>
    /* Custom styles */
    .dropdown-menu {
        display: none;
    }

    .dropdown-menu.active {
        display: block;
    }

    
</style>
  <x-slot name="header">
    {{ __('Tambah Jadwal Pengambilan') }}
  </x-slot>
  <form action="{{ route('jadwal-pengambilan.tambah-insert') }}" method="post" class="w-full">
  @csrf
    @isset($data->id)
    <input id="id_jadwal_pengambilan" name="id_jadwal_pengambilan" value="{{ $data->id_jadwal_pengambilan }}" hidden></input>
    @endisset
      <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">
          <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
          <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
            Jadwal Pengambilan
          </span>   
          </div>
          <div class="flex flex-row w-fit box-sizing-border">
            @isset($data->id)
            <a href="{{ route('jadwal-pengambilan.selesai', $data->id)}}" class="rounded-[0.6rem] bg-[#21AA93] relative m-[0_2.1rem_0_0] flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
                <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
                Selesai
                </span>
            </a>
            @endisset
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
                  Nama Driver
              </div>
              <div class="relative w-full h-fit rounded-[0.5rem]">
                <input
                    typauthe="text"
                    id="searchNama"
                    name="nama_driver"
                    class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" 
                    placeholder="Nama"
                    value=@isset($data)
                        "{{ $data->id_user }} - {{ $data->nama_driver }}"
                    @else
                        "{{ Auth::user()->id_user }} - {{ Auth::user()->nama }}"
                    @endisset
                    autocomplete="off"
                />
        
                <div id="dropdownNama" class="dropdown-menu absolute z-10 w-[80%] bg-white border border-gray-300 rounded mt-1 shadow-lg">
                    <ul id="dropdownListNama" class="max-h-60 overflow-y-auto" >
                        <!-- Items will be dynamically added here -->
                    </ul>
                </div>
                <div class="absolute inset-y-0 right-[23%] flex items-center pl-3 pointer-events-none">
                    <img class="w-[0.9rem] h-[0.4rem]" src="../../assets/vectors/vector_3_x2.svg" />
                </div>
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Status
                </div>
                <div class="relative w-full h-fit overflow-hidden rounded-[0.5rem]">
                    <select name="status" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-full box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" style="appearance: none;">
                            <option value="">Pilih Status</option>
                            <option value="Pending" @if(isset($data->status) && $data->status == 'Pending') selected @endif>Pending</option>
                            <option value="Selesai" @if(isset($data->status) && $data->status == 'Selesai') selected @endif>Selesai</option>
                    </select>
                    <div class="absolute inset-y-0 right-[4%] flex items-center pl-3 pointer-events-none">
                        <img class="w-[0.9rem] h-[0.4rem]" src="../../assets/vectors/vector_3_x2.svg" />
                    </div>
                </div>
            </div>
          </div>
          <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
              <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                  Nomor Whatsapp
              </div>
              <input name="nomor" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="08*********" @isset($data) value="{{ $data->nomor }}"
                  
              @endisset></input>
          </div>
      </div>
      <div class="break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] mt-[2.5rem]">
        Alamat Penjemputan
      </div>
      <table class="p-[3rem] w-full box-sizing-border bg-white">
        <thead>
          <tr class="border-b border-gray-200 justify-start">
            <th class="inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[5%] p-[1.2rem_0.5rem_1.2rem_1rem]">
                <input type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" id="all-checkbox"/>
            </th>
            <th class="m-[1rem_0_1rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-left w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem]">
              Setoran ID
            </th>
            <th class="m-[1rem_0_1rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-left w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem]">
              Nama
            </th>
            <th class="m-[1rem_0_1rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-left w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem]">
              Alamat
            </th>
          </tr>
        </thead>
        <tbody id="tbody-jadwal-pengambilan">

        </tbody>
      </table>
      <div class="flex flex-row m-[3.5rem_0_2rem_2rem]">
        <button id="btn-tambah" type="button" class="relative break-words font-['Poppins'] font-normal text-[0.6rem] text-[#000000] bg-[#ECECEC] py-2 px-4 rounded-xl mr-4">
            Tambah
        </button>
        <button id="btn-hapus" type="button" class="relative break-words font-['Poppins'] font-normal text-[0.6rem] text-[#000000] bg-[#ECECEC] py-2 px-4 rounded-xl mr-4">
            Hapus
        </button>
           
      </div>
      <script>
        $(document).ready(function() {
            var count = 0;
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
            const selected_setoran_user = <?php echo isset($selected_setoran_user) ? json_encode($selected_setoran_user) : 'null' ?>;
            const data = <?php echo isset($data) ? json_encode($data) : 'null' ?>;
            if (selected_setoran_user != null && data != null) {
                
                count = selected_setoran_user.length-1;
                for (var i = 0; i < selected_setoran_user.length; i++) {
                    addRow(i, selected_setoran_user[i]);
                }
            }
            
            function addRow(i, item) {
                var row = document.createElement('tr');
                row.id = 'tr-alamat-penjemputan' + i;
                row.classList.add('border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[5%] h-[3.1rem] p-[1.2rem_0.5rem_1.2rem_1rem] text-center">
                        <div class="flex justify-center">
                            <input id="checkbox${i}" type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" onclick="updateButton()"/>
                            <input type="hidden" id="id_alamat_penjemputan${i}" name="id_alamat_penjemputan[]" value="${item.id_alamat_penjemputan}"/>
                        </div>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] border-l border-gray-300 p-[0.5rem_0.5rem_0.5rem_0.5rem]">
                        <div class="relative w-full">
                            <input
                                type="text"
                                id="searchInput${i}"
                                name="setoran_sampah[]"
                                class="searchInput form-input inline-block bg-[#FFFFFF] relative  py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#0B63F8]"
                                placeholder="Search..."
                                value="${item.id_setoran_sampah} - ${item.nama}"
                            />
                            <div id="dropdown${i}" class="dropdown-menu absolute z-10 w-full bg-white border border-gray-300 rounded mt-1 shadow-lg">
                                <ul id="dropdownList${i}" class="max-h-60 overflow-y-auto" >
                                    <!-- Items will be dynamically added here -->
        
                                </ul>
                            </div>    
                        </div>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="nama${i}" name="nama[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Alamat" value="${item.nama}" readonly></input>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="alamat${i}" name="alamat[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Nama" value="${item.alamat}"></input>
                    </td>
                `;
                document.getElementById('tbody-jadwal-pengambilan').appendChild(row);
                create_dropdown(i);

            }

            const inputNama = document.getElementById('searchNama');
            const dropdownNama = document.getElementById('dropdownNama');
            const dropdownListNama = document.getElementById('dropdownListNama');


            inputNama.addEventListener('focus', () => {
                dropdownNama.classList.add('active');
                filterItemsNama('', inputNama, dropdownNama, dropdownListNama);
            });

            inputNama.addEventListener('blur', () => {
                setTimeout(() => {
                    dropdownNama.classList.remove('active');
                }, 100);
            });

            inputNama.addEventListener('input', () => {
                const queryNama = inputNama.value.toLowerCase();
                filterItemsNama(queryNama, inputNama, dropdownNama, dropdownListNama);
            });
            
            document.getElementById('btn-tambah').addEventListener('click', function() {
                count++;
                var row = document.createElement('tr');
                row.id = 'tr-alamat-penjemputan' + count;
                row.classList.add('border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[5%] h-[3.1rem] p-[1.2rem_0.5rem_1.2rem_1rem]">
                        <div class="flex justify-center">
                            <input id="checkbox${count}" type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" onclick="updateButton()"/>
                        </div>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] border-l border-gray-300 p-[0.5rem_0.5rem_0.5rem_0.5rem]">
                        <div class="relative w-full">
                            <input
                                type="text"
                                id="searchInput${count}"
                                name="setoran_sampah[]"
                                class="searchInput form-input inline-block bg-[#FFFFFF] relative  py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#0B63F8]"
                                placeholder="Search..."
                            />
                            <div id="dropdown${count}" class="dropdown-menu absolute z-10 w-full bg-white border border-gray-300 rounded mt-1 shadow-lg">
                                <ul id="dropdownList${count}" class="max-h-60 overflow-y-auto" >
                                    <!-- Items will be dynamically added here -->
        
                                </ul>
                            </div>    
                        </div>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="nama${count}" name="nama[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Nama" readonly></input>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="alamat${count}" name="alamat[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Alamat"></input>
                    </td>
                `;
                document.getElementById('tbody-jadwal-pengambilan').appendChild(row);
                create_dropdown(count);

            });

        });
        
        function filterItemsNama(query, input, dropdown, dropdownList) {
            const items = {!! json_encode($user) !!};
            dropdownList.innerHTML = '';
            const filteredItems = items.filter(item => item.nama.toLowerCase().includes(query.toLowerCase()));    
            if ("{{ Auth::user()->role }}" == 'Nasabah') {
                    const li = document.createElement('li');
                        li.classList.add('p-2', 'hover:bg-blue-500', 'hover:text-white', 'cursor-pointer');
                        li.textContent = "{{ Auth::user()->nama }}";
                        li.addEventListener('mousedown', () => {
                            input.value = "{{ Auth::user()->id_user }}" + ' - ' + "{{ Auth::user()->nama }}";
                            dropdown.classList.remove('active');
                        });
                        dropdownList.appendChild(li);
                }else{
                filteredItems.forEach(item => {
                    
                        const li = document.createElement('li');
                        li.classList.add('p-2', 'hover:bg-blue-500', 'hover:text-white', 'cursor-pointer');
                        li.textContent = item.nama;
                        li.addEventListener('mousedown', () => {
                            input.value = item.id_user + ' - ' + item.nama;
                            dropdown.classList.remove('active');
                        });
                        dropdownList.appendChild(li);
                });
            }

        }

        function create_dropdown(row_id){
            const input = document.getElementById('searchInput'+row_id);
            const dropdown = document.getElementById('dropdown'+row_id);
            const dropdownList = document.getElementById('dropdownList'+row_id);
            const nama = document.getElementById('nama'+row_id);
            const alamat = document.getElementById('alamat'+row_id);

            input.addEventListener('focus', () => {
                dropdown.classList.add('active');
                filterItems('', input, dropdown, dropdownList, nama, alamat);
            });

            input.addEventListener('blur', () => {
                setTimeout(() => {
                    dropdown.classList.remove('active');
                }, 100);
            });

            input.addEventListener('input', () => {
                const query = input.value.toLowerCase();
                nama.value = null;
                alamat.value = null;
                filterItems(query, input, dropdown, dropdownList, nama, alamat);
                console.log("AASDASDA");
            });

            
        }

        function filterItems(query, input, dropdown, dropdownList, nama, alamat) {
            var items = {!! json_encode($setoran_user) !!};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('jadwal-pengambilan.getItemData') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    items = response.data;
                    const inputs = document.querySelectorAll('#tbody-jadwal-pengambilan input');
                    const inputValues = Array.from(inputs).map(input => input.value);
                    dropdownList.innerHTML = '';
                    const filteredItems = items.filter(item => !inputValues.includes(item.id_setoran_sampah+' - '+item.nama) && item.id_setoran_sampah.toLowerCase().includes(query.toLowerCase()));  
                    filteredItems.forEach(item => {
                        const li = document.createElement('li');
                        li.classList.add('p-2', 'hover:bg-blue-500', 'hover:text-white', 'cursor-pointer');
                        li.textContent = item.id_setoran_sampah;
                        li.addEventListener('mousedown', () => {
                            input.value = item.id_setoran_sampah + ' - ' + item.nama;
                            nama.value = item.nama;
                            alamat.value = item.alamat;
                            dropdown.classList.remove('active');
                        });
                        dropdownList.appendChild(li);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });

        }

        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var allCheckbox = document.getElementById('all-checkbox');
        function checkAll() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = allCheckbox.checked;
            });
            var hapus = document.getElementById('btn-hapus');
            if (allCheckbox.checked) {
                hapus.style.backgroundColor = '#FF4A4A';
                hapus.disabled = false;
            } else {
                hapus.style.backgroundColor = '#ECECEC';
                hapus.disabled = true;
            }
        }
        function checkAnyChecked() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var anyChecked = false;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                anyChecked = true;
                }
            });
            return anyChecked;
        }
        function updateButton(){
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var hapus = document.getElementById('btn-hapus');
                    if (checkAnyChecked()) {
                    hapus.style.backgroundColor = '#FF4A4A';
                    hapus.disabled = false;
                    } else {
                    hapus.style.backgroundColor = '#ECECEC';
                    hapus.disabled = true;
                    }
                });
            });
        }

        allCheckbox.addEventListener('change', function() {
        checkAll();
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = allCheckbox.checked;
        });
        });
        
        
        document.getElementById('btn-hapus').addEventListener('click', function() {
            
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#all-checkbox)');
            var allCheckbox = document.getElementById('all-checkbox');
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked && checkbox.parentNode.parentNode.parentNode.id !== 'tr-alamat-penjemputan') {
                    var id_row = checkbox.id.replace('checkbox', '');
                    var id_alamat_penjemputan = document.getElementById('id_alamat_penjemputan'+id_row);
                    if (id_alamat_penjemputan !== null) {
                        id_alamat_penjemputan = id_alamat_penjemputan.value;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('jadwal-pengambilan.delete-row') }}",
                            type: "POST",
                            dataType: "json",
                            data: { id: id_alamat_penjemputan},
                            success: function(message) {
                                console.log(message)
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    }
                    
                    checkbox.parentNode.parentNode.parentNode.remove();
                    var hapus = document.getElementById('btn-hapus');
                    hapus.style.backgroundColor = '#ECECEC';
                    hapus.disabled = true;
                    if (allCheckbox.checked) {
                        allCheckbox.checked = false;
                    }
                }
            });
        }); 
    </script>
  </form>
</x-app-layout>