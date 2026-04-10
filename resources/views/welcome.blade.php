@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 mt-8" 
        x-data="{ 
            activeSlide: 0, 
            slides: {{ $heroes->count() }},
            touchStartX: 0,
            touchEndX: 0,
            isDragging: false,
            startDragX: 0,
            dragOffset: 0,
            
            next() {
                this.activeSlide = (this.activeSlide + 1) % this.slides;
            },
            prev() {
                this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides;
            },
            handleTouchStart(e) {
                this.touchStartX = e.changedTouches[0].screenX;
            },
            handleTouchEnd(e) {
                this.touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe();
            },
            handleSwipe() {
                if (this.touchStartX - this.touchEndX > 50) this.next();
                if (this.touchEndX - this.touchStartX > 50) this.prev();
            },
            handleMouseDown(e) {
                this.isDragging = true;
                this.startDragX = e.clientX;
                this.dragOffset = 0;
            },
            handleMouseMove(e) {
                if (!this.isDragging) return;
                this.dragOffset = e.clientX - this.startDragX;
            },
            handleMouseUp() {
                if (!this.isDragging) return;
                if (this.dragOffset < -50) this.next();
                else if (this.dragOffset > 50) this.prev();
                this.isDragging = false;
                this.dragOffset = 0;
            }
        }" 
        x-init="setInterval(() => { if(!isDragging) next() }, 5000)"
        @touchstart="handleTouchStart($event)"
        @touchend="handleTouchEnd($event)"
        @mousedown="handleMouseDown($event)"
        @mousemove="handleMouseMove($event)"
        @mouseup="handleMouseUp()"
        @mouseleave="handleMouseUp()"
    >
        <div class="relative w-full aspect-[21/9] rounded-[40px] overflow-hidden group bg-gray-100 select-none cursor-grab active:cursor-grabbing">
            @foreach($heroes as $index => $hero)
            <div 
                x-show="activeSlide === {{ $index }}" 
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
                style="display: none;"
            >
                @if(str_contains($hero->image, 'http'))
                    <img src="{{ $hero->image }}" alt="{{ $hero->title }}" class="w-full h-full object-cover pointer-events-none">
                @else
                    <img src="{{ asset($hero->image) }}" alt="{{ $hero->title }}" class="w-full h-full object-cover pointer-events-none">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent pointer-events-none"></div>
                
                <div class="absolute top-8 right-8">
                    <span class="px-5 py-2 bg-black/30 backdrop-blur-md text-white text-[10px] font-bold uppercase rounded-full border border-white/20">
                        latest news
                    </span>
                </div>

                <div class="absolute bottom-16 left-12 right-12">
                    <div class="max-w-4xl">
                        <h1 class="text-5xl md:text-6xl font-bold text-white leading-[1.1] mb-6 tracking-tight pointer-events-none">
                            {{ $hero->title }}
                        </h1>
                        <p class="text-white/80 text-lg mb-4 line-clamp-2 max-w-2xl pointer-events-none">
                            <span class="font-bold">LOCATION — </span> {{ Str::limit(strip_tags($hero->content), 120) }}
                        </p>
                        <a href="{{ route('article.show', $hero->slug) }}" class="text-white text-lg font-bold underline underline-offset-8 hover:text-brand transition pointer-events-auto">
                            read more
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Indicators (Instagram Style Dots) -->
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
                @foreach($heroes as $index => $hero)
                <button 
                    @click.stop="activeSlide = {{ $index }}" 
                    class="h-2 rounded-full transition-all duration-300 pointer-events-auto"
                    :class="activeSlide === {{ $index }} ? 'w-6 bg-brand' : 'w-2 bg-white/50'"
                ></button>
                @endforeach
            </div>
        </div>
    </section>

   <!-- Breaking News -->
<section class="max-w-7xl mx-auto px-4 mt-20">
    <div class="flex justify-between items-end mb-10">
        <h2 class="text-5xl font-bold">Breaking News</h2>
        <a href="#" class="text-2xl font-bold flex items-center hover:text-gray-600 transition">
            See all <span class="ml-2">&rarr;</span>
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        @foreach($breakingNews as $news)
        {{-- ✅ Ganti <div> jadi <a> dengan route article.show --}}
        <a href="{{ route('article.show', $news->slug) }}" class="group cursor-pointer block">
            <div class="aspect-[4/3] rounded-[32px] overflow-hidden mb-6">
                @if(str_contains($news->image, 'http'))
                    <img src="{{ $news->image }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="{{ $news->title }}">
                @else
                    <img src="{{ asset($news->image) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="{{ $news->title }}">
                @endif
            </div>
            <!-- Metadata -->
            <div class="flex items-center space-x-6 text-[11px] font-bold text-gray-900 uppercase mb-4">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    JAKARTA, INDONESIA
                </span>
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    {{ $news->created_at->format('d F Y') }}
                </span>
            </div>
            <h3 class="text-xl font-bold leading-tight mb-3 group-hover:text-gray-700 transition">
                {{ $news->title }}
            </h3>
            <p class="text-gray-600 text-[13px] leading-relaxed line-clamp-4">
                {{ Str::limit(strip_tags($news->content), 180) }}
            </p>
        </a>
        @endforeach
    </div>
</section>
    <!-- Latest News -->
    <section class="max-w-7xl mx-auto px-4 mt-28 pb-32">
        <h2 class="text-5xl font-bold mb-12">Latest News</h2>
        
        <div class="flex flex-col md:flex-row gap-16">
            <!-- Left Column: Grid 1x2 + 1 Wide -->
            <div class="w-full md:w-1/2">
                <div class="grid grid-cols-2 gap-6">
                    @php 
                        $gridItems = $latestNewsGrid->take(3); 
                    @endphp
                    @foreach($gridItems as $index => $news)
                        @if($index < 2)
                            <div class="col-span-1 aspect-square rounded-[32px] overflow-hidden group relative">
                                @if(str_contains($news->image, 'http'))
                                    <img src="{{ $news->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $news->title }}">
                                @else
                                    <img src="{{ asset($news->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $news->title }}">
                                @endif
                                <a href="{{ route('article.show', $news->slug) }}" class="absolute inset-0"></a>
                            </div>
                        @else
                            <div class="col-span-2 aspect-video rounded-[32px] overflow-hidden group relative mt-4">
                                @if(str_contains($news->image, 'http'))
                                    <img src="{{ $news->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $news->title }}">
                                @else
                                    <img src="{{ asset($news->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $news->title }}">
                                @endif
                                <a href="{{ route('article.show', $news->slug) }}" class="absolute inset-0"></a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Right Column: List -->
            <div class="w-full md:w-1/2">
                <div class="space-y-10">
                    <!-- Custom horizontal line separator from screenshot -->
                    <div class="w-1/2 h-[2px] bg-gray-400 mb-10"></div>
                    
                    @foreach($latestNewsList as $news)
                    <div class="flex items-center space-x-6 group cursor-pointer">
                        <div class="flex-shrink-0 w-32 h-20 rounded-[20px] overflow-hidden shadow-sm">
                            @if(str_contains($news->image, 'http'))
                                <img src="{{ $news->image }}" class="w-full h-full object-cover" alt="{{ $news->title }}">
                            @else
                                <img src="{{ asset($news->image) }}" class="w-full h-full object-cover" alt="{{ $news->title }}">
                            @endif
                        </div>
                        <div class="flex-grow">
                            <h5 class="text-lg font-bold leading-snug group-hover:text-gray-600 transition">
                                <a href="{{ route('article.show', $news->slug) }}">{{ $news->title }}</a>
                            </h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
