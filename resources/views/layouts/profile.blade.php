<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  </head>
  <body>
    <x-app-layout>
      <div id="alert" class="hidden fixed top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 p-[5rem] z-10">
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
          <p class="text-gray-800 pt-2">Logout berhasil</p>
          <a href="javascript:void(0)" onclick="hideAlertLogout()" class="absolute top-[60%] mt-2 left-1/2 -translate-x-1/2 w-20 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white">
            OK
          </a>
        </div>
      </div>
      <div class="m-[0.8rem_0_0_0] flex flex-col box-sizing-border w-full">
        <div class="flex flex-row self-start w-full box-sizing-border">
          <div class="m-[3rem_3.9rem_7.7rem_0] flex flex-row box-sizing-border w-[20%]">
            <div class="m-[2.3rem_2rem_16rem_0] flex flex-col w-[calc(30% - 1rem)] box-sizing-border">
              <a href="/profile/edit-profile">
                  <div id="edit-profile" class="rounded-[0.5rem] m-[0_0_2.3rem_0] p-[0.8rem_0.8rem_0.8rem_0.8rem] w-full box-sizing-border">
                      <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[rgba(19,19,19,0.6)]">
                      Edit Profile
                      </span>
                  </div>
              </a>
              <a href="/profile/profile-bank">
                  <div id="profile-bank" class="rounded-[0.5rem] m-[0_0_2.3rem_0] p-[0.8rem_0.8rem_0.8rem_0.8rem] w-full box-sizing-border">
                      <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[rgba(19,19,19,0.6)]">
                      Informasi Bank
                      </span>
                  </div>
              </a>
              <a href="/profile/ganti-password">
                  <div id="ganti-password" class="rounded-[0.5rem] m-[0_0_2.3rem_0] p-[0.8rem_0.8rem_0.8rem_0.8rem] w-full box-sizing-border">
                      <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[rgba(19,19,19,0.6)]">
                      Password &amp; Sekuriti
                      </span>
                  </div>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); showAlertLogout();">
                <div id="logout" class="rounded-[0.5rem] m-[0_0_2.3rem_0] p-[0.8rem_0.8rem_0.8rem_0.8rem] w-full box-sizing-border">
                    <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[rgba(19,19,19,0.6)]">
                    Logout
                    </span>
                </div>
              </a>
            </div>
            <div class="bg-[rgba(94,94,94,0.4)] w-[0.1rem] h-full">
            </div>
          </div>
          {{ $slot }}
        </div>
      </div>
      
    </x-app-layout>
    <script>
        const pathname = window.location.pathname;
        const menu = pathname.split('/')[2];
        if (menu) {
            const menuButton = document.getElementById(menu);
            if (menuButton) {
                menuButton.style.backgroundColor = menuButton.style.backgroundColor === '#EAF8F5' ? '' : '#EAF8F5';
                const spanElement = menuButton.querySelector('span');
                spanElement.style.color = spanElement.style.color === '#131313' ? '' : '#131313';
            }
        }
        function showAlertLogout() {
          setTimeout(function(){
            document.querySelectorAll("button, a, input, select, textarea").forEach(function(el) {
              el.disabled = true;
            });
            document.getElementById("alert").style.display = "block";
          }, 1);
          setTimeout(function(){
            document.getElementById("alert").style.display = "none";
            document.querySelectorAll("button, a, input, select, textarea").forEach(function(el) {
              el.disabled = false;
            });
            document.getElementById('logout-form').submit();
          }, 3000);
        };
        function hideAlertLogout(){
          document.getElementById("alert").style.display = "none";
          document.querySelectorAll("button, a, input, select, textarea").forEach(function(el) {
              el.disabled = false;
          });
          document.getElementById('logout-form').submit();
        }
        function previewImage(file){
          if(file.files && file.files[0]){
            var reader = new FileReader();
            reader.onload = function(e) {
              const imagePreview = document.getElementById('imagePreview');
              imagePreview.style.backgroundImage = 'url(' + e.target.result + ')';
              imagePreview.style.display = 'none';
              imagePreview.style.opacity = 0;
              imagePreview.offsetHeight; // trigger reflow
              imagePreview.style.display = 'block';
              imagePreview.style.opacity = 1;
            }
            reader.readAsDataURL(file.files[0]);
          }
        }

    </script>
  </body>
</html>

