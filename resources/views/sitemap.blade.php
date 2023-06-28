<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
            <loc>{{ route('home') }}</loc>
            <priority>1.0</priority>
        </url>
        <url>
            <loc>{{ url('ar/search-properties') . '?' . http_build_query(['adt' => 'Sale']); }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('en/search-properties') . '?' . http_build_query(['adt' => 'Sale']); }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('ar/search-properties') . '?' . http_build_query(['adt' => 'Rent']); }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('en/search-properties') . '?' . http_build_query(['adt' => 'Rent']); }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('ar/contact-us#contactform')  }}"></loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('en/contact-us#contactform')  }}"></loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('addproperty','ar') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('addproperty','en') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('about-us','ar') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('about-us','en') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('our-services','ar') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('our-services','en') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('blogs','ar') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('blogs','en') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('all-sale','en') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('all-rent','en') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('all-sale','ar') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ route('all-rent','ar') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('https://www.homes-jordan.com/en/exclusive-properties') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('https://www.homes-jordan.com/ar/exclusive-properties') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('https://www.homes-jordan.com/en/featured-properties') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('https://www.homes-jordan.com/ar/featured-properties') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=1&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>		
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=3&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=4&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=5&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=6&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=8&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=9&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=10&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=11&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=12&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=1&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>		
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=3&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=4&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=5&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=6&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=8&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=9&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=10&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=11&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=12&adt=Rent') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=1&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=2&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=3&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=4&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=5&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=6&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=8&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=9&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=10&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=11&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/en/search-properties?t=12&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
        <url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=1&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=2&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=3&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=4&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=5&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=6&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=8&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=9&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=10&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=11&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>
		<url>
            <loc>{{ url('https://www.homes-jordan.com/ar/search-properties?t=12&adt=Sale') }}</loc>
            <priority>0.5</priority>
        </url>

        @foreach ($blogs as $blog)
        <url>
            <loc>{{route('blogdetails',['ar',urlencode($blog->SlugAr)])}}</loc>
            <lastmod>{{  date('Y-m-d', strtotime($blog->CreatedDate)) }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{route('blogdetails',['en',urlencode($blog->Slug)])}}</loc>
            <lastmod>{{ date('Y-m-d', strtotime($blog->CreatedDate)) }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
      @endforeach

      @foreach ($services as $service)
      <url>
          <loc>{{route('servicesdetails',['ar',urlencode($service->SlugAr)])}}</loc>
          <lastmod>{{ date('Y-m-d', strtotime($service->CreatedDate))  }}</lastmod>
          <changefreq>weekly</changefreq>
          <priority>0.8</priority>
      </url>
      <url>
          <loc>{{route('servicesdetails',['en',urlencode($service->Slug)])}}</loc>
          <lastmod>{{date('Y-m-d', strtotime($service->CreatedDate)) }}</lastmod>
          <changefreq>weekly</changefreq>
          <priority>0.8</priority>
      </url>
    @endforeach

    @foreach ($properties as $property)

    <url>
        <loc>{{route('property-details',['ar',config('constants.AdTypeRev.'.$property->AdType),$property->PluralAr,$property->SlugAr,$property->PropertyRefNo])}}</loc>
        <lastmod>{{ date('Y-m-d', strtotime($property->CreatedDate)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{route('property-details',['en',config('constants.AdTypeRev.'.$property->AdType),$property->Plural,$property->Slug,$property->PropertyRefNo])}}</loc>
        <lastmod>{{  date('Y-m-d', strtotime($property->CreatedDate)) }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
  @endforeach
       
</urlset>