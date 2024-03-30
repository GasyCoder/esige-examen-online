<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full p-4 font-medium text-white transition border rounded-lg cursor-pointer border-primary bg-primary
hover:bg-opacity-90']) }}>
    {{ $slot }}
</button>
