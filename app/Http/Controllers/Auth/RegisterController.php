<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:11'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(Request $request, $bypass_verification = false)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Send verification email
        $verificationController = new VerificationController();
        $verificationController->sendInitialVerificationEmail($user);

        if ($bypass_verification) {
            auth()->login($user);
        }
        return $user;
    }

    public function registerLegalEntity(Request $request)
    {
        // Update the validation rules
        $validator = Validator::make($request->all(), [
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'inn' => ['required', 'string', 'size:10', 'unique:suppliers'], // Changed from legal_entities to suppliers
            'ogrn' => ['required', 'string', 'size:13', 'unique:suppliers'], // Changed from legal_entities to suppliers
            'legal_address' => ['required', 'string', 'max:255'],
            'physical_address' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->contact_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'legal_entity',
        ]);

        // Update this part to create a supplier instead of a legal entity
        $supplier = $user->supplier()->create([
            'company_name' => $request->company_name,
            'inn' => $request->inn,
            'email' => $request->email,
            'phone' => $request->phone ?? '4645464545',
            'additional_phone' => $request->additional_phone ?? '4645464545',
            'contact_name' => $request->contact_name,
            'ogrn' => $request->ogrn,
            'address' => $request->legal_address,
            'legal_address' => $request->legal_address,
            'physical_address' => $request->physical_address,
        ]);

        // If you're associating regions, update this part as well
        $regionCodes = json_decode($request->region_codes, true);
        $supplier->region_code = $regionCodes;
        $supplier->save();

        // Send verification email
        $verificationController = new VerificationController();
        $verificationController->sendInitialVerificationEmail($user);

        return view('legal_entity_confirmation', [
            'company_name' => $request->company_name,
            'inn' => $request->inn,
            'kpp' => $request->kpp,
            'ogrn' => $request->ogrn,
            'legal_address' => $request->legal_address,
            'physical_address' => $request->physical_address,
            'email' => $request->email,
            'phone' => $request->phone,
            'additional_phone' => $request->additional_phone,
            'contact_name' => $request->contact_name,
            'selected_regions' => $selectedRegions, // Assuming you have this data
        ]);
    }
}
