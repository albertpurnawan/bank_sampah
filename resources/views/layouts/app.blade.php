<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Local Recycle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
    <style>
        a {
          text-decoration: none
        }
      </style>
</head>
  <body>
        @if (session()->has('success'))
        <div id="alert" class="fixed top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 p-[5rem] z-10">
        <div class="bg-white rounded-lg border border-gray-300 p-[2rem_5rem_5rem_5rem] flec flex-col justify-center items-center">
            <div class="flex justify-center items-center">
            <lottie-player
                src="/assets/json/approve.json" 
                background="transparent" 
                speed="1" 
                style="width: 4rem; height: 4rem;" 
                loop 
                autoplay>
            </lottie-player>
            </div>
            <p class="text-gray-800 pt-2">{{ session('success') }}</p>
            <a href="javascript:void(0)" onclick="hideAlert()" class="absolute top-[60%] mt-2 left-1/2 -translate-x-1/2 w-20 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white">
            OK
            </a>
        </div>
        </div>  
        @endif
        <div class="bg-[#F8F8F8] flex flex-row p-[0_4.1rem_0_0] w-full box-sizing-border">
            <div class="bg-[#FFFFFF] relative m-[0_2.4rem_7.7rem_0] flex flex-col p-[20px_20px 20px_40px] box-sizing-border w-[15%] h-screen">
                <img src="{{ asset('assets/images/LocalRecyle_1.png') }}" alt="Logo" class="w-44 h-28 mx-8">
                <div class="flex flex-row self-start w-[fit-content] box-sizing-border">
                    <div class="flex flex-col box-sizing-border ml-10">
                        @if (Auth::user()->role == 'Admin')
                        <a href="/informasi-bank"> 
                            <div id="informasi-bank" class="opacity-60 m-[0_1.1rem_2.6rem_0] flex flex-row p-[0_0rem_0_0] w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0_0.9rem_0_0] flex w-[1.5rem] h-[1.5rem] box-sizing-border">
                                    <img class="w-[1.5rem] h-[1.5rem]" src="../../assets/vectors/element_315_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                    Informasi Bank
                                </span>
                            </div>
                        </a>
                        <a href="/jenis-sampah">
                            <div id="jenis-sampah" class="opacity-60 m-[0_0_2.6rem_0] flex flex-row self-start p-[0_0rem_0_0] w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0_1rem_0_0] flex w-[1.5rem] h-[1.5rem] box-sizing-border">
                                    <img class="w-[1.5rem] h-[1.5rem]" src="../../assets/vectors/vector_290_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                    Jenis Sampah
                                </span>
                            </div>
                        </a>
                        <a href="/tipe-setoran">
                            <div id="tipe-setoran" class="m-[0_0_2.6rem_0] flex self-start p-[0_0rem_0_0] w-[fit-content] box-sizing-border saturate-0">
                                <div class="opacity-60 flex flex-row p-[0_0rem_0_0] box-sizing-border">
                                    <div class="m-[0_1rem_0_0] flex w-[1.5rem] h-[1.5rem] box-sizing-border">
                                        <img class="w-[1.5rem] h-[1.5rem]" src="../../assets/vectors/vector_234_x2.svg" />
                                    </div>
                                    <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                    Tipe Setoran
                                    </span>
                                </div>
                            </div>
                        </a>
                        <a href="/pengguna">
                            <div id="pengguna" class="opacity-60 m-[0_0_2.6rem_0] flex flex-row self-start p-[0_0rem_0_0] w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0_1rem_0_0] flex w-[1.5rem] h-[1.5rem] box-sizing-border">
                                    <img class="w-[1.5rem] h-[1.5rem]" src="../../assets/vectors/vector_193_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                Pengguna
                                </span>
                            </div>
                        </a>
                        <a href="/jadwal-pengambilan">
                            <div id="jadwal-pengambilan" class="opacity-60 m-[0_0_2.6rem_0] flex flex-row self-start p-[0_0rem_0_0] w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0.8rem_1rem_0.8rem_0] flex w-[1.5rem] h-[1.5rem] box-sizing-border">
                                    <img class="w-[1.5rem] h-[1.5rem]" src="../../assets/vectors/vector_327_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                Jadwal <br />
                                Pengambilan
                                </span>
                            </div>
                        </a>
                        <a href="/setoran-sampah">
                            <div id="setoran-sampah" class="opacity-60 m-[0_0_2.6rem_0.1rem] flex flex-row w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0_1.1rem_0_0] flex w-[1.4rem] h-[1.5rem] box-sizing-border">
                                    <img class="w-[1.4rem] h-[1.5rem]" src="../../assets/vectors/vector_95_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                    Setoran Sampah
                                </span>
                            </div>
                        </a>
                        <a href="/penjualan">
                            <div id="penjualan" class="opacity-60 m-[0_0_2.6rem_0] flex flex-row self-start w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0_1rem_0_0] flex w-[1.5rem] h-[1.5rem] box-sizing-border">
                                    <img class="w-[1.5rem] h-[1.5rem]" src="../../assets/vectors/vector_313_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                    Penjualan
                                </span>
                            </div>
                        </a>
                        <a href="/keuangan">
                            <div id="keuangan" class="opacity-60 flex flex-row self-start p-[0_0rem_0_0] w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0.1rem_0.9rem_0.1rem_0] flex w-[1.5rem] h-[1.3rem] box-sizing-border">
                                    <img class="w-[1.5rem] h-[1.3rem]" src="../../assets/vectors/vector_343_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                Keuangan
                                </span>
                            </div>
                        </a>
                        @else
                        <a href="/setoran-sampah">
                            <div id="setoran-sampah" class="opacity-60 m-[0_0_2.6rem_0.1rem] flex flex-row w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0_1.1rem_0_0] flex w-[1.4rem] h-[1.5rem] box-sizing-border">
                                    <img class="w-[1.4rem] h-[1.5rem]" src="../../assets/vectors/vector_95_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                    Setoran Sampah
                                </span>
                            </div>
                        </a>
                        <a href="/penjualan">
                            <div id="penjualan" class="opacity-60 m-[0_0_2.6rem_0] flex flex-row self-start w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0_1rem_0_0] flex w-[1.5rem] h-[1.5rem] box-sizing-border">
                                    <img class="w-[1.5rem] h-[1.5rem]" src="../../assets/vectors/vector_313_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                    Riwayat Penjualan
                                </span>
                            </div>
                        </a>
                        <a href="/keuangan">
                            <div id="keuangan" class="opacity-60 flex flex-row self-start p-[0_0rem_0_0] w-[fit-content] box-sizing-border saturate-0">
                                <div class="m-[0.1rem_0.9rem_0.1rem_0] flex w-[1.5rem] h-[1.3rem] box-sizing-border">
                                    <img class="w-[1.5rem] h-[1.3rem]" src="../../assets/vectors/vector_343_x2.svg" />
                                </div>
                                <span class="break-words font-['Poppins'] font-normal text-[1rem] tracking-[0rem] text-[#21AA93]">
                                Keuangan
                                </span>
                            </div>
                        </a>
                        @endif
                        
                    </div>
                </div>
            </div>
            
        @if (!str_contains(url()->current(), '/profile/edit-profile') && !str_contains(url()->current(), '/profile/profile-bank') && !str_contains(url()->current(), '/profile/ganti-password'))
            <x-search-layout>
                {{ $slot }}
            </x-search-layout>
        @else
            {{ $slot }}
        @endif
        <script>
            window.onload = function() {
                const pathname = window.location.pathname;
                const menu = pathname.split('/')[1];
                console.log(menu)
                if (menu) {
                    const menuButton = document.getElementById(menu);
                    if (menuButton) {
                        menuButton.classList.toggle("saturate-100");
                    }
                }

            }
            function hideAlert(){
                document.getElementById("alert").style.display = "none";
            }
        </script>

    </body>
</html>
