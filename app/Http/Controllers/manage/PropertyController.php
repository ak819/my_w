<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\PropertyUnitTypes;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $propertyTypes=getPropertyTypes();
        $cities=getCities();
        return view('properties.list-properties',compact('propertyTypes','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $Property=Property::find($id);
        $Property->tab="Property";  
       // echo "<pre>";
        //print_r($data);
        //exit;
        return view('properties.edit-property',compact('Property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Property=Property::find($id);
        $Property->NoFloors=$request->input('NoFloors');
        //$Property->FloorNumber=$request->input('FloorNumber');
        $Property->Floor=$request->input('Floor');
        $Property->ApartmentType=$request->input('ApartmentType');
        $Property->VillaType=$request->input('VillaType');
        $Property->CommercialType=$request->input('CommercialType');
        $Property->ResidentialLandType=$request->input('ResidentialLandType');
        $Property->SwimmingPool=$request->input('SwimmingPool');
        $Property->OutdoorArea=$request->input('OutdoorArea');
        $Property->Rented=$request->input('Rented');
        $Property->Nostreets=$request->input('Nostreets');
        $Property->Serviced=$request->input('Serviced');
        $Property->BuildPercentageNumber=$request->input('BuildPercentageNumber');
        $Property->FacadeNumber=$request->input('FacadeNumber');
        $Property->BuildFacadeType=$request->input('BuildFacadeType');
        $Property->FloorType=$request->input('FloorType');
        $Property->Video=$request->input('Video');
        $Property->OwnerNo=$request->input('OwnerNo');
        $Property->IsFeatured=($request->input('IsFeatured')) ? 1 : 0;
        $Property->IsExclusive=($request->input('IsExclusive')) ? 1 : 0;
        if(Auth::user()->roleid==1)
        {
         $Property->IsEnable=($request->input('IsEnable')) ? 1 : 0;
        }
        $Property->OwnerName=$request->input('OwnerName');
        $Property->LandNo=$request->input('LandNo');
        $Property->LandDistrict=$request->input('LandDistrict');
        $Property->GuardContactNumber=$request->input('GuardContactNumber');
        $Property->ModifiedBy=Auth::user()->id;
        $Property->save();
        return redirect()->route('property.edit', $id)->withInput()->with('success', 'Property has been edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
   /*----- 
    Author:Akshay 
    Date: 22-Dec-2021 
    Function:for property list serverside ajax datatable
    -----*/
   public function getPropertyList(Request $request)
   {

    $column_order = array(null,'PropertyRefNo',);
    $column_search = array('properties.PropertyTitle','properties.PropertyRefNo'); //set 
    // Total records
    $AssignedAgentTypes=getLoggedInUserAgentTypes();
    $AssignedAgentLocations=getLoggedInUserLocations();
    
    if(Auth::user()->roleid!==1)
    {
     
        $TotalRecords = Property::select('count(*) as allcount')->whereIn('AgentID',$AssignedAgentTypes)->distinct('PropertyRefNo')->count();
    }else{
        $TotalRecords = Property::select('count(*) as allcount')->distinct('PropertyRefNo')->count();
    }
    // Fetch records
    $Query=Property::select(['properties.*','pc.CatergoryName','pu.TypeName','cities.CityName','communities.CommunityName','pi.FileName']);
    $Query->from('properties');
    $UnitTypeID=$request->UnitTypeID;
    $CityID=$request->CityID;
    $CommunityID=$request->CommunityID;
    $AdType=$request->AdType;
    $listingstatus=$request->listingstatus;
    if($UnitTypeID){
        $Query->where('UnitTypeID',$UnitTypeID); 
    }
    if($CityID && empty($CommunityID)){
        $Query->where('properties.CityID',$CityID); 
    }
    if($CommunityID){
        $Query->where('properties.CommunityID',$CommunityID); 
    }
    if($AdType){
        $Query->where('AdType',$AdType); 
    }
    if($listingstatus){
        if($listingstatus=="enabled")
        {
            $Query->where('properties.IsEnable',1);
        }elseif($listingstatus=="disabled")
        {
            $Query->where('properties.IsEnable',0);

        }else{
            $Query->where($listingstatus,1); 
        }
       
    }
    $i = 0; 
    foreach ($column_search  as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
                 
				if($i===0) // first loop
				{
                    //$Query->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $Query->where($item, 'LIKE',"%{$_POST['search']['value']}%"); 
				}
				else
				{
                   $Query->orWhere($item, 'LIKE',"%{$_POST['search']['value']}%");
				}

				//if(count($column_search ) - 1 == $i) //last loop
                //$Query->group_end(); //close bracket
			}
			$i++;
		}
        if(Auth::user()->roleid!==1)
        {
        $Query->whereIn('properties.AgentID',$AssignedAgentTypes);
        $Query->whereIn('properties.CommunityID',$AssignedAgentLocations);
        }
        $Query->join('propety_categories as pc', 'pc.ID','=','properties.CategoryID');
        $Query->join('property_unit_types as pu', 'pu.ID', '=', 'properties.UnitTypeID');
        $Query->join('cities', 'cities.ID', '=', 'properties.CityID');
        $Query->join('communities', 'communities.ID', '=', 'properties.CommunityID');
        $Query->leftJoin('property_images as pi','pi.PropertyID','=','properties.ID');
      if(isset($_POST['order'])) // here order processing
      {
       $Query->orderBy($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

      }else{

        $Query->orderBy('properties.PropertyRefNo','DESC');

      }
      $Query->groupBy('properties.PropertyRefNo');
      //$Query->count();
      //$query=$Query->toSql();
      //dd($query);

      $TotalRecordsWithFilter=$Query->get()->count();
      $start=$_POST['start'];$rowperpage=$_POST['length'];
      if($_POST['length'] != -1)
      $Query->skip($start);
      $Query->take($rowperpage);
      $Records=$Query->get();
      $Data = array();
      foreach( $Records as $val)
      { 
        $row = array();
        $AdType=config('constants.AdType');
        $AdType=array_search ($val->AdType, $AdType);
        $IsFurnished=($val->Furnished)? config('constants.Furnished.'.$val->Furnished)  : "-";
        $IsFeatured=($val->IsFeatured)? "Yes" : "No";
        $IsExclusive=($val->IsExclusive)? "Yes" : "No";
        $IsEnabled=($val->IsEnable)? "Yes" : "No";
        $LastModified=(!$val->ModifiedDate)?"-":datetime_format($val->ModifiedDate);
        $PropertyHtml='<div class="row">
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <p class="mb-1 font-wt-500">'.$val->PropertyTitle.'</p>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <p class="mb-1">'.Str::limit(strip_tags(preg_replace('/\s\s+/', ' ', $val->Description)),100, $end='...').'</p>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <p class="mb-1 font-wt-500">'.$val->PropertyTitleAr.'</p>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <p class="mb-1">'.Str::limit(strip_tags(preg_replace('/\s\s+/', ' ', $val->DescriptionAr)),100, $end='...').'</p>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <p class="mb-1"><i class="material-icons icon-1x color-gray">location_on</i>'.$val->CommunityName.','.$val->CityName.', Jordan</p>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <i class="material-icons icon-3x color-gray">king_bed</i>
            <span>'.$val->NoBedrooms.'</span>

            <i class="material-icons icon-3x color-gray pl-2">shower</i>
            <span>'.$val->NoBathrooms.'</span>

            <i class="material-icons color-gray pl-2">aspect_ratio</i>
            <span>'.number_format($val->UnitBuiltupArea, 2).'  '.$val->UnitMeasure.'</span>

            <i class="material-icons color-gray pl-2">local_atm</i>
            <span class="font-wt-600">'.number_format($val->Price).' JOD</span>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Property Ref No:</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 color-red">'.$val->PropertyRefNo.'</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Category:</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1">'.$val->CatergoryName.'</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Ad Type:</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1">'.$AdType.'</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Unit Type:</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1">'.$val->TypeName.'</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Tenanted:</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1">'.$val->Tenanted.'</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Is Furnished?:</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1">'.$IsFurnished.'</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Last Crawled:</p>
        </div><div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1">'.$LastModified.'</p>
        </div><div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Is Featured?:</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1">'.$IsFeatured.'</p>  
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Is Exclusive?:</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1">'.$IsExclusive.'</p>  
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1 font-wt-500">Is Enabled?:</p>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <p class="mb-1">'.$IsEnabled.'</p>  
        </div>
      </div>'; 
        
 
        
      $img='';
      if($val->FileName)
      {
        $url=asset("uploads/properties/orignal/".$val->PropertyRefNo."/".$val->FileName);
        $img='<img src="'.$url.'" width="200px" />';
      }
      $row[]  =$img;
      $row[] =$PropertyHtml;
        if(Auth::user()->roleid==1 || Auth::user()->roleid==2)
        {
            $row[] ='<a href="'.route('property.edit',$val->Guid).'" class="btn btn-small btn-gold-lt" title="Edit Details"><i class="material-icons icon-2x">edit</i></a>';
            
        }else{
            $row[]="-";
        }
     
      $Data[]= $row;
        
      }
      $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" =>$TotalRecords,
        "recordsFiltered"=>$TotalRecordsWithFilter,
        "data" => $Data,
    );
    //output to json format
    echo json_encode($output);


    
    
  }
    public function propertyUpdateList()
    {       
         $cities=getCities();
        return view('properties.list-properties-update',compact('cities'));
    }


    public function getPropertyUpdateList(Request $request)
   {

    $column_order = array(null,'PropertyRefNo','Status','OwnerName','OwnerNo',null,null,'AdType','Price',null,'IsCrmUpdated');
    $column_search = array('properties.PropertyTitle','properties.PropertyRefNo','properties.OwnerName','properties.OwnerNo'); //set 
    // Total records
    $AssignedAgentTypes=getLoggedInUserAgentTypes();
    $AssignedAgentLocations=getLoggedInUserLocations();
    if(Auth::user()->roleid!==1)
    {
        $TotalRecords = Property::select('count(*) as allcount')->whereIn('AgentID',$AssignedAgentTypes)->distinct('PropertyRefNo')->count();
    }else{
        $TotalRecords = Property::select('count(*) as allcount')->distinct('PropertyRefNo')->count();
    }
    // Fetch records
    $Query=Property::select(['properties.*','pc.CatergoryName','pu.TypeName','cities.CityName','communities.CommunityName','pi.FileName']);
    $Query->from('properties');
    
 
    $CityID=$request->CityID;
    $CommunityID=$request->CommunityID;
    $Status=$request->Status;
    if($CityID && empty($CommunityID)){
        $Query->where('properties.CityID',$CityID); 
    }
    if($CommunityID){
        $Query->where('properties.CommunityID',$CommunityID); 
    }
    if($Status && $Status!=="disabled"){
        $Query->where('properties.Status',$Status); 
    }
   
        if(Auth::user()->roleid!==1)
        {
            if($Status=="disabled")
            {
                $Query->where('properties.IsEnable',0);  

            }else{
                $Query->where('properties.IsEnable',1);
            }
       
           $Query->whereIn('properties.AgentID',$AssignedAgentTypes);
           $Query->whereIn('properties.CommunityID',$AssignedAgentLocations);
        }else{
            
            if($Status=="disabled")
            {
               $Query->where('properties.IsEnable',0);  

            }
        }
        $Query->where(function($query) use ($column_search){
            $i = 0; 
            foreach ($column_search  as $item) // loop column 
            {
                if($_POST['search']['value']) // if datatable send POST for search
                {
                     
                    if($i===0) // first loop
                    {
                        //$Query->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $query->where($item, 'LIKE',"%{$_POST['search']['value']}%"); 
                    }
                    else
                    {
                       $query->orWhere($item, 'LIKE',"%{$_POST['search']['value']}%");
                    }
    
                    //if(count($column_search ) - 1 == $i) //last loop
                    //$Query->group_end(); //close bracket
                }
                $i++;
            }
        });
        $Query->join('propety_categories as pc', 'pc.ID','=','properties.CategoryID');
        $Query->join('property_unit_types as pu', 'pu.ID', '=', 'properties.UnitTypeID');
        $Query->join('cities', 'cities.ID', '=', 'properties.CityID');
        $Query->join('communities', 'communities.ID', '=', 'properties.CommunityID');
        $Query->leftJoin('property_images as pi','pi.PropertyID','=','properties.ID');
      if(isset($_POST['order'])) // here order processing
      {
       $Query->orderBy($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

      }else{

        $Query->orderBy('properties.PropertyRefNo','DESC');

      }
      $Query->groupBy('properties.PropertyRefNo');
      //$Query->count();
      //$query=$Query->toSql();
      //dd($query);

      $TotalRecordsWithFilter=$Query->get()->count();
      $start=$_POST['start'];$rowperpage=$_POST['length'];
      if($_POST['length'] != -1)
      $Query->skip($start);
      $Query->take($rowperpage);
      $Records=$Query->get();
      $Data = array();
      foreach( $Records as $val)
      { 
        $row = array();
        $AdType=config('constants.AdType');
        $AdType=array_search ($val->AdType, $AdType);
        $IsFurnished=($val->Furnished)? config('constants.Furnished.'.$val->Furnished)  : "-";
        $IsFeatured=($val->IsFeatured)? "Yes" : "No";
        $val->Floor=config('constants.FloorNumber.'.$val->Floor);

        $PropertyHtml=' <p class="mb-2 color-red">'.$val->PropertyRefNo.'</p>
        <p class="mb-2">'.$val->PropertyTitle.'</p>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <span class="font-size-12 font-wt-600">Floor No: <span class="font-wt-500">'.$val->Floor.'</span></span><br />
                <span class="font-size-12 font-wt-600">Builtup Area: <span class="font-wt-500">'.number_format($val->UnitBuiltupArea, 2).'</span></span><br />
                <span class="font-size-12 font-wt-600">Land No: <span class="font-wt-500">'.$val->LandNo.'</span></span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <span class="font-size-12 font-wt-600">Plot Area: <span class="font-wt-500">'.number_format($val->PlotSize, 2).'</span></span><br />
                <span class="font-size-12 font-wt-600">Land District: <span class="font-wt-500">'.$val->LandDistrict.'</span></span>
            </div>
        </div>';
 
        
      $row[] ='<a href="" class="btn btn-small btn-gold-lt open-update-form"  data-id="'.$val->Guid.'" data-toggle="modal" data-target="#PropertyDetailsModal"><i class="material-icons icon-2x">edit</i></a>';
      $row[] =$PropertyHtml;
      if($val->Status=="Available")
      {
        $row[]='<span class="badge bd-green-lt">Available</span>';
      }elseif($val->Status=="Rented")
      {
        $row[]='<span class="badge bd-blue-lt">Rented</span>';
      }elseif($val->Status=="Sold")
      {
        $row[]='<span class="badge bd-red-lt">Sold</span>';
      }elseif($val->Status=="Pending"){
        $row[]='<span class="badge bd-orange-lt">Pending</span>';
      }else{
        $row[]='-';
      }
      $row[] =$val->OwnerName;
      $row[] =$val->OwnerNo;
      $row[] =$val->CityName;
      $row[] =$val->CommunityName;
      $row[] = $AdType;
      if($val->NewPrice >0)
      {
        $row[] = '<span>'.number_format($val->NewPrice).' JOD</span><br />
        <span style="text-decoration: line-through;">'.number_format($val->Price).' JOD</span>';
      }else{
        $row[] = number_format($val->Price).' JOD';
      }
      
      $row[] = $val->Comment;
      $row[] = ($val->IsCrmUpdated==1)? "Yes": "No";
      $Data[]= $row;
        
      }
      $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" =>$TotalRecords,
        "recordsFiltered"=>$TotalRecordsWithFilter,
        "data" => $Data,
    );
    //output to json format
    echo json_encode($output);


    
    
  }

  public function storePropertyUpdate()
  { 
    $PostData=$_POST;
    $Status=$PostData['Status'];
    $NewPrice=$PostData['NewPrice'];
    $Comment=$PostData['Comment'];
    $IsCrmUpdated=(array_key_exists('IsCrmUpdated',$PostData))? 1 : 0;
    $PropertyGuid=$PostData['PropertyId'];

  
    DB::transaction(function() use ($PropertyGuid,$Status,$NewPrice,$Comment,$IsCrmUpdated) {
        $Property=Property::find($PropertyGuid);
        if($Property)
        {
        $Property->Status=$Status;
        $Property->NewPrice=$NewPrice;
        $Property->Comment=$Comment;
        $Property->IsCrmUpdated=$IsCrmUpdated;
        $Property->UpdatedBy=Auth::user()->id;
        $Property->save();
        
                 $data=['Guid'=>(string) Str::uuid(),'PropertyID'=>$Property->ID,
                 'PropertyRefNo'=>$Property->PropertyRefNo,
                 'CreatedBy'=>Auth::user()->id,
                 'Status'=>$Status,
                 'NewPrice'=>$NewPrice,
                 'Comment'=>$Comment,
                 'IsCrmUpdated'=>$IsCrmUpdated];
                 DB::table('propertyupdatelogs')->insert($data);
           
        }
       
    });
    return response()->json(['status'=>true]);


  }

  public function  propertyUpdateLogsList()
  {  
    $startdate=(isset($_GET['fromdate']))? date('Y-m-d',strtotime($_GET['fromdate'])): "";
    $enddate=(isset($_GET['todate']))? date('Y-m-d',strtotime($_GET['todate'])): "";

    if($startdate && $enddate)
    {
        $reportlist=DB::table('propertyupdatelogs')
        ->select('propertyupdatelogs.*','users.name')
        ->whereBetween('CreatedDate', [$startdate, $enddate])
        ->join('users', 'users.id', '=', 'propertyupdatelogs.CreatedBy')
        ->get();
    }else{
      
        $reportlist=DB::table('propertyupdatelogs')
        ->select('propertyupdatelogs.*','users.name')
        ->join('users', 'users.id', '=', 'propertyupdatelogs.CreatedBy')
        ->get();
    

    }
    return view('properties.list-properties-update-reports',compact('reportlist'));
  }

  public function importCustomFields()
  {

    return view('properties.import-excel-customfields');


  }


  public function importExcelCustomFields(Request $request)
    {
        $validatedData = $request->validate([
            'File1' => 'required|mimes:csv,xlx,xlsx,tex',
           ]);
           
           
           $the_file = $request->file('File1');
           try{

                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
                $reader->setReadDataOnly(TRUE);
               //$spreadsheet = IOFactory::load($the_file->getRealPath());
               $spreadsheet = $reader->load($the_file->getRealPath());
               //$sheetData = $spreadsheet->getActiveSheet()->toArray();
               $sheet        = $spreadsheet->getActiveSheet();
               $row_limit    = $sheet->getHighestDataRow();
               $column_limit = $sheet->getHighestDataColumn();
               $row_range    = range( 3, $row_limit );
               $column_range = range('U', $column_limit );
               $startcount = 3;
               $data = array();
               foreach ( $row_range as $row ) {                
             
                 $Reference=trim($sheet->getCell( 'A' . $row )->getValue());
                 if($Reference)
                 {
                   $data[] = [
                       'Reference' =>$Reference,
                       'OwnerName' => $sheet->getCell( 'B' . $row )->getValue(),
                       'OwnerMobile' => $sheet->getCell( 'C' . $row )->getValue(),
                       'Floor' => $sheet->getCell( 'D' . $row )->getValue(),
                       'NumberOfFloors' => $sheet->getCell( 'E' . $row )->getValue(),
                       'ApartmentFloortype' => $sheet->getCell( 'F' . $row )->getValue(),
                       'VillaType' => $sheet->getCell( 'G' . $row )->getValue(),
                       'SwimmingPool' => $sheet->getCell( 'H' . $row )->getValue(),
                       'BuildingPercentage' =>$sheet->getCell( 'I' . $row )->getValue(),
                       'LandDistrict' =>$sheet->getCell( 'J' . $row )->getValue(),
                       'NumberOfStreets' =>$sheet->getCell( 'K' . $row )->getValue(),
                       'Facade' =>$sheet->getCell( 'L' . $row )->getValue(),
                       'LandNo' =>$sheet->getCell( 'M' . $row )->getValue(),
                       'OutdoorArea' =>$sheet->getCell( 'N'. $row )->getValue(),
                       'BuildingFacadeType' =>$sheet->getCell( 'O' . $row )->getValue(),
                       'Serviced' =>$sheet->getCell( 'P' . $row )->getValue(),
                       'FloorNum' =>$sheet->getCell( 'Q' . $row )->getValue(),
                       'CommercialType' =>$sheet->getCell( 'R' . $row )->getValue(),
                       'ResidentialLandType' =>$sheet->getCell( 'S' . $row )->getValue(),
                       'CommercialFullBldg' =>$sheet->getCell( 'T' . $row )->getValue(),
                       'Rented' =>$sheet->getCell( 'U' . $row )->getValue(),
                   ];

                 }
                   
                   $startcount++;
               }

               
               
               $i=0;
              foreach($data as $p)
              {  
                //Topic
                $Floor=(trim($p['Floor'])!=="- -")?trim($p['Floor']):"";
                $NoFloors=(trim($p['NumberOfFloors'])!=="- -")?trim($p['NumberOfFloors']):"";
                $ApartmentFloortype=(trim($p['ApartmentFloortype'])!=="- -")?trim($p['ApartmentFloortype']):""; // same for floor type
                $VillaType=(trim($p['VillaType'])!=="- -")?trim($p['VillaType']):"";
                $SwimmingPool=(trim($p['SwimmingPool'])!=="- -")?trim($p['SwimmingPool']):"";
                $Nostreets=(trim($p['NumberOfStreets'])!=="- -")?trim($p['NumberOfStreets']):"";
                $OutdoorArea=(trim($p['OutdoorArea'])!=="- -")?trim($p['OutdoorArea']):"";
                $BuildFacadeType=(trim($p['BuildingFacadeType'])!=="- -")?trim($p['BuildingFacadeType']):"";
                $Serviced=(trim($p['Serviced'])!=="- -")?trim($p['Serviced']):"";
                $FloorNumber=(trim($p['FloorNum'])!=="- -")?trim($p['FloorNum']):"";
                $CommercialType=(trim($p['CommercialType'])!=="- -")?trim($p['CommercialType']):"";
                $ResidentialLandType=(trim($p['ResidentialLandType'])!=="- -")?trim($p['ResidentialLandType']):"";
                $Rented=(trim($p['Rented'])!=="- -")?trim($p['Rented']):"";
                $BuildPercentageNumber=(trim($p['BuildingPercentage'])!=="- -")?trim($p['BuildingPercentage']):"";
                $Facade=(trim($p['Facade'])!=="- -")?trim($p['Facade']):"";
                $OwnerName=(trim($p['OwnerName'])!=="- -")?trim($p['OwnerName']):"";
                $OwnerMobile=(trim($p['OwnerMobile'])!=="- -")?trim($p['OwnerMobile']):"";
                $LandDistrict=(trim($p['LandDistrict'])!=="- -")?trim($p['LandDistrict']):"";
                $LandNo=(trim($p['LandNo'])!=="- -")?trim($p['LandNo']):"";
               
               

                if($p['Reference']!==" ")
                {
                    $updatedata=['Floor'=>$Floor,
                    'NoFloors'=>$NoFloors,
                    //'ApartmentType'=>$ApartmentType,
                    'FloorType'=>$ApartmentFloortype,
                    'VillaType'=>ucwords($VillaType),
                    'SwimmingPool'=>ucwords($SwimmingPool),
                    'BuildPercentageNumber'=>$BuildPercentageNumber,
                    'Nostreets'=>$Nostreets,
                    'FacadeNumber'=>$Facade,
                    'OutdoorArea'=>ucwords($OutdoorArea),
                    'BuildFacadeType'=>$BuildFacadeType,
                    'Serviced'=> ucwords($Serviced),
                    'FloorNumber'=>$FloorNumber,
                    'CommercialType'=>ucwords($CommercialType),
                    'ResidentialLandType'=>ucwords($ResidentialLandType),
                    'Rented'=>ucwords($Rented),
                    'OwnerName'=>$OwnerName,
                    'OwnerNo'=>$OwnerMobile,
                    'LandDistrict'=> $LandDistrict,
                    'LandNo'=>$LandNo,

                    ];
                    
                    DB::table('properties')->where('PropertyRefNo',$p['Reference'])->update($updatedata);
                  
                }
                $i++;
              }
              return back()->withSuccess('Great! all data has been successfully uploaded.');

           } catch (Exception $e) {
               $error_code = $e->errorInfo[1];
               return back()->withErrors('There was a problem uploading the data!');
           }

           return back()->withErrors('There was a problem uploading the data!');
           
    }

    public function resetStatus()
    {
        if(Auth::user()->roleid==1)
        {
            DB::table('properties')->update(['Status'=>'']);
            return back()->with('success','The all status has been reseted');
        }else{

            return back()->with('error','Unauthorize access !');
        }



    }

    public function genrateManualSlugs()
    {
        $property=Property::all();
        foreach ($property as $value) {
            $data=Property::find($value->Guid);
            $data->Slug=generateSlug('properties','PropertyTitle',$value->PropertyTitle);
            $data->SlugAr=generateSlugAr('properties','PropertyTitleAr',$value->PropertyTitleAr);
            $data->save();
        }

        $property=PropertyUnitTypes::all();

        foreach ($property as $value) {
            $data=PropertyUnitTypes::find($value->Guid);
            $data->Slug=generateSlug('property_unit_types','TypeName',$value->TypeName);
            $data->SlugAr=generateSlugAr('property_unit_types','TypeNameAr',$value->TypeNameAr);
            $data->save();
        }
       return "Slug created";

    }


}
