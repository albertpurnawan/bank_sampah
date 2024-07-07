
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
        {{ __('Tambah Penjualan') }}
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
      <form action="{{ route('penjualan.tambah-insert') }}" method="post" class="w-full">
        @csrf
          @isset($data->id)
          <input id="id_penjualan" name="id_penjualan" value="{{ $data->id_penjualan }}" hidden></input>
          @endisset
        <div class="m-[0_6rem_3.3rem_0.3rem] flex flex-row justify-between w-full box-sizing-border">
            <div class="m-[0.3rem_0_1.3rem_0] flex box-sizing-border">
            <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#000000]">
              Penjualan
            </span>   
            </div>
            <div class="flex flex-row w-fit box-sizing-border">
              @isset($data)
                  @if ($data->status !== 'Terjual')
                  <a href="{{ route('penjualan.terjual', $data->id)}}" class="rounded-[0.6rem] bg-[#009EE2] relative m-[0_2.1rem_0_0] flex items-center justify-center p-[1rem_1rem_0.7rem_1rem] w-fit box-sizing-border">
                    <span class="break-words font-['Poppins'] font-normal text-[1.4rem] text-[#FFFFFF]">
                    Terjual
                    </span>
                  </a>
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
                    Jumlah Harga Sampah
                </div>
                <input id="final_harga" name="final_harga" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Rp" @isset($data) value="{{ $data->final_harga }}" @endisset readonly></input>
            </div>
            <div class="rounded-[0.6rem] flex flex-col w-[80%] box-sizing-border">
                <div class="m-[0_0_0.4rem_0] inline-block self-start break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]">
                    Tanggal
                </div>
                <input type="date" name="tanggal" class="rounded-[0.6rem] bg-[#FFFFFF] relative p-[1.6rem_1.6rem_1.6rem_1.6rem] w-[80%] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="DD/MM/YYYY" @isset($data) value="{{ $data->tanggal }}" @endisset></input>
            </div>
        </div>
        <div class="break-words font-['Poppins'] font-normal text-[1rem] text-[#000000] mt-[2.5rem]">
          List Penjualan
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
              <th class="m-[1rem_0_1rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-left w-[15%] p-[0.5rem_0.5rem_0.5rem_0.5rem]">
                Qty
              </th>
              <th class="m-[1rem_0_1rem_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-left w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem]">
                Total Harga
              </th>
            </tr>
          </thead>
          <tbody id="tbody-penjualan">
  
          </tbody>
        </table>
        <div class="flex flex-row m-[3.5rem_0_2rem_2rem]">
          @isset($data)
            @if ($data->status !== 'Terjual')
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
          <script>
            $(document).ready(function() {
            var count = 0;
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
            const selected_list_setoran = <?php echo isset($selected_list_setoran) ? json_encode($selected_list_setoran) : 'null' ?>;
            const data = <?php echo isset($data) ? json_encode($data) : 'null' ?>;
            if (selected_list_setoran != null && data != null) {
                
                count = selected_list_setoran.length-1;
                for (var i = 0; i < selected_list_setoran.length; i++) {
                    addRow(i, selected_list_setoran[i]);
                }
            }
            
            function addRow(i, item) {
                var row = document.createElement('tr');
                row.id = 'tr-list_sampah' + i;
                row.classList.add('border-b', 'border-gray-200');
                row.innerHTML = `
                    <td class="inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[5%] h-[3.1rem] p-[1.2rem_0.5rem_1.2rem_1rem] text-center">
                        <div class="flex justify-center">
                            <input id="checkbox${i}" type="checkbox" class="w-[1.3rem] h-[1.3rem] rounded-xl" onclick="updateButton()"/>
                            <input type="hidden" id="id_setoran_sampah${i}" name="id_setoran_sampah[]" value="${item.id_setoran_sampah}"/>
                        </div>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] border-l border-gray-300 p-[0.5rem_0.5rem_0.5rem_0.5rem]">
                        <div class="relative w-full">
                            <input
                                type="text"
                                id="searchInput${i}"
                                name="penjualan[]"
                                class="searchInput form-input inline-block bg-[#FFFFFF] relative  py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#0B63F8]"
                                placeholder="Search..."
                                value="${item.id_setoran_sampah}"
                            />
                            <div id="dropdown${i}" class="dropdown-menu absolute z-10 w-full bg-white border border-gray-300 rounded mt-1 shadow-lg">
                                <ul id="dropdownList${i}" class="max-h-60 overflow-y-auto" >
                                    <!-- Items will be dynamically added here -->
        
                                </ul>
                            </div>    
                        </div>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="qty${i}" name="qty[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Qty" value="${item.qty}" readonly></input>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="total_harga${i}" name="total_harga[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Total Harga" value="${item.total_harga}" readonly></input>
                    </td>
                `;
                document.getElementById('tbody-penjualan').appendChild(row);
                create_dropdown(i);

            }

            
            
            document.getElementById('btn-tambah').addEventListener('click', function() {
                count++;
                var row = document.createElement('tr');
                row.id = 'tr-list_sampah' + count;
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
                                name="penjualan[]"
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
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[15%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="qty${count}" name="qty[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Qty" readonly></input>
                    </td>
                    <td class="m-[1rem_0_0_0] inline-block break-words font-['Lato'] font-semibold text-[1rem] text-[#000000] w-[25%] p-[0.5rem_0.5rem_0.5rem_0.5rem] border-l border-gray-300">
                        <input id="total_harga${count}" name="total_harga[]" type="text" class="inline-block bg-[#FFFFFF] relative py-[1.6rem] w-full h-[3.1rem] box-sizing-border break-words font-['Poppins'] font-normal text-[1rem] text-[#000000]" placeholder="Total Harga" readonly></input>
                    </td>
                `;
                document.getElementById('tbody-penjualan').appendChild(row);
                create_dropdown(count);

            });

        });

        function create_dropdown(row_id){
            const input = document.getElementById('searchInput'+row_id);
            const dropdown = document.getElementById('dropdown'+row_id);
            const dropdownList = document.getElementById('dropdownList'+row_id);
            const qty = document.getElementById('qty'+row_id);
            const total_harga = document.getElementById('total_harga'+row_id);

            input.addEventListener('focus', () => {
                dropdown.classList.add('active');
                filterItems('', input, dropdown, dropdownList, qty, total_harga);
            });

            input.addEventListener('blur', () => {
                setTimeout(() => {
                    dropdown.classList.remove('active');
                }, 100);
            });

            input.addEventListener('input', () => {
                const query = input.value.toLowerCase();
                qty.value = null;
                total_harga.value = null;
                filterItems(query, input, dropdown, dropdownList, qty, total_harga);
                console.log("AASDASDA");
            });

            
        }

        function filterItems(query, input, dropdown, dropdownList, qty, total_harga) {
            var items = {!! json_encode($list_setoran) !!};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('penjualan.getItemData') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    items = response.data;
                    console.log(items);
                    const inputs = document.querySelectorAll('#tbody-penjualan input');
                    const inputValues = Array.from(inputs).map(input => input.value);
                    dropdownList.innerHTML = '';
                    const filteredItems = items.filter(item => !inputValues.includes(item.id_setoran_sampah) && item.id_setoran_sampah.toLowerCase().includes(query.toLowerCase()));  
                    filteredItems.forEach(item => {
                        const li = document.createElement('li');
                        li.classList.add('p-2', 'hover:bg-blue-500', 'hover:text-white', 'cursor-pointer');
                        li.textContent = item.id_setoran_sampah;
                        li.addEventListener('mousedown', () => {
                            input.value = item.id_setoran_sampah;
                            qty.value = item.qty;
                            total_harga.value = item.total_harga;
                            calculateTotalHarga();
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
        function calculateTotalHarga() {
          var totalHarga = 0;
          var tbody = document.getElementById('tbody-penjualan');
          var rows = tbody.getElementsByTagName('tr');
          
          for (var i = 0; i < rows.length; i++) {
              var cols = rows[i].getElementsByTagName('td');
              
              if (cols.length > 3) {  
                  var hargaInput = cols[3].querySelector('input[name="total_harga[]"]');
                  var harga = parseFloat(hargaInput.value.replace(/[^0-9.-]+/g, "")); 
                  
                  if (!isNaN(harga)) { 
                      totalHarga += harga;
                  }
              }
          }
          
          console.log(totalHarga);
          document.getElementById('final_harga').value = totalHarga; 
        }

        

        document.getElementById('btn-hapus').addEventListener('click', function() {
            
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#all-checkbox)');
            var allCheckbox = document.getElementById('all-checkbox');
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked && checkbox.parentNode.parentNode.parentNode.id !== 'tr-list_sampah') {
                    var id_row = checkbox.id.replace('checkbox', '');
                    var id_setoran_sampah = document.getElementById('id_setoran_sampah'+id_row);
                    if (id_setoran_sampah !== null) {
                        id_setoran_sampah = id_setoran_sampah.value;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('penjualan.delete-row') }}",
                            type: "POST",
                            dataType: "json",
                            data: { id: id_setoran_sampah},
                           
                            success: function(message) {
                                console.log(message)
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    }
                    
                    checkbox.parentNode.parentNode.parentNode.remove();
                    calculateTotalHarga();
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
        </div>
    </form>
  </x-app-layout>