<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muvi Flex | Watch Movie, Watch World</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="{{ asset('muvi-flex/assets/script/tailwind-config.js') }}"></script>
    <style type="text/tailwindcss">
        @layer components{
            .nav-link-item {
                @apply py-3 font-normal text-stream-gray transition-all cursor-pointer lg:py-0 hover:text-white;
            }
        }

        .frame-video{
            @apply rounded-[28px];
            filter: drop-shadow(0px 32px 52px rgba(140, 135, 162, 0.18))
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.10.2/video-js.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('muvi-flex/assets/css/videojs.css') }}">

</head>

<body>

    <header class="text-white bg-stream-dark font-poppins select-none h-full relative">
        <img src="{{ asset('muvi-flex/assets/images/green_radial.svg') }}" class="absolute" alt="muvi-flex" />
        <img src="{{ asset('muvi-flex/assets/images/red_radial.svg') }}" class="absolute right-0" alt="muvi-flex" />

        <nav class="container py-5 relative">
            <div class="flex flex-col w-full lg:flex-row lg:items-center">
                <!-- Logo & Toggler Button here -->
                <div class="flex items-center justify-between block lg:hidden">
                    <!-- LOGO -->
                    <a href="/">
                        <img src="{{ asset('muvi-flex/assets/images/stream.svg') }}" alt="muvi-flex" />
                    </a>
                    <!-- RESPONSIVE NAVBAR BUTTON TOGGLER -->
                    <div>
                        <button class="p-1 outline-none mobile-menu-button" data-target="#navigation">
                            <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="hidden w-full lg:block" id="navigation">
                    <div
                        class="flex flex-col items-baseline lg:justify-between mt-6 lg:flex-row lg:items-center lg:mt-0">
                        <div class="flex flex-col w-full font-normal lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                            <a href="#!" class="nav-link-item">Genre</a>
                            <a href="#!" class="nav-link-item">Featured</a>
                            <a href="pricing.html" class="nav-link-item">Pricing</a>
                        </div>
                        <a href="/" class="hidden lg:block -ml-36">
                            <img src="{{ asset('muvi-flex/assets/images/stream.svg') }}" alt="muvi-flex" />
                        </a>
                        <div class="flex flex-col w-full font-normal lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                            <a href="#"
                                class="px-8 py-3 mt-3 text-center outline outline-2 outline-stream-gray rounded-3xl lg:mt-0">
                                <span class="text-base text-normal text-stream-gray">Sign In</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <section class="py-[100px] flex flex-col items-center gap-5 px-3 relative">
            <p class="text-sky-300 text-base font-semibold">
                START YOUR DAY
            </p>
            <div class="font-bold text-white text-4xl lg:text-[45px] text-center capitalize leading-snug">
                Get more inspired <br class="hidden md:block" /> watching great movies
            </div>
            <p class="text-base text-stream-gray text-center leading-7">
                Everything you need to entertain yourself and <br class="hidden lg:block" />
                your family from anywhere you are
            </p>
            <a href="#" class="mt-5 rounded-full bg-indigo-600 text-center py-3 px-11">
                <span class="text-white font-semibold text-base">Get Started</span>
            </a>
        </section>

        <section class="px-4 relative max-w-[950px] overflow-hidden mx-auto" id="stream">
            <!-- modal button & modal background -->
            <div class="w-full relative flex">
                <img src="{{ asset('muvi-flex/assets/images/temp_img.png') }}" class="object-cover rounded-[50px]" alt="stream" />
                <button class="absolute z-10 top-[50%] left-[50%] -mt-[25px] -ml-[25px] md:-mt-[44px] md:-ml-[44px]
                    cursor-pointer" id="stream-preview">
                    <img src="{{ asset('muvi-flex/assets/images/ic_play.svg') }}" class="w-8/12 md:w-full" alt="muvi-flex" />
                </button>
            </div>
        </section>


        <!-- Modal video -->
        <section class="relative">
            <div class="max-w-screen hidden h-full mx-auto bg-black bg-opacity-70 fixed z-30 inset-0" id="openStream">
            </div>
            <video-js
                class="frame-video overflow-hidden hidden fixed h-[405px] max-h-max max-w-full w-[720px] top-[25%] -translate-y-[25%] left-1/2 -translate-x-1/2 z-50"
                id="stream-video">
                <source src="https://d33kv075lir7n3.cloudfront.net/Details+Screen+Part+Final.mp4" type="video/mp4" />
                <p class="vjs-no-js text-twmdark">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video-js>
        </section>

        <!-- Brand partner -->
        <section class="brands pb-[100px] pt-[50px] flex flex-wrap justify-center items-center gap-x-[70px] gap-y-10 px-2
            relative">
            <img src="{{ asset('muvi-flex/assets/images/logo-apple-tv.svg') }}" alt="muvi-flex" />
            <img src="{{ asset('muvi-flex/assets/images/logo-ipad-apple.svg') }}" alt="muvi-flex" />
            <img src="{{ asset('muvi-flex/assets/images/logo-android-wordmark.svg') }}" alt="muvi-flex" />
            <img src="{{ asset('muvi-flex/assets/images/logo-youtube-tv.svg') }}" alt="muvi-flex" />
        </section>
    </header>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/script/script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.10.2/video.min.js"></script>

    <script>
        // videojs data-setup
        videojs('stream-video', {
            controls: true,
            autoplay: false,
            preload: 'auto',
            poster: 'muvi-flex/assets/images/poster.png',
            disablePictureInPicture: true,
            noUITitleAttributes: true
        });

        // Open modal
        $("#stream-preview").click(function () {
            $("#openStream").removeClass('hidden')
            $("#stream-video").removeClass('hidden')
            $('body').addClass('overflow-y-hidden')
        })

        // Close modal
        $("#openStream").click(function () {
            $("#stream-video").addClass('hidden')
            $('body').removeClass('overflow-y-hidden')
            $("#openStream").addClass('hidden')
            $("#openStream").addClass('vjs-paused').removeClass('vjs-playing')
        })
    </script>
</body>

</html>