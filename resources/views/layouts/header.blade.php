<div class="relative bg-cover bg-center h-60 flex items-center justify-center"
    style="background-image: url('{{ asset('images/cake_cover.jpg') }}');">
    <div class="absolute inset-0 bg-base-300 opacity-60"></div>
    <div class="container mx-auto p-2 relative">
        <h1 class="text-9xl font-bold text-primary">
            <span class="relative flex items-center w-full">
                <span class="inline-block h-1 w-20 bg-secondary align-middle"></span>
                <span class="mx-2 lowercase">{{ $title }}</span>
                <span class="inline-block h-1 bg-secondary align-middle flex-grow"></span>
            </span>
        </h1>
    </div>
</div>
