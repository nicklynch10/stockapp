@props(['on'])

<div x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2500);  })"
    x-show.transition.out.opacity.duration.2000ms="shown"
    x-transition:leave.opacity.duration.2000ms
    style="display: none;"
    {{ $attributes->merge(['class' => 'text-sm text-gray-600']) }}>
    {{ $slot->isEmpty() ? 'Saved.' : $slot }}
</div>
