<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use SoapBox\Formatter\Formatter;

class ConvertController extends Controller
{
    public function convert(Request $request){
        $convert_to = $request->input('convert_to');
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $file->move(public_path() . '/uploads/', $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $pos = strrpos($file_name, '.');
            $file_ext = substr($file_name, $pos+1);
            $file_name_without_ext = substr($file_name, 0, $pos);
            $file_name_new = $file_name_without_ext.".".$convert_to;
            $text = file_get_contents("uploads/{$file_name}");


            switch ($file_ext) {
                case "json":
                  $ext =  Formatter::JSON; //json
                    break;
                case "csv":
                    $ext =  Formatter::CSV;  //csv
                    break;
                case "xml" :
                    $ext =    Formatter::XML;  //xml
                    break;
                case "yaml" :
                    $ext =    Formatter::YAML; //yaml
                    break;
            }

             $to =  'to'.ucfirst($convert_to);

//            $result =  Formatter::make($text, $ext)->toArray();
//            $converter_text = Formatter::make($result, Formatter::ARR)->$to();

            $converter_text = Formatter::make($text, $ext)->$to();

            $newFileName = "uploads/{$file_name_new}";
            $fp = fopen($newFileName, 'w');
            fwrite($fp, $converter_text);
            fclose($fp);

            return view('welcome', ['file_name' => $file_name_new]);
        }
        return view('welcome');
    }

    public function download($file_name){
        $file= public_path(). "/uploads/".$file_name;
        $pos = strrpos($file_name, '.');
        $file_ext = substr($file_name, $pos+1);
        switch ($file_ext) {
            case "json":
                $headers = array(
                    'Content-Type: application/json',
                );
                break;
            case "csv":
                $headers = array(
                    'Content-Type: text/csv',
                );
                break;
            case "xml" :
                $headers = array(
                    'Content-Type: application/xml',
                );
                break;
            case "yaml" :
                $headers = array(
                    'Content-Type: text/yaml',
                );
                break;
        }

        return Response::download($file, $file_name, $headers);
    }

}
