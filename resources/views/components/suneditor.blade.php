<div>
    @php
        $name = $attributes->wire('model')->value();
    @endphp
    <label for="{{ $name }}">
        {{ $slot }}
    </label>
    <textarea x-data="editor($el, @entangle($attributes->wire('model')))" name="{{ $name }}" x-cloak></textarea>
</div>
