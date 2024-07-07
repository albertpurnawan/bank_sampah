<x-profile-layout>
  <x-slot name="header">
    {{ __('Informasi Bank') }}
  </x-slot>
  <form action="{{ route('profile.ganti-password.update') }}" method="POST" class="w-full" enctype="multipart/form-data">
      @csrf
      <div class="flex flex-col box-sizing-border w-full">
        <div class="m-[0_0_2.5rem_0] flex flex-col items-center w-full box-sizing-border">
          <div class="m-[0_0_2.5rem_0] flex flex-row justify-between w-full box-sizing-border">
            <span class="m-[0_1rem_0_0] w-[32.9rem] break-words font-['Nunito'] font-bold text-[1.5rem] text-[var(--secandery-two,#CACED8)]">
            Ganti Password
            </span>
            <div class="m-[0.3rem_0_0.3rem_0] inline-block break-words font-['Nunito'] font-bold text-[1rem] text-[var(--secandery-two,#CACED8)]">
            {{-- Terakhir Update 14 April  2024 --}}
            </div>
          </div>
          <div class="flex flex-row w-full box-sizing-border justify-start">
            <div class="m-[0_3.8rem_2.6rem_0] flex flex-col w-[50%] box-sizing-border">
              <div class="m-[0_0_1.5rem_0] flex flex-col w-full box-sizing-border">
                <div class="flex flex-col w-full box-sizing-border">
                  <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                    <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                        Kata Sandi Lama
                    </span>
                  </div>
                  <input type="password" name="old_password" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" placeholder="********">
                  </input>
                </div>
              </div>
            </div>
            <div class="flex flex-col w-[50%] box-sizing-border">
              <div class="flex flex-col w-full box-sizing-border">
                <div class="m-[0_0_1.5rem_0] flex flex-col w-full box-sizing-border">
                  <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                    <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                    Kata Sandi Baru
                    </span>
                  </div>
                  <input type="password" name="new_password" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" placeholder="********">
                  </input>
                </div>
                <div class="m-[0_0_1.5rem_0] flex flex-col w-full box-sizing-border">
                    <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                      <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                      Konfirmasi Kata Sandi Baru
                      </span>
                    </div>
                    <input type="password" name="new_password_confirmation" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" placeholder="********">
                    </input>
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

  