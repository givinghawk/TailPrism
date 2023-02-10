<div class="container mx-auto px-6">
    <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 px-6">
            <h4 class="text-lg font-medium">{{ trans('theme::prism.footer.about') }}</h4>

            <p class="text-base">{!! theme_config('footer_description') !!}</p>
        </div>
        <div class="w-full md:w-1/3 px-6">
            <h4 class="text-lg font-medium">{{ trans('theme::prism.footer.links') }}</h4>

            <ul class="list-none">
                @foreach(theme_config('footer_links') ?? [] as $link)
                    <li class="my-3">
                        <a href="{{ $link['value'] }}" class="text-blue-500 hover:text-blue-600">
                            <span class="inline-block mr-2 bi bi-chevron-right"></span> 
                            {{ $link['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-full md:w-1/3 px-6">
            <h4 class="text-lg font-medium">{{ trans('theme::prism.footer.social') }}</h4>

            <ul class="list-none">
                @foreach(social_links() as $link)
                    <li class="inline-block mr-3">
                        <a href="{{ $link->value }}" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-gray-700">
                            <span class="inline-block mr-2 {{ $link->icon }} fs-2"></span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <hr class="my-6">

    <div class="flex flex-col md:flex-row mt-6">
        <div class="w-full md:w-1/2 px-6">
            {{ setting('copyright') }}
        </div>
        <div class="w-full md:w-1/2 text-right px-6">
            @lang('messages.copyright')
        </div>
    </div>
</div>
