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
                                                    style="cursor: default; opacity: 1;"
                                                    data-aos-duration="1000" data-aos="fade-up"
                                            >
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
                                                        data-aos-duration="1000" data-aos="fade-up"
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
                                                    style="cursor: default;"
                                                    data-aos-duration="1000"
                                                    data-aos="fade-up"
                                            >
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
                                                        data-aos-duration="1000" data-aos="fade-up"
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
            // Polyfill for ResizeObserver (for older browsers including Firefox)
            if (!window.ResizeObserver) {
                window.ResizeObserver = class {
                    constructor(callback) {
                        this.callback = callback;
                        this.observed = new Set();
                        this.rafId = null;
                        this.lastSizes = new Map();
                    }
                    
                    observe(element) {
                        this.observed.add(element);
                        this.lastSizes.set(element, { width: element.offsetWidth, height: element.offsetHeight });
                        this.startObserving();
                    }
                    
                    unobserve(element) {
                        this.observed.delete(element);
                        this.lastSizes.delete(element);
                        if (this.observed.size === 0) {
                            this.stopObserving();
                        }
                    }
                    
                    disconnect() {
                        this.observed.clear();
                        this.lastSizes.clear();
                        this.stopObserving();
                    }
                    
                    startObserving() {
                        if (this.rafId) return;
                        
                        const check = () => {
                            const entries = [];
                            this.observed.forEach(element => {
                                const currentSize = { width: element.offsetWidth, height: element.offsetHeight };
                                const lastSize = this.lastSizes.get(element);
                                
                                if (currentSize.width !== lastSize.width || currentSize.height !== lastSize.height) {
                                    this.lastSizes.set(element, currentSize);
                                    entries.push({ target: element });
                                }
                            });
                            
                            if (entries.length > 0) {
                                this.callback(entries);
                            }
                            
                            this.rafId = requestAnimationFrame(check);
                        };
                        
                        this.rafId = requestAnimationFrame(check);
                    }
                    
                    stopObserving() {
                        if (this.rafId) {
                            cancelAnimationFrame(this.rafId);
                            this.rafId = null;
                        }
                    }
                };
            }

            // Polyfill for Element.closest() (for older browsers including Firefox)
            if (!Element.prototype.closest) {
                Element.prototype.closest = function(s) {
                    var el = this;
                    do {
                        if (el.matches(s)) return el;
                        el = el.parentElement || el.parentNode;
                    } while (el !== null && el.nodeType === 1);
                    return null;
                };
            }

            // Polyfill for Element.matches() (needed for closest polyfill)
            if (!Element.prototype.matches) {
                Element.prototype.matches = Element.prototype.matchesSelector ||
                    Element.prototype.mozMatchesSelector ||
                    Element.prototype.msMatchesSelector ||
                    Element.prototype.oMatchesSelector ||
                    Element.prototype.webkitMatchesSelector ||
                    function(s) {
                        var matches = (this.document || this.ownerDocument).querySelectorAll(s),
                            i = matches.length;
                        while (--i >= 0 && matches.item(i) !== this) {}
                        return i > -1;
                    };
            }

            // Polyfill for IntersectionObserver (for older browsers including Firefox)
            if (!window.IntersectionObserver) {
                window.IntersectionObserver = class {
                    constructor(callback, options = {}) {
                        this.callback = callback;
                        this.options = options;
                        this.observed = new Set();
                        this.rafId = null;
                    }
                    
                    observe(element) {
                        this.observed.add(element);
                        this.startObserving();
                    }
                    
                    unobserve(element) {
                        this.observed.delete(element);
                        if (this.observed.size === 0) {
                            this.stopObserving();
                        }
                    }
                    
                    disconnect() {
                        this.observed.clear();
                        this.stopObserving();
                    }
                    
                    startObserving() {
                        if (this.rafId) return;
                        
                        const check = () => {
                            const entries = [];
                            this.observed.forEach(element => {
                                const rect = element.getBoundingClientRect();
                                const isIntersecting = rect.top < window.innerHeight && rect.bottom > 0;
                                entries.push({ target: element, isIntersecting });
                            });
                            
                            if (entries.length > 0) {
                                this.callback(entries);
                            }
                            
                            this.rafId = requestAnimationFrame(check);
                        };
                        
                        this.rafId = requestAnimationFrame(check);
                    }
                    
                    stopObserving() {
                        if (this.rafId) {
                            cancelAnimationFrame(this.rafId);
                            this.rafId = null;
                        }
                    }
                };
            }

            function onTransitionEndOnce(el, prop, cb) {
                let completed = false;
                
                function handler(e){ 
                    if (e.propertyName === prop && !completed){ 
                        completed = true;
                        el.removeEventListener('transitionend', handler);
                        el.removeEventListener('webkitTransitionEnd', handler);
                        el.removeEventListener('mozTransitionEnd', handler);
                        clearTimeout(timeoutId);
                        cb(); 
                    } 
                }
                
                // Failsafe timeout in case transition event doesn't fire
                const timeoutId = setTimeout(() => {
                    if (!completed) {
                        completed = true;
                        el.removeEventListener('transitionend', handler);
                        el.removeEventListener('webkitTransitionEnd', handler);
                        el.removeEventListener('mozTransitionEnd', handler);
                        cb();
                    }
                }, 500); // 500ms timeout
                
                el.addEventListener('transitionend', handler);
                el.addEventListener('webkitTransitionEnd', handler); // Safari/Chrome
                el.addEventListener('mozTransitionEnd', handler); // Firefox
            }

            function openPanel(panel) {
                // Mark as animating to prevent conflicts
                panel.dataset.animating = 'true';
                
                panel.hidden = false;                 // ensure it's measurable
                panel.classList.add('is-open');       // fades in
                // set starting height (0 -> current scroll height)
                panel.style.height = '0px';
                
                // next frame, set target height with double RAF for better compatibility
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        const h = panel.scrollHeight;
                        panel.style.height = h + 'px';
                        onTransitionEndOnce(panel, 'height', () => {
                            panel.style.height = 'auto';      // let it grow naturally after opening
                            panel.dataset.animating = 'false'; // Animation complete
                        });
                    });
                });
            }

            function closePanel(panel) {
                // Mark as animating to prevent conflicts
                panel.dataset.animating = 'true';
                
                // Ensure we have a proper current height
                if (panel.style.height === 'auto' || !panel.style.height) {
                    panel.style.height = panel.scrollHeight + 'px';
                }
                
                // lock current height before collapsing
                const h = panel.scrollHeight;
                panel.style.height = h + 'px';
                
                // force a frame so the height is taken as the start value
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => { // Double RAF for better compatibility
                        panel.classList.remove('is-open');  // fade out
                        panel.style.height = '0px';         // animate to 0
                    });
                });
                
                onTransitionEndOnce(panel, 'height', () => {
                    panel.hidden = true;                // a11y after it's fully closed
                    panel.dataset.animating = 'false';  // Animation complete
                    panel.style.height = '';            // Clear inline height
                });
            }

            // INIT: panels without a header should be visible initially (no hidden attr).
            document.querySelectorAll('.submenu-panel').forEach(panel => {
                // Initialize animation state
                panel.dataset.animating = 'false';
                
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
            // Use both click and keydown for better accessibility and Firefox compatibility
            function handleToggle(e) {
                // Handle click or Enter/Space key
                if (e.type === 'keydown' && e.keyCode !== 13 && e.keyCode !== 32) return;
                
                const btn = e.target.closest('.sub-menu, .submenu-toggle');
                if (!btn || btn.disabled) return;

                // Stop event propagation to prevent conflicts
                e.stopPropagation();
                
                // Prevent default for keyboard events
                if (e.type === 'keydown') {
                    e.preventDefault();
                }

                const targetSel = btn.getAttribute('data-target');
                if (!targetSel) return;

                const panel = document.querySelector(targetSel);
                if (!panel) return;

                // Prevent multiple rapid clicks during animation
                if (panel.dataset.animating === 'true') return;

                // More reliable state detection
                const isOpen = !panel.hidden && panel.classList.contains('is-open');
                
                if (isOpen) {
                    btn.setAttribute('aria-expanded', 'false');
                    closePanel(panel);
                } else {
                    btn.setAttribute('aria-expanded', 'true');
                    openPanel(panel);
                }
            }

            // Debouncing to prevent rapid clicking
            let lastClickTime = 0;
            const DEBOUNCE_DELAY = 100; // 100ms debounce
            
            // Use event delegation for better performance and reliability
            document.addEventListener('click', function(e) {
                const now = Date.now();
                if (now - lastClickTime < DEBOUNCE_DELAY) return;
                lastClickTime = now;
                
                const btn = e.target.closest('.sub-menu, .submenu-toggle');
                if (btn && !btn.disabled && btn.getAttribute('data-target')) {
                    handleToggle(e);
                }
            });
            
            document.addEventListener('keydown', function(e) {
                const btn = e.target.closest('.sub-menu, .submenu-toggle');
                if (btn && !btn.disabled && btn.getAttribute('data-target')) {
                    handleToggle(e);
                }
            });

            // Firefox compatibility: Check if CSS triangles are working, if not use Unicode fallback
            function checkArrowSupport() {
                const testEl = document.createElement('div');
                testEl.style.position = 'absolute';
                testEl.style.left = '-9999px';
                testEl.style.width = '0';
                testEl.style.height = '0';
                testEl.style.borderLeft = '5px solid transparent';
                testEl.style.borderRight = '5px solid transparent';
                testEl.style.borderTop = '5px solid black';
                document.body.appendChild(testEl);
                
                const computed = window.getComputedStyle(testEl);
                const hasTriangleSupport = computed.borderLeftWidth === '5px' && 
                                         computed.borderRightWidth === '5px' && 
                                         computed.borderTopWidth === '5px';
                
                document.body.removeChild(testEl);
                
                if (!hasTriangleSupport) {
                    // Use Unicode fallback arrows
                    const style = document.createElement('style');
                    style.textContent = `
                        .sub-menu:not([disabled])::after { display: none !important; }
                        .sub-menu:not([disabled])::before { display: block !important; }
                    `;
                    document.head.appendChild(style);
                }
            }
            
            // Run arrow support check after DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', checkArrowSupport);
            } else {
                checkArrowSupport();
            }

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

    <script>
        (function () {
            // Observe when a section enters the viewport
            const io = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const sec = entry.target;
                    if (!entry.isIntersecting) return;
                    sec.__inView = true;
                    maybeReady(sec);
                });
            }, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });

            // Called when either the image loads or the section comes into view
            function maybeReady(section) {
                if (section.__imageLoaded && section.__inView) {
                    if (!section.classList.contains('is-ready')) {
                        section.classList.add('is-ready');
                        // make AOS recalc so the newly visible buttons fade like items/images
                        if (window.AOS && typeof AOS.refresh === 'function') {
                            (AOS.refreshHard && AOS.refreshHard()) || AOS.refresh();
                        }
                    }
                }
            }

            // Setup for each menu section
            document.querySelectorAll('.menu-main').forEach(section => {
                section.__imageLoaded = false;
                section.__inView = false;

                // start observing viewport visibility
                io.observe(section);

                const img = section.querySelector('.image img');
                if (!img) {
                    section.__imageLoaded = true;
                    maybeReady(section);
                    return;
                }

                // mark image loaded (from cache or after load)
                if (img.complete && img.naturalWidth > 0) {
                    section.__imageLoaded = true;
                    maybeReady(section);
                } else {
                    img.addEventListener('load', () => { section.__imageLoaded = true; maybeReady(section); }, { once: true });
                    img.addEventListener('error', () => { section.__imageLoaded = true; maybeReady(section); }, { once: true });
                }
            });
        })();
    </script>
@endpush
