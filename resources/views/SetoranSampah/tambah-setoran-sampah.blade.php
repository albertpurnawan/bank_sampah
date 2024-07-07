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
        {{ __('Tambah Setoran Sampah') }}
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
    <form action="{{ route('setoran-sampah.tambah-insert') }}" method="post" class="w-full">
    @csrf
    @isset($data->id)
        <input name="id_setoran_sampah" value="{{ $data->id_setoran_sampah }}" hidden></input>
    @endisset
        <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">
            <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
            <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
            Setoran Sampah
            </span>   
            </div>
            <div class="flex flex-row w-fit box-sizing-border">
                @isset($data)
                    @if ($data->status !== 'Pesanan Selesai' && $data->status !== 'Pesanan Ditolak')
                        @if(Auth::user()->role == 'Admin')
                            <button class="rounded-[0.6rem] bg-[#009EE2] relative m-[0_2.1rem_0_0] flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
                                <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
                                Menyetujui
                                </span>
                            </button>
                        @endif
                        <button class="rounded-[0.6rem] bg-[#21AA93] relative m-[0_2.1rem_0_0] flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
                            <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
                            Simpan
                            </span>
                        </button>
                    @endif

                @else
                    <button class="rounded-[0.6rem] bg-[#21AA93] relative m-[0_2.1rem_0_0] flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
                        <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
                        Simpan
                        </span>
                    </button>
                @endisset

            </div>
        </div>
        
        <div class="m-[0_0.1rem_0_0.1rem] flex flex-row justify-between self-start w-full box-sizing-border">
            
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Nama
                </div>
                <div class="relative w-full h-fit rounded-[0.5rem]">
                    <input
                        typauthe="text"
                        id="searchNama"
                        name="nama"
                        class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" 
                        placeholder="Nama"
                        value=@isset($data)
                            "{{ $data->id_user }} - {{ $data->nama }}"
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
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Tipe Setor
                </div>
                <div class="relative w-full h-fit overflow-hidden rounded-[0.5rem]">
                    <select name="tipe_setor" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" style="appearance: none;">
                        <option value="">Pilih Tipe</option>
                        @isset($tipe)
                            @foreach ($tipe as $item)
                                @if (isset($data) && $item->id_tipe_setoran == $data->id_tipe_setoran)
                                    <option value="{{ $item->id_tipe_setoran }}" selected>{{ $item->tipe }}</option>
                                @else
                                    <option value="{{ $item->id_tipe_setoran }}">{{ $item->tipe }}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>
                    <div class="absolute inset-y-0 right-[23%] flex items-center pl-3 pointer-events-none">
                        <img class="w-[0.9rem] h-[0.4rem]" src="../../assets/vectors/vector_3_x2.svg" />
                    </div>
                </div>
            </div>
        </div>
        <div class="m-[1rem_0.1rem_0_0.1rem] flex flex-row justify-between self-start w-full box-sizing-border">
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Nomor Whatsapp
                </div>
                <input name="nomor" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="08xxxxxxxx" value="@isset($data->nomor){{$data->nomor}} @else  @endisset"></input>
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Tanggal
                </div>
                <input name="tanggal" type="date" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" value="@isset($data->tanggal){{$data->tanggal}}@else{{date('Y-m-d')}}@endisset"></input>
            </div>
        </div>
        <div class="m-[1rem_0.1rem_0_0.1rem] flex flex-row justify-between self-start w-full box-sizing-border">
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Status
                </div>
                <div class="relative w-full h-fit overflow-hidden rounded-[0.5rem]">
                    <select name="status" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" style="appearance: none;" {{(Auth::user()->role == 'Nasabah' ? 'disabled' : '')}}>
                        <option value="">Pilih Status</option>
                        <option value="Pesanan Baru" @if(isset($data->status) && $data->status == 'Pesanan Baru') selected @elseif((Auth::user()->role == 'Nasabah') && empty($data->status)) selected @endif>Pesanan Baru</option>
                        <option value="Penjemputan" @if(isset($data->status) && $data->status == 'Penjemputan') selected @endif>Penjemputan</option>
                        <option value="Pesanan Diterima" @if(isset($data->status) && $data->status == 'Pesanan Diterima') selected @endif>Pesanan Diterima</option>
                        <option value="Pesanan Ditolak" @if(isset($data->status) && $data->status == 'Pesanan Ditolak') selected @endif>Pesanan Ditolak</option>
                        <option value="Pesanan Selesai" @if(isset($data->status) && $data->status == 'Pesanan Selesai') selected @endif>Pesanan Selesai</option>
                    </select>
                    
                    <div class="absolute inset-y-0 right-[23%] flex items-center pl-3 pointer-events-none">
                        <img class="w-[0.9rem] h-[0.4rem]" src="../../assets/vectors/vector_3_x2.svg" />
                    </div>
                </div>
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Total Harga
                </div>
                <input id="total_harga" name="total_harga" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Rp" @isset($data->id) value="{{ $data->total_harga }}" @else value=0 @endisset readonly></input>
            </div>
        </div>
        <div class="break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] mt-[2.5rem]">
          List Sampah
        </div>
        <table class="p-[3rem] w-full box-sizing-border bg-white">
          <thead>
            <tr class="border-b border-gray-200 justify-start">
              <th class="inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[5%] p-[1.2rem_0.5rem_1.2rem_1rem]">
                  <input type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" id="all-checkbox"/>
              </th>
              <th class="m-[1rem_0_1rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-left w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem]">
                Jenis Sampah
              </th>
              <th class="m-[1rem_0_1rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-left w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem]">
                Qty
              </th>
            </tr>
          </thead>
          <tbody id="tbody-setoran-sampah">

          </tbody>
        </table>
        <div class="flex flex-row m-[3.5rem_0_2rem_2rem]">
        @isset($data)
            @if ($data->status === 'Pesanan Baru' && Auth::user()->role === 'Nasabah')
                <button id="btn-tambah" type="button" class="relative break-words font-['Poppins'] font-normal text-[0.6rem] text-[#000000] bg-[#ECECEC] py-2 px-4 rounded-xl mr-4">
                    Tambah
                </button>
                <button id="btn-hapus" type="button" class="relative break-words font-['Poppins'] font-normal text-[0.6rem] text-[#000000] bg-[#ECECEC] py-2 px-4 rounded-xl mr-4">
                    Hapus
                </button>
            @endif
            @if ($data->status !== 'Pesanan Selesai' && $data->status !== 'Pesanan Ditolak' &&Auth::user()->role === 'Admin')
                <button id="btn-tambah" type="button" class="relative break-words font-['Poppins'] font-normal text-[0.6rem] text-[#000000] bg-[#ECECEC] py-2 px-4 rounded-xl mr-4">
                    Tambah
                </button>
                <button id="btn-hapus" type="button" class="relative break-words font-['Poppins'] font-normal text-[0.6rem] text-[#000000] bg-[#ECECEC] py-2 px-4 rounded-xl mr-4">
                    Hapus
                </button>
            @endif
        @else
            <button id="btn-tambah" type="button" class="relative break-words font-['Poppins'] font-normal text-[0.6rem] text-[#000000] bg-[#ECECEC] py-2 px-4 rounded-xl mr-4">
                Tambah
            </button>
            <button id="btn-hapus" type="button" class="relative break-words font-['Poppins'] font-normal text-[0.6rem] text-[#000000] bg-[#ECECEC] py-2 px-4 rounded-xl mr-4">
                Hapus
            </button>
        @endisset
        
        </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {

            var count = 0;
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
            const list_sampah = <?php echo isset($list_sampah) ? json_encode($list_sampah) : 'null' ?>;
            if (list_sampah != null) {
                count = list_sampah.length-1;
                for (var i = 0; i < list_sampah.length; i++) {
                    addRow(i, list_sampah[i]);
                }
            }
            
            function addRow(i, item) {
                var row = document.createElement('tr');
                row.id = 'tr-setoran-sampah' + i;
                row.classList.add('border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[5%] h-[3.1rem] p-[1.2rem_0.5rem_1.2rem_1rem] text-center">
                        <div class="flex justify-center">
                            <input id="checkbox${i}" type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" onclick="updateButton()"/>
                            <input type="hidden" id="id_list_sampah${i}" name="id_list_sampah[]" value="${item.id_list_sampah}"/>
                        </div>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] border-l border-gray-300 p-[0.5rem_0.5rem_0.5rem_0.5rem]">
                        <div class="relative w-full">
                            <input
                                type="text"
                                id="searchInput${i}"
                                name="jenis_sampah[]"
                                class="searchInput form-input inline-block bg-[#FFFFFF] relative  py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#0B63F8]"
                                placeholder="Search..."
                                value="${item.nama}"
                                onchange="updateTotalHarga()"
                            />
                            <input type="hidden" id="harga_per_kg${i}" name="harga_per_kg[]" value="${item.harga_per_kg}"/>                                    
                            <div id="dropdown${i}" class="dropdown-menu absolute z-10 w-full bg-white border border-gray-300 rounded mt-1 shadow-lg">
                                <ul id="dropdownList${i}" class="max-h-60 overflow-y-auto" >
                                    <!-- Items will be dynamically added here -->
        
                                </ul>
                            </div>    
                        </div>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="qty${i}" name="qty[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="0" value="${item.qty}" onchange="updateTotalHarga()"></input>
                    </td>
                `;
                document.getElementById('tbody-setoran-sampah').appendChild(row);
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
                row.id = 'tr-setoran-sampah' + count;
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
                                name="jenis_sampah[]"
                                class="searchInput form-input inline-block bg-[#FFFFFF] relative  py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#0B63F8]"
                                placeholder="Search..."
                                onchange="updateTotalHarga()"
                            />
                            <input type="hidden" id="harga_per_kg${count}" name="harga_per_kg[]"/>
                            <div id="dropdown${count}" class="dropdown-menu absolute z-10 w-full bg-white border border-gray-300 rounded mt-1 shadow-lg">
                                <ul id="dropdownList${count}" class="max-h-60 overflow-y-auto" >
                                    <!-- Items will be dynamically added here -->
        
                                </ul>
                            </div>    
                        </div>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="qty${count}" name="qty[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="0" onchange="updateTotalHarga()"></input>
                    </td>
                `;
                document.getElementById('tbody-setoran-sampah').appendChild(row);
                create_dropdown(count);

            });

        });

        function updateTotalHarga() {
            const harga_per_kg = Array.from(document.querySelectorAll('input[name="harga_per_kg[]"]'));
            const qty = Array.from(document.querySelectorAll('input[name="qty[]"]'));
            const total_harga = document.getElementById('total_harga');
            let sum = 0;
            harga_per_kg.forEach((input, index) => {
                sum += +input.value * +qty[index].value;
            });
            total_harga.value = sum;
        }

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
            var input = document.getElementById('searchInput'+row_id);
            var dropdown = document.getElementById('dropdown'+row_id);
            var dropdownList = document.getElementById('dropdownList'+row_id);
            var harga = document.getElementById('harga_per_kg'+row_id);

            input.addEventListener('focus', () => {
                dropdown.classList.add('active');
                filterItems('', input, dropdown, dropdownList, harga);
            });

            input.addEventListener('blur', () => {
                setTimeout(() => {
                    dropdown.classList.remove('active');
                }, 100);
            });

            input.addEventListener('input', () => {
                const query = input.value.toLowerCase();
                filterItems(query, input, dropdown, dropdownList, harga);
            });

            
        }

        function filterItems(query, input, dropdown, dropdownList, harga) {
            const items = {!! json_encode($jenis) !!};
            dropdownList.innerHTML = '';
            const filteredItems = items.filter(item => item.nama.toLowerCase().includes(query.toLowerCase()));    
            filteredItems.forEach(item => {
                const li = document.createElement('li');
                li.classList.add('p-2', 'hover:bg-blue-500', 'hover:text-white', 'cursor-pointer');
                li.textContent = item.nama;
                li.addEventListener('mousedown', () => {
                    input.value = item.id_jenis_sampah + ' - ' + item.nama;
                    harga.value = item.harga_per_kg;
                    dropdown.classList.remove('active');
                });
                dropdownList.appendChild(li);
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
                if (checkbox.checked && checkbox.parentNode.parentNode.parentNode.id !== 'tr-setoran-sampah') {
                    var id_row = checkbox.id.replace('checkbox', '');
                    var id_list_sampah = document.getElementById('id_list_sampah'+id_row);
                    if (id_list_sampah !== null) {
                        id_list_sampah = id_list_sampah.value;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('setoran-sampah.delete-row') }}",
                            type: "POST",
                            dataType: "json",
                            data: { id: id_list_sampah},
                            success: function(message) {
                                console.log(message)
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    }
                    
                    checkbox.parentNode.parentNode.parentNode.remove();
                    updateTotalHarga()
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
</x-app-layout>


