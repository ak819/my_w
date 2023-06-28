<ul class="list-unstyled components">
    <li class="nav-item active"><a href="{{ route('admin') }}" class="nav-link"><i class="material-icons font-size-20 color-gold">dashboard</i>&nbsp;&nbsp;<span>Dashboard</span></a></li>
    <li><a href="#property" data-toggle="collapse" aria-expanded="false"><i class="material-icons font-size-20 color-gold">maps_home_work</i>&nbsp;&nbsp;<span>Properties</span></a></li>
    <li>
        <ul class="collapse list-unstyled" id="property">
            <li><a href="{{ route('property.index') }}">Properties</a></li>
            <li><a href="{{ route('show-property-updates')}}">Property Updates</a></li>
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
     <li><a href="#report" data-toggle="collapse" aria-expanded="false"><i class="material-icons font-size-20 color-gold">print</i>&nbsp;&nbsp;<span>Reports</span></a></li>
     <li>
        <ul class="collapse list-unstyled" id="report">
            <li><a href="{{ route('property-updates-reports')}}">Signature Reports</a></li>
        </ul>
    </li>
   
</ul>