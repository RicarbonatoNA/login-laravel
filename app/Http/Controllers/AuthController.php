<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CodesController;
use App\Mail\SeendEmail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct() {
        $this->users = new User();
        $this->CodesController = app(CodesController::class);
    }

    public function loginView()
    {
        return view('auth.loginPage');
    }

    public function registerView()
    {
        return view('auth.registerPage');
    }

    public function dashboardView()
    {
        return view('pages.dashboard');
    }

    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return redirect('/login')->with(['error' => 'Ocurrio un error al iniciar sesion']);
        }
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials))
        {
            if (Auth::user()->rol_id==1) {
                $code = rand(1000,10000);

                $url=URL::temporarySignedRoute('codigo', now()->addMinutes(5));

                $user = $this->users->getUser(Auth::user()->id);

                $this->CodesController->guardarCodigo($code);

                Mail::to(Auth::user()->email)->send(new SeendEmail($user,$code,$url));

                return redirect('/login')->with('success','codigo enviado');
            }
            return redirect('/dashboard')->with('success','Bienvenido!');
        }
        return redirect('/login')->with(['error' => 'Ocurrio un error al iniciar sesion']);
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if($validator->fails()){
            return redirect('/signUp')->with(['error' => 'Ocurrio un error al registrarse']);
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->rol_id = ($this->users->isAdmin()) ? 2 : 1;
        if($user->save())
        {
            return redirect('/login')->with('success','registrado correctamente');
        }

        return back('/signUp')->with('error','error al registrar');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('success', 'adios');
    }
}
