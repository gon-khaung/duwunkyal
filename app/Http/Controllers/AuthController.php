<?php
namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     */
    public function __construct()
    {
        $this->middleware("auth:api", [
            "except" => ["register", "login"],
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
            "phone" => "required",
            "password" => "required",
            "confirmPassword" => "required",
        ]);
        try {
            $name = $request->name;
            $phone = $request->phone;
            $password = $request->password;
            $confirm_password = $request->confirmPassword;
            if ($password !== $confirm_password) {
                throw new Exception("Password not match", 1);
            }
            $user = User::create([
                "name" => $name,
                "phone" => $phone,
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

    /**
     * @param Request $request
     * change
     */
    public function passwordChange(Request $request)
    {
        request()->validate([
            "newpassword" => "required",
            "user_id" => "required",
        ]);
        try {
            $user = User::findOrFail($request->user_id);
            $user->password = bcrypt($request->newpassword);
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
        $credentials = $request->only("phone", "password");

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
