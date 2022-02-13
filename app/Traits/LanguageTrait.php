<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait LanguageTrait
{
    protected function LanguageData($requestName ,$colName,$asName,Request $request ,$defaultLang = 'en') {
        $lang = $request->hasHeader($requestName)
            ? $colName ."->" . $request->header($requestName)  . ' AS ' . $asName
            : $colName . "->" . $defaultLang . ' AS ' . $asName;
        return $lang;
    }

}
