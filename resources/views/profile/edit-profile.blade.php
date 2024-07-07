<x-profile-layout>
  <x-slot name="header">
    {{ __('Profile') }}
  </x-slot>
  <form action="{{ route('profile.edit-profile.update') }}" method="POST" class="w-full" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-col box-sizing-border w-full">
      <div class="m-[0_0_1.4rem_0.5rem] flex flex-row w-full box-sizing-border">
        @isset(Auth::user()->foto)
          <div id="imagePreview" class="rounded-full bg-[url('..{{ Auth::user()->foto }}')] bg-[50%_50%] bg-cover bg-no-repeat relative m-[0_2.5rem_0_0] flex p-[9.4rem_0_0.7rem_9.4rem] w-[11.3rem] h-[11.3rem] box-sizing-border">
            <div class="shadow-[0rem_0.3rem_0.3rem_0rem_rgba(0,0,0,0.25)] rounded-full absolute left-[50%] top-[0rem] translate-x-[-50%] w-[11.3rem] h-[11.3rem]">
              <input type="file" class="hidden" id="profile-image" accept=".png, .jpg, .jpeg" onchange="previewImage(this)" name="foto"/>
              <label for="profile-image" class="rounded-[1.3rem] bg-[var(--secandery-one,#26B893)] absolute top-[8.8rem] right-[0.8rem] w-[2.5rem] h-[2.5rem] flex items-center justify-center cursor-pointer">
                <img class="w-[1.3rem] h-[1.1rem]" src="../assets/vectors/camera_2_x2.svg" />
              </label>
            </div>
          </div>
          @else
            <div id="imagePreview" class="rounded-full bg-[url('../assets/images/User-avatar.png')] bg-[50%_50%] bg-cover bg-no-repeat relative m-[0_2.5rem_0_0] flex p-[9.4rem_0_0.7rem_9.4rem] w-[11.3rem] h-[11.3rem] box-sizing-border">
              <div class="shadow-[0rem_0.3rem_0.3rem_0rem_rgba(0,0,0,0.25)] rounded-full absolute left-[50%] top-[0rem] translate-x-[-50%] w-[11.3rem] h-[11.3rem]">
                <input type="file" class="hidden" id="profile-image" accept=".png, .jpg, .jpeg" onchange="previewImage(this)" name="foto"/>
                <label for="profile-image" class="rounded-[1.3rem] bg-[var(--secandery-one,#26B893)] absolute top-[8.8rem] right-[0.8rem] w-[2.5rem] h-[2.5rem] flex items-center justify-center cursor-pointer">
                  <img class="w-[1.3rem] h-[1.1rem]" src="../assets/vectors/camera_2_x2.svg" />
                </label>
              </div>
            </div>
          @endisset
        <div class="m-[4.9rem_0_2.5rem_0] flex flex-row justify-between w-full h-[fit-content] box-sizing-border">
          <div class="flex flex-col box-sizing-border">
            <div class="m-[0_0_0.5rem_0] inline-block self-start break-words font-['Nunito'] font-bold text-[1.5rem] text-[var(--primary-one,#083A50)]">
              {{ Auth::user()->nama }}
            </div>
            @if(Auth::user()->is_lengkap == '0')
              <span class="break-words font-['Nunito'] font-bold text-[1.3rem] leading-[0.98] text-[var(--primary-one,#FF4A4A)]">
                Mohon lengkapi profile anda
              </span>
            @else
              <span class="break-words font-['Nunito'] font-bold text-[1.3rem] leading-[0.98] text-[var(--primary-one,#083A50)]">
                Profile anda sudah lengkap
              </span>
            @endif
          </div>
        </div>
      </div>
      <div class="m-[0_0_2.5rem_0] flex flex-col items-center w-full box-sizing-border">
        <div class="m-[0_0_2.5rem_0] flex flex-row justify-between w-full box-sizing-border">
          <span class="m-[0_1rem_0_0] w-[32.9rem] break-words font-['Nunito'] font-bold text-[1.5rem] text-[var(--secandery-two,#CACED8)]">
          Edit Profile 
          </span>
          <div class="m-[0.3rem_0_0.3rem_0] inline-block break-words font-['Nunito'] font-bold text-[1rem] text-[var(--secandery-two,#CACED8)]">
          {{-- Terakhir Update
          {{ \Carbon\Carbon::parse(Auth::user()->updated_at)->isoFormat('D MMMM YYYY HH:mm:ss') }} --}}
          </div>
        </div>
        <div class="flex flex-row w-full box-sizing-border justify-start">
          <div class="m-[0_3.8rem_2.6rem_0] flex flex-col w-[50%] box-sizing-border">
            <div class="m-[0_0_1.5rem_0] flex flex-col w-full box-sizing-border">
              <div class="m-[0_0_1.5rem_0] inline-block self-start break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--secandery-two,#CACED8)]">
              Personal
              </div>
              <div class="flex flex-col w-full box-sizing-border">
                <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                  <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                  Nama
                  </span>
                </div>
                <input type="text" name="nama" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" placeholder="Nama" value="{{ Auth::user()->nama }}">
                </input>
                <x-input-error :messages="$errors->get('nama')" class="px-12" />
              </div>
            </div>
            <div class="m-[0_0rem_1.5rem_0] flex flex-col w-full box-sizing-border">
              <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                Kode Pos
                </span>
              </div>
              <input type="text" name="kode_pos" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" placeholder="Kode Pos" value="{{ Auth::user()->kode_pos }}">
              </input>
              <x-input-error :messages="$errors->get('kode_pos')" class="px-12" />
            </div>
            <div class="m-[0_0rem_1.5rem_0] flex flex-col w-full box-sizing-border">
              <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                Tanggal Lahir
                </span>
              </div>
              <input type="date" name="tanggal_lahir" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" placeholder="MM/DD/YYYY" value="{{ Auth::user()->tanggal_lahir }}">
              </input>
              <x-input-error :messages="$errors->get('tanggal_lahir')" class="px-12" />
            </div>
            <div class="m-[0_0rem_1.5rem_0] flex flex-col  w-full box-sizing-border">
              <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                Kota
                </span>
              </div>
              <input type="text" name="kota" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" placeholder="Kota" value="{{ Auth::user()->kota }}">
              </input>
              <x-input-error :messages="$errors->get('kota')" class="px-12" />
            </div>
          </div>
          <div class="flex flex-col w-[50%] box-sizing-border">
            <div class="m-[0_0_1.5rem_0] inline-block self-start break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--secandery-two,#CACED8)]">
            Kontak
            </div>
            <div class="flex flex-col w-full box-sizing-border">
              <div class="m-[0_0_1.5rem_0] flex flex-col w-full box-sizing-border">
                <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                  <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                  Email
                  </span>
                </div>
                <input type="email" name="email" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" placeholder="email" value="{{ Auth::user()->email }}">
                </input>
                <x-input-error :messages="$errors->get('email')" class="px-12" />
              </div>
              <div class="m-[0_0_1.5rem_0] flex flex-col w-full box-sizing-border">
                <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                  <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                  Phone Number
                  </span>
                </div>
                <div class="flex flex-row w-full box-sizing-border">
                  <input type="text" name="nomor" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] m-[0_0.5rem_0_0] flex flex-row p-[0.7rem_0.9rem_0.7rem_0.7rem] w-[10%] box-sizing-border" placeholder="+62" value="+62" readonly>
                  </input>
                  <x-input-error :messages="$errors->get('nomor')" class="px-12" />
                  <input type="text" name="nomor-2" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-[89%] m-[0_0_0_0.3rem] box-sizing-border" placeholder="0" value="{{ Auth::user()->nomor }}">
                  </input>
                  <x-input-error :messages="$errors->get('nomor-2')" class="px-12" />
                </div>
              </div>
              <div class="flex flex-col w-full box-sizing-border">
                <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                  <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                  Alamat
                  </span>
                </div>
                <textarea name="alamat" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0_0.7rem_6.5rem_0.7rem] box-sizing-border w-full"
                placeholder="Alamat Lengkap" rows="3">{{ Auth::user()->alamat }}</textarea>
                <x-input-error :messages="$errors->get('alamat')" class="px-12" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-one,#26B893)] bg-[var(--secandery-one,#26B893)] flex self-start p-[0.6rem_0_0.6rem_0.1rem] w-[8rem] box-sizing-border items-center justify-center">
        <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-tow,#FFFFFF)]">
        Save
        </span>
      </button>
    </div>
  </form>
</x-profile-layout>