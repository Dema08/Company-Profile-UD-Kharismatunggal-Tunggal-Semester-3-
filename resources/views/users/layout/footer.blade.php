<!-- footer start -->
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="col1">
                <div class="logo">
                    <img src="{{ asset('storage/' . $pengaturan->logo_toko) }}" alt="" />
                    <a href="#" class="brand">{{ $pengaturan->nama_toko }}</a>
                </div>
                <div class="footer-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.0760882725835!2d113.69574287054611!3d-8.195090264121388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd69690fdc1de45%3A0xebb0a35ae9475742!2sJl.%20Basuki%20Rahmat%20No.60%2C%20Gumuksari%2C%20Tegal%20Besar%2C%20Kec.%20Kaliwates%2C%20Kabupaten%20Jember%2C%20Jawa%20Timur%2068131!5e0!3m2!1sid!2sid!4v1722963604469!5m2!1sid!2sid"
                        width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="col2">
                <ul class="menu">
                    <li>
                        <h4>Halaman lain</h4>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('users.about') }}">Tentang kami</a>
                    </li>
                    <li>
                        <a href="{{ route('users.barang') }}">Produk</a>
                    </li>
                    <li>
                        <a href="{{ route('users.artikel') }}">Artikel</a>
                    </li>
                    <li>
                        <a href="{{ route('users.faq') }}">Faq</a>
                    </li>
                </ul>
            </div>


            <div class="col4">
                <h4>Alamat</h4>
                <ul class="p">
                    <li>JL. BASUKI RAHMAT NO. 60,</li>
                    <li>Kel. Tegalbesar, Kec, Kaliwates,</li>
                    <li>Kab. Jember, Prop. Jawa timur</li>

                </ul>
                <ul class="media-icon">
                    <li>
                        <a target="_blank" href="{{ $pengaturan->linkshopee_toko }}">
                            <i><img src="{{ asset('user_assets/img/logo/white/shopee.png') }}" alt=""></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://wa.me/{{ $pengaturan->no_hp_toko }}">
                            <i><img src="{{ asset('user_assets/img/logo/white/whatsapp.png') }}" alt=""></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="tel:+{{ $pengaturan->no_hp_toko  }}">
                            <i><img src="{{ asset('user_assets/img/logo/white/phone.png') }}" alt=""></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>{{ $pengaturan->nama_toko }} | © {{ \Carbon\Carbon::now()->year }}</p>

        </div>
    </div>
</footer>
<!-- footer end -->
