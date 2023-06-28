<ul class="list-unstyled components">
    <li class="nav-item active"><a href="{{ route('admin') }}" class="nav-link"><i class="material-icons font-size-20 color-gold">dashboard</i>&nbsp;&nbsp;<span>Dashboard</span></a></li>
    <li><a href="#property" data-toggle="collapse" aria-expanded="false"><i class="material-icons font-size-20 color-gold">maps_home_work</i>&nbsp;&nbsp;<span>Properties</span></a></li>
    <li>
        <ul class="collapse list-unstyled" id="property">
            <li><a href="{{ route('property.index') }}">Properties</a></li>
            <li><a href="{{ route('show-property-updates')}}">Property Updates</a></li>
            <li><a href="{{ route('import-customfields')}}">Import Property Custom fields</a></li>
            <!--<li><a href="">Amenities</a></li>-->
        </ul>
    </li>

    <li><a href="#enquiry" data-toggle="collapse" aria-expanded="false"><i class="material-icons font-size-20 color-gold">contact_phone</i>&nbsp;&nbsp;<span>Enquiries</span></a></li>
    <li>
        <ul class="collapse list-unstyled" id="enquiry">
            <li><a href="{{ route('enquiries.index')}}" class="nav-link">Property Enquiries</a></li>
            <li><a href="{{ route('listyourproperty.index')}}" class="nav-link">List Property Requests</a></li>
            <li><a href="{{ route('contact-enquiries')}}" class="nav-link">Contact Us Enquiries</a></li>
            <li><a href="{{ route('service-enquiries')}}" class="nav-link">Service Enquiries</a></li>
            <li><a href="{{ route('evaluation-enquiries')}}" class="nav-link">Evaluation Enquiries</a></li>
        </ul>
    </li>

    <li class="nav-item"><a href="{{ route('service.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">design_services</i>&nbsp;&nbsp;<span>Services</span></a></li>
    <li class="nav-item"><a href="{{ route('testimonial.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">contact_mail</i>&nbsp;&nbsp;<span>Testimonials</span></a></li>
    <li class="nav-item"><a href="{{ route('blog.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">rss_feed</i>&nbsp;&nbsp;<span>Blogs</span></a></li>
    <li class="nav-item"><a href="{{ route('agent.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">people</i>&nbsp;&nbsp;<span>Agents</span></a></li>
    <li class="nav-item"><a href="{{ route('users.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">people</i>&nbsp;&nbsp;<span>Users</span></a></li>
    <li class="nav-item"><a href="{{ route('seourl.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">people</i>&nbsp;&nbsp;<span>Seo Url</span></a></li>
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
    <li class="nav-item"><a href="{{ route('contactinfo.edit','65efee2d9bf893a2dd79933ae2f74d1e')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">contact_mail</i>&nbsp;&nbsp;<span>Contact Info</span></a></li>
    <li><a href="#masters" data-toggle="collapse" aria-expanded="false"><i class="material-icons font-size-20 color-gold">settings</i>&nbsp;&nbsp;<span>Masters</span></a></li>
    <li>
    <ul class="collapse list-unstyled" id="masters">
    <li><a href="{{ route('cities.index')}}">Cities</a></li>
    <li><a href="{{ route('communities.index')}}">Locations</a></li>
    <li><a href="{{ route('propertytype.index') }}">Property Types</a></li>
    <li><a href="{{ route('currency.index')}}">Currency</a></li>
    <li><a href="{{ route('evaluation.index')}}">Evaluation Categories</a></li>
    {{-- <li><a href="{{ route('data-backup')}}">Take Database Backup</a></li> --}}
    </ul>
    </li>
     <li><a href="#report" data-toggle="collapse" aria-expanded="false"><i class="material-icons font-size-20 color-gold">print</i>&nbsp;&nbsp;<span>Reports</span></a></li>
     <li>
        <ul class="collapse list-unstyled" id="report">
            <li><a href="{{ route('property-updates-reports')}}">Signature Reports</a></li>
        </ul>
    </li>
   
</ul>