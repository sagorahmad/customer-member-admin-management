<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/email/verify';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'custom_text' => ['nullable', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'preferences' => ['required', 'array', 'min:1'],
            'preferences.*' => ['string', 'max:255'],
            'color' => ['required', 'string', 'in:Red,Green,Yellow,Blue'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);
    }

    protected function create(array $data)
    {
        $profilePicturePath = null;
        if (isset($data['profile_picture'])) {
            $profilePicturePath = $data['profile_picture']->store('profile_pictures', 'public');
        }

        return User::create([
            'name' => $data['name'] ?? null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'custom_text' => $data['custom_text'] ?? null,
            'gender' => $data['gender'],
            'preferences' => json_encode($data['preferences']),
            'colors' => $data['color'],
            'profile_picture' => $profilePicturePath,
        ]);
    }

    public function register(Request $request)
{
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));

    // Log out the user immediately after registration
    // Log the user in temporarily
    Auth::login($user);

    // Redirect to email verification notice
    return redirect('/email/verify')->with('message', 'Registration successful! Please verify your email.');
}

}
