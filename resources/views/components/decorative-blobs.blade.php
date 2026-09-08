@props(['class' => ''])

<div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden {{ $class }}">
    <div class="absolute -top-10 -right-10 w-64 h-64 rounded-full bg-sage/25 blur-2xl"></div>
    <div class="absolute bottom-0 left-1/3 w-56 h-56 rounded-full bg-coral/15 blur-2xl"></div>
</div>