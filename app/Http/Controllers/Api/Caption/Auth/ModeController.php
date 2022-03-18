<?php

namespace App\Http\Controllers\Api\Caption\Auth;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ModeController extends Controller
{
    use GeneralTrait;
    public function updateMode(Request $request) {

        try{

            $caption = auth('api-caption')->user();

            if($caption->online == 1 ) {
                $status = 0;
                $msg = 'offline';
            }else {
                $status = 1;
                $msg = 'online';
            }
           $caption->update([
                'online'    => $status // if online make it offline and else offline make it online
            ]);

            return $this->returnSuccessMessage($msg);
        }
        catch (\Exception $e) {
            return $this->returnError('',$e->getMessage());
        }

    }
}
