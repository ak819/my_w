<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyEnquiries;
use App\Models\PropertyList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Data=new \stdClass();
        $AssignedAgentTypes=getLoggedInUserAgentTypes();
        if(Auth::user()->roleid!==1)
        {
        $Data->RentCount=Property::select('count(*) as allcount')->where('AdType',1)->whereIn('AgentID',$AssignedAgentTypes)->distinct('PropertyRefNo')->count();
        $Data->SaleCount=Property::select('count(*) as allcount')->where('AdType',2)->whereIn('AgentID',$AssignedAgentTypes)->distinct('PropertyRefNo')->count();
        $Data->PropertyEnquiriesCount=PropertyEnquiries::select('count(property_enquiries.PropertyID) as allcount')
             ->join('properties as p', 'p.ID','=','property_enquiries.PropertyID')
             ->whereIn('p.AgentID',$AssignedAgentTypes)->count();
        }else{
        $Data->RentCount=Property::select('count(*) as allcount')->where('AdType',1)->distinct('PropertyRefNo')->count();
        $Data->SaleCount=Property::select('count(*) as allcount')->where('AdType',2)->distinct('PropertyRefNo')->count();
        $Data->PropertyEnquiriesCount=PropertyEnquiries::select('count(*) as allcount')->count();

        }
        
        $Data->ListPropertyCount=PropertyList::select('count(*) as allcount')->count();
    return view('dashboard',compact('Data'));

    }
    public function backupDatabase(){

        Artisan::call('database:backup');

        return true;

        //ENTER THE RELEVANT INFO BELOW
        $mysqlHostName      = env('DB_HOST');
        $mysqlUserName      = env('DB_USERNAME');
        $mysqlPassword      = env('DB_PASSWORD');
        $DbName             = env('DB_DATABASE');
        $backup_name        = "mybackup.sql";

     


        $tables             = array("banners","blogs","	properties","cities",'communities'); //here your tables...
        //$tables             = array_column(DB::select('SHOW TABLES'),'Tables_in_homesjordan');

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();


        $output = '';
        foreach($tables as $table)
        {
         $show_table_query = "SHOW CREATE TABLE " . $table . "";
         $statement = $connect->prepare($show_table_query);
         $statement->execute();
         $show_table_result = $statement->fetchAll();

         foreach($show_table_result as $show_table_row)
         {
          $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
         }
         $select_query = "SELECT * FROM " . $table . "";
         $statement = $connect->prepare($select_query);
         $statement->execute();
         $total_row = $statement->rowCount();

         for($count=0; $count<$total_row; $count++)
         {
          $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
          $table_column_array = array_keys($single_result);
          $table_value_array = array_values($single_result);
          $output .= "\nINSERT INTO $table (";
          $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
          $output .= "'" . implode("','", $table_value_array) . "');\n";
         }
        }
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
           header('Pragma: public');
           header('Content-Length: ' . filesize($file_name));
           ob_clean();
           flush();
           readfile($file_name);
           unlink($file_name);


}
}
