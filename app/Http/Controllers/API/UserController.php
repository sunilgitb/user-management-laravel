<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return response()->json($user, 201);
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userService->updateUser($id, $request->validated());
        return $user ? response()->json($user) : response()->json(['error' => 'User not found'], 404);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return $user ? response()->json($user) : response()->json(['error' => 'User not found'], 404);
    }

   

  public function index(){
    $users = $this->userService->getAllUsers();
    return response()->json($users);
  }
   

    public function destroy($id)
    {
        $deleted = $this->userService->deleteUser($id);
        return $deleted ? response()->json(['message' => 'User deleted successfully']) : response()->json(['error' => 'User not found'], 404);
    }

    public function register(Request $request)
    {
        
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        
        $token = $user->createToken('API Token')->plainTextToken;

        
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Login an existing user.
     */
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        
        $user = User::where('email', $request->email)->first();

        
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        
        $token = $user->createToken('API Token')->plainTextToken;

        
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Logout the authenticated user.
     */
    public function logout(Request $request)
    {
        
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
