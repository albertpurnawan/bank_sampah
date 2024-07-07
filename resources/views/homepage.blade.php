<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <x-guest-layout>
        <div class="flex flex-col items-center justify-center h-screen">
            <div class="flex flex-col w-full mx-auto">
                <div class="m-[0_6.2rem_10.9rem_6.2rem] flex flex-row self-start w-[fit-content] box-sizing-border">
                    <div class="m-[5.4rem_18.2rem_5.6rem_0] flex flex-col box-sizing-border">
                    <div class="m-[0_0_1.3rem_0] inline-block self-start break-words font-['Poppins'] font-bold text-[3.9rem] leading-[1.323] text-[#142E38]">
                    Welcome To LocalRecycle
                    </div>
                    <div class="m-[0_0_1.3rem_0] inline-block break-words font-['Open_Sans'] font-normal text-[1.4rem] leading-[1.5] capitalize text-[#142E38]">
                    Selamat datang ke bang sampah anda dapat menukarkan<br />
                    sampah yang sudah menumpuk menjadi uang atau barang<br />
                    lainnya.
                    </div>
                    <button class="rounded-[0.9rem] border-[0.2rem_solid_#318161] bg-[#318161] relative flex items-center justify-center self-start text-center p-[1.1rem_0.1rem_1.1rem_0] w-[11.9rem] box-sizing-border" onclick="window.location.href='/about'">
                        <span class="break-words font-['Poppins'] font-medium text-[1.5rem] text-[#FFFFFF]">
                            See More
                        </span>
                    </button>
                </div>
                <div class="rounded-[62.5rem] bg-[url('../assets/images/limbah_padat_1.jpeg')] bg-[50%_50%] bg-cover bg-no-repeat w-[34.3rem] h-[34.3rem]">
                </div>
            </div>
        </div>
    </x-guest-layout>
  </body>
</html>
