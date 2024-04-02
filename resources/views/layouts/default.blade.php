@php
    $controller = App\Http\Controllers\Controller::controller();
    $page = $action = App\Http\Controllers\Controller::action();
    $action = $controller.'_'.$action;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

	<!-- PAGE TITLE HERE -->
	<title>{{ config('dz.name') }} | @yield('title', $page_title ?? '')</title>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="@yield('page_description', $page_description ?? '')"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Vora : Crypto Trading UI Admin  Bootstrap 5 Template" />
	<meta property="og:title" content="Vora : Crypto Trading UI Admin Bootstrap 5 & Laravel Template" />
	<meta property="og:description" content="{{ config('dz.name') }} | @yield('title', $page_title ?? '')" />
	<meta property="og:image" content="https://Vora.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('index_files/logo.png')}}">
    <link href="{{ asset('css/stroyka.css') }}" rel="stylesheet">

    
	@if(!empty(config('dz.public.pagelevel.css.'.$action))) 
        @foreach(config('dz.public.pagelevel.css.'.$action) as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif

    {{-- Global Theme Styles (used by all pages) --}}
    @if(!empty(config('dz.public.global.css'))) 
        @foreach(config('dz.public.global.css') as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
	
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ url('index')}}" class="brand-logo">
				<div class="brand-title">
					<img class="logo-12" src="index_files/logo.png"/>
				</div>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
		@include('elements.header')
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        @include('elements.sidebar')
            Sidebar end
        ***********************************-->
		
        @php
            $body_class = ''; 
            if($page == 'ui_button'){ $body_class = 'btn-page';} 
            if($page == 'ui_badge'){ $body_class = 'badge-demo';} 
        @endphp

		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body {{$body_class}}">
            <!-- row -->
			@yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        @stack('models')

        <!--**********************************
            Footer start
        ***********************************-->
        @include('elements.footer')
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    
	<!-- Required vendors -->
	@if(!empty(config('dz.public.global.js.top')))
        @foreach(config('dz.public.global.js.top') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.js.'.$action)))
        @foreach(config('dz.public.pagelevel.js.'.$action) as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.global.js.bottom')))
        @foreach(config('dz.public.global.js.bottom') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif

    @stack('scripts')
	
</body>
</html>