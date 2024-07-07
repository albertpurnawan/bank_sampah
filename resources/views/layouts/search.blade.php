<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lodash@4.17.20/lodash.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        var page = "{{ url()->current() }}";
        $('#search').on('input', _.debounce(function() {
            var query = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log(page);
            console.log(query);
            $.ajax({
                url: "{{ route('search') }}",
                type: "POST",
                dataType: "json",
                data: { search: query, page: page, data: window.data },
                success: function(data) {
                    window.data = data.data;
                    updateChildBlade(data.data);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }, 1000));
        
        function updateChildBlade(data) {
          $(document).trigger('data', [data]);
        }
      });
    </script>
  </head>
  <body>
    <div class="m-[3.5rem_0_0_0] flex flex-col w-full h-[fit-content] box-sizing-border">
        <div class="relative m-[0_0_2.5rem_0.4rem] flex flex-row justify-between w-full box-sizing-border">
          <input type="text" id="search" name="search" class="rounded-[0.2rem] border-[0.1rem_solid_rgba(0,0,0,0.2)] bg-[#FFFFFF] relative flex flex-row p-[0.9rem_0_0.9rem_3rem] w-[60%] box-sizing-border" placeholder="Cari">
          <div class="m-[0.9rem_0_0.9rem_0.9rem] flex w-[1.5rem] h-[1.5rem] box-sizing-border absolute">
              <img class="w-[1.5rem] h-[1.5rem]" src="../../assets/vectors/search_normal_17_x2.svg" />
          </div>
          </input>
          <div class="flex w-[3.3rem] h-[3.3rem] box-sizing-border">
              <a href="/profile/edit-profile">
                  @isset(Auth::user()->foto)
                    <div class="rounded-[6rem] bg-[url('..{{ Auth::user()->foto }}')] bg-[50%_50%] bg-cover bg-no-repeat w-[3.3rem] h-[3.3rem]"></div>
                  @else
                    <div class="rounded-[6rem] bg-[url('../assets/images/User-avatar.png')] bg-[50%_50%] bg-cover bg-no-repeat w-[3.3rem] h-[3.3rem]"></div>
                  @endisset
              </a>
          </div>
        </div>
        {{ $slot }}
    </div>
  </body>
</html>


