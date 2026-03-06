@extends('users.layout.main')
@section('content')
    <div class="loader-overlay" id="loader-overlay">
        <div class="loader"></div>
    </div>

    <section class="hero-nonhome" id="home">
        <main class="content" data-aos="zoom-in" data-aos-offset="300">
            <h1>Frequently Asked Question</h1>
        </main>
    </section>
    <section class="faq" id="faq">
        <h1 data-aos="fade-up">Faq</h1>
        <h2 data-aos="fade-up"><span>Faq</span> Kami</h2>
        <p data-aos="fade-up">Berikut adalah beberapa Frequently Asked Question kami.</p>
        <form action="{{ route('users.searchpertanyaan') }}" method="GET">
            <div class="search-container">
                <div class="search-group">
                    <input type="text" name="search" placeholder="Cari Pertanyaan">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <div class="container">
            <div class="accordion">
                @foreach ($faqs as $faq)
                    <div class="accordion-item">
                        <button id="accordion-button-1" aria-expanded="false"><span
                                class="accordion-title">{{ $faq->pertanyaan }}</span><span class="icon"
                                aria-hidden="true"></span></button>
                        <div class="accordion-content">
                            <p>{{ $faq->jawaban }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        const items = document.querySelectorAll(".accordion button");

        function toggleAccordion() {
            const itemToggle = this.getAttribute('aria-expanded');

            for (i = 0; i < items.length; i++) {
                items[i].setAttribute('aria-expanded', 'false');
            }

            if (itemToggle == 'false') {
                this.setAttribute('aria-expanded', 'true');
            }
        }

        items.forEach(item => item.addEventListener('click', toggleAccordion));
    </script>
@endsection
