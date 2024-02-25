<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Code;
use App\Http\Controllers\EncrytarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CodesController extends Controller
{
    public function __construct() {

        $this->code = new Code();
        $this->user = new User();
        $this->EncrytarController = app(EncrytarController::class);
    }


    public function verificarCodigoView(Request $request)
    {
        if(!$request->hasValidSignature()){
            $codigo = $this->code->obtenerCodigoUsuario(Auth::user()->id);
            $codigo->delete();
            $user = $this->user->getUser(Auth::user()->id);
            $user->status_code = false;
            $user->save();
            Session::flush();
            Auth::logout();
            abort(419);
        }

        return view('pages.verificarCodigoPage');
    }

    public function guardarCodigo($codigo)
    {
        $code = new code();
        $code->code_email = $this->EncrytarController->encrypt($codigo);
        $code->user_id = Auth::user()->id;
        $code->save();
    }

    public function validarCodigo(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'codigo' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Ocurrio un error al ingresar el codigo']);
        }

        $codigo = $this->code->obtenerCodigoUsuario(Auth::user()->id);

        if($this->EncrytarController->decrypt($codigo->code_email) == $request->codigo)
        {
            $codigo->delete();
            $user = $this->user->getUser(Auth::user()->id);
            $user->status_code = true;
            $user->save();

            return redirect('/dashboard')->with('success','bienvenido');
        }

        return redirect()->back()->with('error','codigo erroneo');
    }

}
