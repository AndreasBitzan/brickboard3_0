<div>
    <x-select
    label="{{ __('Suche ein Mitglied') }}"
    wire:model.defer="chosen_users"
    multiselect
    placeholder="{{ __('Username eingeben') }}"
    :async-data="route('user.search')"
    option-label="name"
    option-value="id"
/>
</div>
