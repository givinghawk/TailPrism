<nav class="bg-gray-900 p-2 flex items-center justify-between flex-wrap bg-gray-700">
  <div class="container mx-auto">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      <a href="{{ route('home') }}" class="font-semibold text-xl tracking-tight">
        <img src="{{ site_logo() }}" alt="{{ site_name() }}" class="w-10 h-10"> {{ site_name() }}
      </a>
    </div>
    <div class="block lg:hidden">
      <button class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-white hover:border-white">
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <title>Menu</title>
          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
        </svg>
      </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
      <div class="text-sm lg:flex-grow">
        <div class="lg:flex items-center justify-center">
          <ul class="list-reset lg:flex justify-center">
            @foreach($navbar as $element)
              @if($loop->index < ($loop->count / 2))
                @if(!$element->isDropdown())
                  <li class="mr-3 lg:mr-5">
                    <a href="{{ $element->getLink() }}" class="inline-block py-2 px-3 text-gray-300 hover:text-white {{ $element->isCurrent() ? 'text-white' : '' }}">{{ $element->name }}</a>
                  </li>
                @else
                  <li class="relative mr-3 lg:mr-5">
                    <a href="#" class="inline-block py-2 px-3 text-gray-300 hover:text-white {{ $element->isCurrent() ? 'text-white' : '' }}">{{ $element->name }}</a>
                    <ul class="absolute w-48 mt-2 bg-gray-900 py-2 rounded-lg shadow-lg hidden">
                      @foreach($element->elements as $childElement)
                        <li class="py-1">
                          <a href="{{ $childElement->getLink() }}" class="block px-3 py-1 {{ $childElement->isCurrent() ? 'text-primary' : 'text-gray-300' }} hover:text-white">{{ $childElement->name }}</a>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                @endif
              @endif
            @endforeach
          </ul>
        </div>
    </div>
</nav>

<div class="bg-primary py-2 sub-navbar">
  <div class="container">
    <div class="flex items-center justify-center lg:justify-between row">
      <div class="lg:w-6/12 d-flex align-items-center">
        <div class="d-flex align-items-center me-lg-5">
          <i class="bi bi-graph-up fs-1 me-2 flex-shrink-0"></i>
          <div class="flex-grow-1">
            @if($server && $server->isOnline())
              @if(!$server->joinUrl())
                <div class="mb-0">
                  <span title="{{ trans('messages.actions.copy') }}" class="copy-address bg-dark h6"
                    data-copied="{{ trans('messages.clipboard.copied') }}" data-copy-error="{{ trans('messages.clipboard.error') }}">
                    {{ $server->fullAddress() }}
                  </span>
                </div>
              @else
                <h5 class="mb-0">{{ $server->name }}</h5>
              @endif
              {{ trans_choice('theme::prism.header.online', $server->getOnlinePlayers()) }}
            @else
              <h5 class="mb-0">{{ trans('theme::prism.header.offline') }}</h5>
            @endif
          </div>
          @if($server && $server->joinUrl())
            <a href="{{ $server->joinUrl() }}" class="btn btn-outline-light btn-rounded ms-3">
              {{ trans('messages.server.join') }}
            </a>
          @endif
        </div>
      </div>
      <div class="lg:w-6/12 text-center prism-nav-right">
        @auth
          @include('elements.notifications')
          <div class="dropdown">
            <a id="userDropdown" class="btn btn-outline-light btn-rounded dropdown-toggle my-1" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="{{ route('profile.index') }}">
                {{ trans('messages.nav.profile') }}
              </a>
              @foreach(plugins()->getUserNavItems() ?? [] as $navId => $navItem)
                <a class="dropdown-item" href="{{ route($navItem['route']) }}">
                  {{ trans($navItem['name']) }}
                </a>
              @endforeach
              @if(Auth::user()->hasAdminAccess())
                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                  {{ trans('messages.nav.admin') }}
                </a>
              @endif
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ trans('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                <div class="my-1 ml-lg-5 flex">
  @if(Route::has('register'))
    <a class="btn btn-outline-light btn-rounded px-4 py-2 mr-2" href="{{ route('register') }}">
      {{ trans('auth.register') }}
    </a>
  @endif
  <a class="btn btn-outline-light btn-rounded px-4 py-2" href="{{ route('login') }}">
    {{ trans('auth.login') }}
  </a>
</div>

                @endauth
            </div>
        </div>
    </div>
</div>
