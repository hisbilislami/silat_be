<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Registering a new user to this system.
     *
     * @return string / json_string
     */
    public function register(Request $request)
    {
        $rules = [
            'username' => 'required|string|max:12',
            'password' => 'required|string|min:8',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ];
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'username' => 'required|string|max:12'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'username' => $request->username,
                'no_telepon' => $request->no_telepon,
                'nip' => $request->nip,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(
                [
                    'data' => $user,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'status_code' => Response::HTTP_OK
                ],
                Response::HTTP_OK
            );

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(
                [
                    'error' => $e->errors(),
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
		} catch (\Illuminate\Database\QueryException $e) {
            return response()->json(
                [
                    'error' => $e->errorInfo,
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => $e,
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Login method
     *
     * @return string / json_string
     */
    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);

            if (!Auth::attempt($request->only('username', 'password')))
            {
                return response()
                    ->json(
                        [
                            'message' => 'Invalid login details',
                            'status_code' => Response::HTTP_UNAUTHORIZED
                        ],
                        Response::HTTP_UNAUTHORIZED
                    );
            }

            $user = User::where('username', $request['username'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;


            return response()->json(
                [
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ]
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(
                [
                    'message' => $e->errors(),
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => $e,
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Logout method
     *
     * @return string / json_string
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(
                [
                    'message' => 'logged out',
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => $e,
                    'status_code' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
