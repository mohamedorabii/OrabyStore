<footer class="footer-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Top Products</h4>
                <ul>
                    <li><a href="{{ route('products') }}">All Products</a></li>
                    <li><a href="{{ route('categories') }}">Categories</a></li>
                    <li><a href="{{ route('brands') }}">Brands</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 single-footer-widget">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('cart.index') }}">Cart</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 single-footer-widget">
                <h4>About OrabyStore</h4>
                <p>I am Mohamed Alaa Oraby, a web developer passionate about creating modern and responsive websites.</p>
            </div>
            <div class="col-lg-4 col-md-6 single-footer-widget">
                <h4>Newsletter</h4>
                <p>Subscribe to get the latest offers!</p>
                <div class="form-wrap">
                    <div class="form-inline">
                        <input class="form-control" placeholder="Your Email Address" type="email">
                        <button class="click-btn btn btn-default">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom row align-items-center">
            <p class="footer-text m-0 col-lg-8 col-md-12">
                &copy; {{ date('Y') }} OrabyStore — Mohamed Alaa Oraby. All rights reserved.
            </p>
            <div class="col-lg-4 col-md-12 footer-social">
                <a href="https://www.facebook.com/share/1CfcigUQ94/" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="https://www.linkedin.com/in/mohamedalaaorabii" target="_blank"><i class="fa fa-linkedin"></i></a>
                <a href="https://github.com/mohamedorabiii" target="_blank"><i class="fa fa-github"></i></a>
                <a href="https://wa.me/201281856592" target="_blank"><i class="fa fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
</footer>