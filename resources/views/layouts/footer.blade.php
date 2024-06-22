<!-- start footer Area -->
<footer class="footer-area section_gap" style="padding-top: 10px; padding-bottom: 50px;">
    <div class="container">
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
            <p class="footer-text m-0 {{ request()->is('admin*') ? 'admin' : '' }}" style="padding-top: 40px">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved | <a href="{{ route('home') }}">PT. Sentra Grafindo Utama</a>
            </p>
        </div>
    </div>
</footer>
<!-- End footer Area -->