<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
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
      <div class="flex flex-col items-center h-screen">
        <div class="flex items-center justify-center h-screen">
          <div class="rounded-[30px] bg-[#FFFFFF] flex flex-col items-center p-[26px_0_35.2px_0] w-[520px]">
            <div class="text-center inline-block break-words font-['Poppins'] font-normal text-[74px] leading-[0.649] text-[#009EE2] pb-6">
              Welcome
            </div>
              
            <span class="text-center break-words font-['Poppins'] font-medium text-[1rem] text-[rgba(0,0,0,0.5)] pb-2">
              Please Register First
            </span>
              
            <form action="{{ route('register') }}" method="POST" class="w-full">
              @csrf

              <x-guest-input name="Nama" id="nama" type="text" asset="../assets/vectors/user.svg" placeholder="Nama"/>
              <x-guest-input name="Email" id="email" type="email" asset="../assets/vectors/sms_x2.svg" placeholder="@mail.com"/>
              <x-guest-input name="Nomor Whatsapp" id="nomor" type="text" asset="../assets/vectors/phone-call.svg" placeholder="08XXXXXXXX"/>
              <x-guest-input name="Password" id="password" type="password" asset="../assets/vectors/lock_1_x2.svg" placeholder="*******"/>
              <x-guest-input name="Confirm Password" id="password_confirmation" type="password" asset="../assets/vectors/lock_1_x2.svg" placeholder="*******"/>

              <div class="flex flex-col items-center justify-center">
                <div class="flex flex-row items-center justify-center w-full">
                  <p class="mr-2">Already have account? </p>
                  <a href="/login" class="font-bold">Login Now</a>
                </div>
                <button class="rounded-[5px] bg-[#009EE2] m-[20px_1px_0px_0] flex text-center p-[15px_30px_15px_30px] w-fit hover:bg-[#0085C7]" type="submit">
                  <span class="break-words font-['Poppins'] font-bold text-[14px] leading-[1.286] uppercase text-[#FFFFFF]">
                    Register
                  </span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </x-guest-layout>
  </body>
</html>

