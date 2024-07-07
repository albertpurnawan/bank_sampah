@props([
    'name',
    'type',
    'id',
    'asset',
    'placeholder'
])
<div class="flex flex-col w-full">
  <div class="flex flex-row justify-start py-2 px-12 w-full">
    <div class="bg-[#FFFFFF] absolute flex flex-col text-center m-[0_0_0_15px] px-2 w-fit h-fit">
      <span class="break-words font-['Poppins'] font-bold text-[10px] text-[#009EE2]">
        {{ $name }}
        </span>
    </div>
    <img class="absolute m-[21px_16px_16px_16px] w-[24px] h-[24px]" src="{{ $asset }}" />
    <input type="{{ $type }}" class="m-[5px_0_0_0] p-[16px_16px_16px_56px] border border-[#009EE2] rounded-[5px] w-full" name="{{ $id }}" id="{{ $id }}" placeholder="{{ $placeholder }}">
    
  </div>
  <x-input-error :messages="$errors->get($id)" class="px-12" />
</div>
