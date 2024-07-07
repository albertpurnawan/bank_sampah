<x-profile-layout>
  <form action="{{ route('profile.edit-profile.update') }}" method="POST" class="w-full" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-col box-sizing-border w-full">
      <div class="m-[0_0_2.5rem_0] flex flex-col items-center w-full box-sizing-border">
        <div class="m-[0_0_2.5rem_0] flex flex-row justify-between w-full box-sizing-border">
          <span class="m-[0_1rem_0_0] w-[32.9rem] break-words font-['Nunito'] font-bold text-[1.5rem] text-[var(--secandery-two,#CACED8)]">
          Informasi Bank
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
                      Bank
                  </span>
                </div>
                <div class="relative w-full">
                  <div class="relative w-full overflow-hidden rounded-[0.5rem]">
                    <select name="bank" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" style="appearance: none;">
                      <option value="" {{ (!isset(Auth::user()->bank)) ? 'selected' : '' }}>Pilih Bank</option>
                      <option value="BCA" {{ (Auth::user()->bank == 'BCA') ? 'selected' : '' }}>BCA</option>
                      <option value="BRI" {{ (Auth::user()->bank == 'BRI') ? 'selected' : '' }}>BRI</option>
                      <option value="BNI" {{ (Auth::user()->bank == 'BNI') ? 'selected' : '' }}>BNI</option>
                      <option value="Mandiri" {{ (Auth::user()->bank == 'Mandiri') ? 'selected' : '' }}>Mandiri</option>
                    </select>
                    <img class="w-[0.9rem] h-[0.4rem] absolute bottom-5 right-5" src="../assets/vectors/vector_3_x2.svg" />
                    <span class="absolute top-0 right-0 bottom-0 left-0 w-full h-full pointer-events-none" aria-hidden="true"></span>
                  </div>
                </div>                
              </div>
            </div>
          </div>
          <div class="flex flex-col w-[50%] box-sizing-border">
            <div class="flex flex-col w-full box-sizing-border">
              <div class="m-[0_0_1.5rem_0] flex flex-col w-full box-sizing-border">
                <div class="m-[0_0_0.3rem_0] flex self-start box-sizing-border">
                  <span class="break-words font-['Nunito'] font-bold text-[1rem] leading-[1.225] text-[var(--primary-one,#083A50)]">
                  Nomor Rekening
                  </span>
                </div>
                <input type="text" name="nomor_rekening" class="rounded-[0.5rem] border-[0.1rem_solid_var(--secandery-two,#CACED8)] bg-[var(--primary-tow,#FFFFFF)] p-[0.7rem_0.7rem_0.7rem_0.7rem] w-full box-sizing-border" placeholder="000000000" value="{{Auth::user()->nomor_rekening}}">
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

