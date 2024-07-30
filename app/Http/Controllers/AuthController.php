<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // Salvar o nome do usuário em cache
            $usuario = Auth::user();
            Session::put('usuario_nome', $usuario->nome);

            return redirect()->intended('usuarios');
        }

        return redirect('login')->withErrors('Login inválido, verifique suas credenciais.');
    }

    public function loginAjax(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            // Criptografar a senha com MD5 antes de tentar autenticar
            $credentials['password'] = md5(trim($credentials['password']));

            // Buscar o usuário pelo email
            $usuario = Login::where('email', $credentials['email'])->first();

            // Verificar se o usuário existe e se a senha está correta
            if ($usuario && $usuario->senha === $credentials['password']) {
                // Autenticar o usuário manualmente
                Auth::login($usuario);

                // Salvar o nome do usuário em cache
                Session::put('usuario_nome', $usuario->nome);

                return response()->json(['success' => true, 'redirect' => route('usuarios.index')]);
            } else {
                return response()->json(['success' => false, 'message' => 'Login inválido, verifique suas credenciais.']);
            }
        } catch (\Exception $e) {
            // Registrar o erro no log do Laravel
            Log::error('Erro no login: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            // Retornar a mensagem de erro específica para o console
            return response()->json(['success' => false, 'message' => 'Erro no servidor, tente novamente mais tarde.', 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        }
    }



    public function showRegistrationForm()
    {
        return view('auth.registro');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:logins',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // pelo menos uma letra minúscula
                'regex:/[A-Z]/', // pelo menos uma letra maiúscula
                'regex:/[0-9]/', // pelo menos um dígito
                'confirmed',
            ],
        ]);

        // Criptografar a senha usando MD5
        $hashedPassword = md5(trim($request->password));

        Login::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $hashedPassword,
            'nivel' => 'normal',
        ]);

        return redirect('login')->with('success', 'Parabéns pelo registro! Faça login para continuar.');
    }




    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('usuario_nome');
        return redirect('login');
    }
}
