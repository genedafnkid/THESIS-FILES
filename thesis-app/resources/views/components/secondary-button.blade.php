<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition'
]) }}>
    {{ $slot }}
</button>
