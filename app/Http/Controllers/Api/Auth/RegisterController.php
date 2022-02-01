<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\GeneralTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    use GeneralTrait;
    public function register(Request $request ) {

        try {
            $rules = [
               'name'       => ['required'],
               'phone'      => ['required', 'regex:/^[0-9]+$/' , 'min:10', 'max:20', 'unique:customers,phone'],
               'address'    => ['required'],
               'password'   => ['required', 'confirmed','min:6','max:12'],
               'email'      => ['required', 'email', 'unique:customers,email'],

            ];
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code , $validator);
            }
            $client =   Customer::create([
                'name'      => $request->name,
                'phone'     => $request->phone,
                'password'  => bcrypt($request->password),
                'email'     => $request->email,
                'address'   => $request->address
            ]);

            if($client) {
                return $this->returnSuccessMessage('Created Successfully');
            }

        }
        catch (\Exception $e) {

            return $this->returnError('E001' ,'Something Is invalid Try Again Later...' . $e->getMessage());
        }// End RegisterProcess

    }
}
