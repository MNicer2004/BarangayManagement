@props(['title','value','desc','icon'=>'📊'])
<div {{ $attributes->merge(['class' => 'rounded-xl p-5 text-white shadow']) }}>
  <div class="flex items-center gap-3">
    <div class="text-3xl">{{ $icon }}</div>
    <div>
      <div class="text-sm uppercase opacity-90">{{ $title }}</div>
      <div class="text-3xl font-bold leading-tight">{{ $value }}</div>
      <div class="text-xs opacity-90 mt-1">{{ $desc }}</div>
    </div>
  </div>
</div>
