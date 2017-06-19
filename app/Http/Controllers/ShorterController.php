<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ShorterController extends Controller
{
    //
    public function index()
    {
		return view('index');// index page loading
	}
	public function add()// create short url and Add original url and short url into table shorter. and then fetch all data and submit it into table created using jquery ajax
    {
		$long   = json_decode(\Input::get("long"));
       $objReport = new \Shorter();
       $randomChar=$this->RandomString();
       $objReport->longUrl = $long;
       $objReport->shortUrl = "https://goo.gl/".$randomChar;
       
       $result=$objReport->save();
       if($result)
       {
       	$table_data = \Shorter::all();
       	$table = '<table><thead><tr><th>SL NO</th><th>Original Url</th><th>Short Url</th></tr></thead><tbody>';
       	$i = 1;
       	foreach($table_data as $tabledat){
			$table .= '<tr><td>'.$i.'</td><td>'.$tabledat->longUrl.'</td><td><a href="'.$tabledat->longUrl.'">'.$tabledat->shortUrl.'</a></td></tr>';
			$i++;
		}
		$table .= '</tbody></table>';
	   	 print_r($table);
	   }
      
	}
	public function RandomString()//random string generator
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randstring = '';
	    for ($i = 0; $i < 10; $i++) {
	        $randstring = $characters[rand(0, strlen($characters))];
	    }
	    return $randstring;
	}
}

