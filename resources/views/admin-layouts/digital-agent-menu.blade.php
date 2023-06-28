<ul class="list-unstyled components">
    {{-- <li class="nav-item active"><a href="{{ route('admin') }}" class="nav-link"><i class="material-icons font-size-20 color-gold">dashboard</i>&nbsp;&nbsp;<span>Dashboard</span></a></li> --}}
    <li class="nav-item"><a href="{{ route('service.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">design_services</i>&nbsp;&nbsp;<span>Services</span></a></li>
    <li class="nav-item"><a href="{{ route('testimonial.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">contact_mail</i>&nbsp;&nbsp;<span>Testimonials</span></a></li>
    <li class="nav-item"><a href="{{ route('agent.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">people</i>&nbsp;&nbsp;<span>Agents</span></a></li>
    <li class="nav-item"><a href="{{ route('blog.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">rss_feed</i>&nbsp;&nbsp;<span>Blogs</span></a></li>
    <li><a href="#images" data-toggle="collapse" aria-expanded="false"><i class="material-icons font-size-20 color-gold">collections</i>&nbsp;&nbsp;<span>Images</span></a></li>
    <li>
        <ul class="collapse list-unstyled" id="images">
            <li><a href="{{ route('banner.index')}}">Homes Banners</a></li>
            <li><a href="{{ route('hero-banners-list')}}">Hero Banners</a></li>
            <li><a href="{{ route('about-images-list')}}">About Us Images</a></li>
            <li><a href="{{ route('media.index')}}">Media Images</a></li>
            <!--<li><a href="">Amenities</a></li>-->
        </ul>
    </li>
   
   
     
   
</ul>