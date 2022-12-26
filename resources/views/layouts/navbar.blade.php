<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm p-3 font-weight-bold">
  <div class="container">
    <a class="navbar-brand {{ $language == 'ar' ? 'ml-auto' : 'mr-auto' }}"  href="{{ url('/') }}">
      <img src="{{ asset('img/almatin_group.png') }}" width="30" height="30"
        class="d-inline-block align-top bg-white align-top rounded" alt="" style="scale: 1.5">
      &nbsp
      {{ __('translate.logo') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav {{ $language == 'ar' ? 'ml-auto' : 'mr-auto' }}">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('translate.login') }}</a>
          </li>
          {{-- @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif --}}
        @else
          <li class="nav-item dropdown {{ (request()->is('/*')) ? 'active' : '' }}">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('home') }}">
                {{ __('translate.home_page') }}
              </a>
              <a class="dropdown-item" href="{{ route('home') }}">
                {{ __('translate.change_password') }}
                </a>
              <a class="dropdown-item" href="{{ url('/') }}">
                {{ __('translate.download_android') }}  
              </a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();">
                {{ __('translate.logout') }}
              </a>
              
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
          <li class="nav-item {{ (request()->is('salary*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('salary') }}">{{ __('translate.salary') }}</a>
          </li>
          <li class="nav-item {{ (request()->is('evaluation*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('evaluation') }}">{{ __('translate.evaluation') }}</a>
          </li>
          <li class="nav-item {{ (request()->is('vacation*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('vacation') }}">{{ __('translate.vacation') }}</a>
          </li>
          
          <li class="nav-item dropdown {{ (request()->is('departmentEmployees*')) ? 'active' : '' }}">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ __('translate.department') }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('user.departmentEmployees') }}">
                {{ __('translate.employees') }} 
              </a>
              <a class="dropdown-item" href="{{ route('vacations') }}">
                {{ __('translate.vacation_requests') }}
              </a>
            </div>
          </li>


          {{-- <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('translate.management') }}</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('translate.statistics') }}</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('translate.uploads') }}</a>
          </li> --}}


          <li class="nav-item dropdown {{ (request()->is('management*')) ? 'active' : '' }}">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ __('translate.management') }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('user.management') }}">
                {{ __('translate.employee_management') }} 
              </a>
              <a class="dropdown-item" href="{{ route('home') }}">
                {{ __('translate.statistics') }}
              </a>
              <a class="dropdown-item" href="{{ route('home') }}">
                {{ __('translate.uploads') }}
              </a>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>