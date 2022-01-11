<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Hashing\Hasher;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     */
    public function __construct()
    {
        $this->middleware("auth:api", [
            "except" => ["register", "login", 'passwordReset', 'checkResetTokenAndId', 'passwordChange'],
        ]);
    }

    /**
     * Logout User
     */
    public function logout()
    {
        try {
            $this->guard()->logout();
            return response()->json(
                [
                    "status" => "success",
                    "msg" => "Logged out Successfully.",
                ],
                200
            );
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Get authenticated user
     */
    public function user()
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            "status" => "success",
            "data" => $user,
        ]);
    }

    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        try {
            if ($token = $this->guard()->refresh()) {
                return response()
                    ->json(["status" => "successs", "token" => $token], 200)
                    ->header("Authorization", $token);
            }
            return response()->json(["error" => "refresh_token_error"], 401);
        } catch (\Exception $exception) {
            return response()->json(["error" => $exception->getMessage()], 401);
        }
    }

    /**
     * @param Request $request
     * register
     */
    public function register(Request $request)
    {
        request()->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "confirmPassword" => "required",
        ]);
        try {
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $confirm_password = $request->confirmPassword;
            if ($password !== $confirm_password) {
                throw new Exception("Password not match", 1);
            }
            $user = User::create([
                "name" => $name,
                "email" => $email,
                "password" => bcrypt($password),
            ]);
            if ($token = $this->guard()->login($user)) {
                return response()
                    ->json(["status" => "success", "data" => $user], 200)
                    ->header("Authorization", $token);
            }
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 401);
        }
    }
    public function checkResetTokenAndId(Request $request)
    {
        try {
            $user = User::find($request->id);
            if ($user->rememberToken == $request->token) {
                return response()
                    ->json(["status" => "success"], 200);
            }
            return response()
                ->json(["status" => "Invalid Token"], 400);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 401);
        }
    }
    /**
     * @param Request $request
     * register
     */
    public function passwordReset(Request $request)
    {
        request()->validate([
            "email" => "required",
        ]);
        try {
            $email = $request->email;
            $user = User::where('email', $email)->first();
            if ($user) {

                // === generate token ===
                $key = config('app.key');
                if (Str::startsWith($key, 'base64:')) {
                    $key = base64_decode(substr($key, 7));
                }
                $token = hash_hmac('sha256', Str::random(40), $key);
                $dbToken = app(Hasher::class)->make($token);
                $user->rememberToken = $dbToken;
                $user->update();

                Mail::to($request->email)->send(
                    new PasswordReset($user->rememberToken, $user->id)
                );
                return response()
                    ->json(["status" => "success"], 200);
            }
            throw new Exception("User Not Match with given email!");
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 401);
        }
    }

    /**
     * @param Request $request
     * change
     */
    public function passwordChange(Request $request)
    {
        request()->validate([
            "password" => "required",
            "id" => "required",
        ]);
        try {
            $user = User::findOrFail($request->id);
            $user->password = bcrypt($request->password);
            $user->update();
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 401);
        }
    }

    /**
     * @param Request $request
     * login
     */

    public function login(Request $request)
    {
        $credentials = $request->only("email", "password");

        if ($token = $this->guard()->attempt($credentials)) {
            return response()
                ->json(["status" => "success"], 200)
                ->header("Authorization", $token);
        }
        return response()->json(["error" => "login_error"], 401);
    }

    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}
