<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAdmin;
use App\Http\Requests\UpdateAdmin;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function many()
    {
        $admins = User::paginate(10);
        return $admins;
    }

    public function one($id)
    {
        $student = User::find($id);
        if (!$student) {
            $response['message'] = 'Admin does not exist';
            return $response;
        }
        return $student;
    }

    public function register(AddAdmin $request)
    {
        // Validate the incoming data
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Admin Added Successfully'
        ]);
    }

    public function update(UpdateAdmin $request, $id)
    {
        $request->validated();

        // Check if student exists
        $user = User::find($id);
        if (!$user) {
            $response['message'] = 'Admin does not exist';
            return $response;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Admin Updated Successfully'
        ]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }

    public function delete($id)
    {
        // Check if admin exists
        $user = User::find($id);
        if (!$user) {
            $response['message'] = 'Admin does not exist';
            return $response;
        }
        $user->delete();
        $response['message'] = 'Admin deleted successfully';
        return $response;
    }
}
