<script>
    'use strict';
    $('html, body').animate({scrollTop: $("#list").offset().top}, 'slow');
    //  $(".locationlist").change(function(){
    //     const option=$('.locationlist').val();
    //     if(option)
    //     {
    //     let optstring = option.toString().replace(',','-');
    //     $('#locations').val(optstring);
    //     }
    // });
    $(".layouts").click(function(){
       const option=$(this).data('type');
       $('#layout-option').val(option);
       $('#searchform').submit();
    });
    $("#orderby").change(function(){
        const option=$(this).val();
        $('#orderby-option').val(option);
        $('#searchform').submit();
    })
    $(document).on('ready', function() {
        $(".hidden *").attr("disabled", "disabled").off('click');
        const filterdivid=$('#propertyType').children("option:selected").data('filterid');
        if(filterdivid)
        {
            $('#'+filterdivid).removeClass('hidden');
            $('#'+filterdivid+" *").removeAttr("disabled");
            
        }
        //form url mngmt

    let url = $("#form_url").val();
    let type=$('#propertyType').children("option:selected").data('char');
    let city=$('#city').children("option:selected").data('char');
    let locations=$(".locationlist option:selected").map(function() {
            return $(this).val();
            }).get();
    let locationstring=locations.map(element=>element).join("-");
    $('#list-selected-locations').val(locationstring);
    let locations_names=$(".locationlist option:selected").map(function() {
            return $(this).data("char");
            }).get();
    locationstring=locations_names.map(element=>element).join(",");
    if(type)
    { 
        url=url+'/'+type;
    }
    if(city)
    {
        url=url+'/'+city;
    }
    if(locations)
    {
        url=url+'/'+locationstring;
    }
    $("#searchform").attr("action",url);
    });

    $(".urlfilters").change(function(){
    console.log('yes');
    let url = $("#form_url").val();
    let type=$('#propertyType').children("option:selected").data('char');
    let city=$('#city').children("option:selected").data('char');
    let locations=$(".locationlist option:selected").map(function() {
            return $(this).val();
            }).get();
    let locationstring=locations.map(element=>element).join("-");
    console.log(locations);
    console.log(locationstring);
    $('#list-selected-locations').val(locationstring);
    let locations_names=$(".locationlist option:selected").map(function() {
            return $(this).data("char");
            }).get();
    locationstring=locations_names.map(element=>element).join(",");
    console.log(locations_names);
    console.log(locationstring);
   
    if(type)
    { 
        url=url+'/'+type;
    }
    if(city)
    {
        url=url+'/'+city;
    }
    if(locations)
    {
        url=url+'/'+locationstring;
    }
    $("#searchform").attr("action",url);
    console.log(url);
    });

    $("#propertyType").change(function(){
        $('.afilters').addClass('hidden');
        $(".hidden *").attr("disabled", "disabled").off('click');
        const filterdivid=$(this).children("option:selected").data('filterid');
        if(filterdivid)
        {
         $('#advance-search').show();
         //$('#collapseExample').show();
         $('#'+filterdivid).removeClass('hidden');
         $('#'+filterdivid+" *").removeAttr("disabled");
        
        $(':input','#'+filterdivid)
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
            
        }else{
          $('#advance-search').hide();
        }
        
       

    })
   
    $("#clearsearch").click(function() {
        $(':input','#searchform')
        .not(':button, :submit, :reset, :hidden')
        .val(''); 
       $('select').val(null).trigger('change');
    });
</script>