@extends('web.layout.main')

@section('content')
    <div class="p-menu">
        <section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-main">
                            <h2 class="title">{{ trans('page.pages.menu.page_title') }}</h2>

                            <ul class="breacrumd">
                                <li><a href="/">{{ trans('home.header.home') }} </a></li>
                                <li>/</li>
                                <li>{{ trans('page.pages.menu.breadcrumb') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="s-menu zingzac">
            <div class="container container-max-width">
                <div class="row">
                    <div class="menu-content">

                        @foreach($menus as $menu)
                            <div class="menu-main {{ $loop->index % 2 === 0 ? 'right' : '' }}">

                                @if($loop->index % 2 === 0)
                                    {{-- IMAGE (left on odd, right on even via .right) --}}
                                    <div class="image" data-aos-duration="1000" data-aos="{{ $loop->index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                                        <img src="{{ $menu?->getFirstMediaUrl('image') }}" alt="">
                                    </div>

                                    {{-- FIRST BUCKETS (stay beside image) --}}
                                    <ul class="menu-list">
                                        <p class="sub-title" data-aos-duration="1000" data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-up' }}">
                                            {{ $menu?->description }}
                                        </p>
                                        <h4 data-aos-duration="1000" data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-up' }}">
                                            {{ $menu?->title }}
                                        </h4>

                                        @foreach($menu->firstBuckets as $bucket)
                                            @php
                                                $sid = 'sb-'.$menu->id.'-'.$bucket['submenu']->id; // unique id per submenu
                                            @endphp

                                            <button type="button"
                                                    class="submenu-toggle sub-menu"
                                                    disabled
                                                    style="cursor: default; opacity: 1;">
                                                {{ $bucket['submenu']->title }}
                                            </button>

                                            <div id="{{ $sid }}" class="submenu-panel">
                                                @foreach($bucket['items'] as $menuItem)
                                                    <li data-aos-duration="1000" data-aos="fade-up">
                                                        <h5 class="name">
                                                            <span class="txt full-title">{{ $menuItem->title }}</span>
                                                            <span class="txt title-with-price">
                                                                {{ $menuItem->title }} <br class="break-point">
                                                                ( <span class="p-price">{{ $menuItem->special_price }}</span> kr )
                                                            </span>
                                                            <span class="price">{{ $menuItem->special_price }} kr</span>
                                                        </h5>
                                                        <p>{{ $menuItem->description }}</p>
                                                    </li>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </ul>

                                    {{-- FULL-WIDTH (spans both columns under image+first list) --}}
                                    @if($menu->restBuckets->isNotEmpty())
                                        <ul class="menu-list full-width">
                                            @foreach($menu->restBuckets as $bucket)
                                                @php $sid = 'sb-'.$menu->id.'-'.$bucket['submenu']->id.'-rest'; @endphp
                                                @php $hasHeader = $bucket['show_header'] ?? true; @endphp

                                                @if($hasHeader)
                                                    <button
                                                        type="button"
                                                        class="submenu-toggle sub-menu"
                                                        data-target="#{{ $sid }}"
                                                        aria-controls="{{ $sid }}"
                                                        aria-expanded="false"
                                                        {{-- no data-initial="open" here so they start closed --}}
                                                    >
                                                        {{ $bucket['submenu']->title }}
                                                    </button>
                                                @endif

                                                <div id="{{ $sid }}" class="submenu-panel" @if($hasHeader) hidden @endif>
                                                    @foreach($bucket['items'] as $menuItem)
                                                        <li data-aos-duration="1000" data-aos="fade-up">
                                                            <h5 class="name">
                                                                <span class="txt full-title">{{ $menuItem->title }}</span>
                                                                <span class="txt title-with-price">
                                                                    {{ $menuItem->title }} <br class="break-point">
                                                                    ( <span class="p-price">{{ $menuItem->special_price }}</span> kr )
                                                                </span>
                                                                <span class="price">{{ $menuItem->special_price }} kr</span>
                                                            </h5>
                                                            <p>{{ $menuItem->description }}</p>
                                                        </li>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </ul>
                                    @endif

                                @else
                                    {{-- FIRST BUCKETS (stay beside image) --}}
                                    <ul class="menu-list">
                                        <p class="sub-title" data-aos-duration="1000" data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-up' }}">
                                            {{ $menu?->description }}
                                        </p>
                                        <h4 data-aos-duration="1000" data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-up' }}">
                                            {{ $menu?->title }}
                                        </h4>

                                        @foreach($menu->firstBuckets as $bucket)
                                            @php
                                                $sid = 'sb-'.$menu->id.'-'.$bucket['submenu']->id; // unique id per submenu
                                            @endphp

                                            <button type="button"
                                                    class="submenu-toggle sub-menu"
                                                    disabled
                                                    style="cursor: default; opacity: 1;">
                                                {{ $bucket['submenu']->title }}
                                            </button>

                                            <div id="{{ $sid }}" class="submenu-panel">
                                                @foreach($bucket['items'] as $menuItem)
                                                    <li data-aos-duration="1000" data-aos="fade-up">
                                                        <h5 class="name">
                                                            <span class="txt full-title">{{ $menuItem->title }}</span>
                                                            <span class="txt title-with-price">
                                                                {{ $menuItem->title }} <br class="break-point">
                                                                ( <span class="p-price">{{ $menuItem->special_price }}</span> kr )
                                                            </span>
                                                            <span class="price">{{ $menuItem->special_price }} kr</span>
                                                        </h5>
                                                        <p>{{ $menuItem->description }}</p>
                                                    </li>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </ul>

                                    {{-- IMAGE (left on odd, right on even via .right) --}}
                                    <div class="image" data-aos-duration="1000" data-aos="{{ $loop->index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                                        <img src="{{ $menu?->getFirstMediaUrl('image') }}" alt="">
                                    </div>

                                    {{-- FULL-WIDTH (spans both columns under image+first list) --}}
                                    @if($menu->restBuckets->isNotEmpty())
                                        <ul class="menu-list full-width">
                                            @foreach($menu->restBuckets as $bucket)
                                                @php $sid = 'sb-'.$menu->id.'-'.$bucket['submenu']->id.'-rest'; @endphp
                                                @php $hasHeader = $bucket['show_header'] ?? true; @endphp

                                                @if($hasHeader)
                                                    <button
                                                        type="button"
                                                        class="submenu-toggle sub-menu"
                                                        data-target="#{{ $sid }}"
                                                        aria-controls="{{ $sid }}"
                                                        aria-expanded="false"
                                                        {{-- no data-initial="open" here so they start closed --}}
                                                    >
                                                        {{ $bucket['submenu']->title }}
                                                    </button>
                                                @endif

                                                <div id="{{ $sid }}" class="submenu-panel" @if($hasHeader) hidden @endif>
                                                    @foreach($bucket['items'] as $menuItem)
                                                        <li data-aos-duration="1000" data-aos="fade-up">
                                                            <h5 class="name">
                                                                <span class="txt full-title">{{ $menuItem->title }}</span>
                                                                <span class="txt title-with-price">
                                                                    {{ $menuItem->title }} <br class="break-point">
                                                                    ( <span class="p-price">{{ $menuItem->special_price }}</span> kr )
                                                                </span>
                                                                <span class="price">{{ $menuItem->special_price }} kr</span>
                                                            </h5>
                                                            <p>{{ $menuItem->description }}</p>
                                                        </li>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="m-video">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="video-main">
                            <a href="/videos/video2.mp4" class="popup-youtube wrap-video">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script>
        (function () {
            function onTransitionEndOnce(el, prop, cb) {
                function handler(e){ if (e.propertyName === prop){ el.removeEventListener('transitionend', handler); cb(); } }
                el.addEventListener('transitionend', handler);
            }

            function openPanel(panel) {
                panel.hidden = false;                 // ensure it's measurable
                panel.classList.add('is-open');       // fades in
                // set starting height (0 -> current scroll height)
                panel.style.height = '0px';
                // next frame, set target height
                requestAnimationFrame(() => {
                    const h = panel.scrollHeight;
                    panel.style.height = h + 'px';
                    onTransitionEndOnce(panel, 'height', () => {
                        panel.style.height = 'auto';      // let it grow naturally after opening
                    });
                });
            }

            function closePanel(panel) {
                // lock current height (auto -> px) before collapsing
                const h = panel.scrollHeight;
                panel.style.height = h + 'px';
                // force a frame so the height is taken as the start value
                requestAnimationFrame(() => {
                    panel.classList.remove('is-open');  // fade out
                    panel.style.height = '0px';         // animate to 0
                });
                onTransitionEndOnce(panel, 'height', () => {
                    panel.hidden = true;                // a11y after it’s fully closed
                });
            }

            // INIT: panels without a header should be visible initially (no hidden attr).
            document.querySelectorAll('.submenu-panel').forEach(panel => {
                if (!panel.hidden) {
                    // visible on load -> set to open state without jump
                    panel.classList.add('is-open');
                    const h = panel.scrollHeight;
                    panel.style.height = h + 'px';
                    // after first frame, set to auto so layout is natural
                    requestAnimationFrame(() => { panel.style.height = 'auto'; });
                }
            });

            // Toggle (skip disabled / first button)
            document.addEventListener('click', e => {
                const btn = e.target.closest('.sub-menu, .submenu-toggle');
                if (!btn || btn.disabled) return;

                const targetSel = btn.getAttribute('data-target');
                if (!targetSel) return;

                const panel = document.querySelector(targetSel);
                if (!panel) return;

                const isOpen = panel.classList.contains('is-open') && panel.style.height === 'auto';
                if (isOpen) {
                    btn.setAttribute('aria-expanded', 'false');
                    closePanel(panel);
                } else {
                    btn.setAttribute('aria-expanded', 'true');
                    openPanel(panel);
                }
            });

            // Keep height correct if content inside changes (e.g., images load)
            const ro = new ResizeObserver(entries => {
                for (const {target: el} of entries) {
                    if (el.classList.contains('is-open') && el.style.height === 'auto') {
                        // briefly switch to px to store new natural height
                        const h = el.scrollHeight;
                        el.style.height = h + 'px';
                        requestAnimationFrame(() => { el.style.height = 'auto'; });
                    }
                }
            });
            document.querySelectorAll('.submenu-panel').forEach(p => ro.observe(p));
        })();
    </script>

@endpush
