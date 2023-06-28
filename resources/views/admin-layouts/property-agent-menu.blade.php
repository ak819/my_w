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
    <li class="nav-item"><a href="{{ route('enquiries.index')}}" class="nav-link"><i class="material-icons font-size-20 color-gold">contact_phone</i>&nbsp;&nbsp;<span>Property Enquiries</span></a></li>
   
    
    
   
</ul>