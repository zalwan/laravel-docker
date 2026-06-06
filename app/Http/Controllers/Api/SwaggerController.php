<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SwaggerController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $user->tokens()->where('name', 'swagger-ui')->delete();

        return view('swagger', [
            'swaggerToken' => $user->createToken('swagger-ui')->plainTextToken,
        ]);
    }

    public function openapi(): JsonResponse
    {
        return response()->json([
            'openapi' => '3.0.3',
            'info' => [
                'title' => 'Laravel Docker REST API',
                'version' => '1.0.0',
                'description' => 'REST API for authentication and users. Use POST /login or /register, copy the token from the response, click Authorize, then paste the token value.',
            ],
            'servers' => [
                ['url' => url('/api')],
            ],
            'components' => [
                'securitySchemes' => [
                    'bearerAuth' => [
                        'type' => 'http',
                        'scheme' => 'bearer',
                        'bearerFormat' => 'Sanctum token',
                    ],
                ],
                'schemas' => [
                    'User' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => ['type' => 'integer', 'example' => 1],
                            'name' => ['type' => 'string', 'example' => 'Suryawan'],
                            'email' => ['type' => 'string', 'example' => 'suryawan@example.com'],
                            'email_verified_at' => ['type' => 'string', 'nullable' => true, 'example' => null],
                            'created_at' => ['type' => 'string', 'example' => '2026-06-06T12:00:00.000000Z'],
                            'updated_at' => ['type' => 'string', 'example' => '2026-06-06T12:00:00.000000Z'],
                        ],
                    ],
                    'AuthResponse' => [
                        'type' => 'object',
                        'properties' => [
                            'message' => ['type' => 'string'],
                            'data' => [
                                'type' => 'object',
                                'properties' => [
                                    'user' => ['$ref' => '#/components/schemas/User'],
                                    'token' => ['type' => 'string'],
                                    'token_type' => ['type' => 'string', 'example' => 'Bearer'],
                                ],
                            ],
                        ],
                    ],
                    'UserPayload' => [
                        'type' => 'object',
                        'required' => ['name', 'email', 'password', 'password_confirmation'],
                        'properties' => [
                            'name' => ['type' => 'string', 'example' => 'Suryawan'],
                            'email' => ['type' => 'string', 'example' => 'suryawan@example.com'],
                            'password' => ['type' => 'string', 'example' => 'password123'],
                            'password_confirmation' => ['type' => 'string', 'example' => 'password123'],
                        ],
                    ],
                    'UserUpdatePayload' => [
                        'type' => 'object',
                        'properties' => [
                            'name' => ['type' => 'string', 'example' => 'Suryawan Updated'],
                            'email' => ['type' => 'string', 'example' => 'suryawan.updated@example.com'],
                            'password' => ['type' => 'string', 'example' => 'password123'],
                            'password_confirmation' => ['type' => 'string', 'example' => 'password123'],
                        ],
                    ],
                    'ValidationError' => [
                        'type' => 'object',
                        'properties' => [
                            'message' => ['type' => 'string'],
                            'errors' => ['type' => 'object'],
                        ],
                    ],
                ],
            ],
            'paths' => [
                '/register' => [
                    'post' => [
                        'summary' => 'Register a new user',
                        'tags' => ['Auth'],
                        'requestBody' => [
                            'required' => true,
                            'content' => [
                                'application/json' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'required' => ['name', 'email', 'password', 'password_confirmation'],
                                        'properties' => [
                                            'name' => ['type' => 'string', 'example' => 'Suryawan'],
                                            'email' => ['type' => 'string', 'example' => 'suryawan@example.com'],
                                            'password' => ['type' => 'string', 'example' => 'password123'],
                                            'password_confirmation' => ['type' => 'string', 'example' => 'password123'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'responses' => [
                            '201' => [
                                'description' => 'Registered',
                                'content' => [
                                    'application/json' => [
                                        'schema' => ['$ref' => '#/components/schemas/AuthResponse'],
                                    ],
                                ],
                            ],
                            '422' => [
                                'description' => 'Validation error',
                                'content' => [
                                    'application/json' => [
                                        'schema' => ['$ref' => '#/components/schemas/ValidationError'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/login' => [
                    'post' => [
                        'summary' => 'Login user',
                        'tags' => ['Auth'],
                        'requestBody' => [
                            'required' => true,
                            'content' => [
                                'application/json' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'required' => ['email', 'password'],
                                        'properties' => [
                                            'email' => ['type' => 'string', 'example' => 'suryawan@example.com'],
                                            'password' => ['type' => 'string', 'example' => 'password123'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Logged in',
                                'content' => [
                                    'application/json' => [
                                        'schema' => ['$ref' => '#/components/schemas/AuthResponse'],
                                    ],
                                ],
                            ],
                            '422' => [
                                'description' => 'Validation error',
                                'content' => [
                                    'application/json' => [
                                        'schema' => ['$ref' => '#/components/schemas/ValidationError'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/logout' => [
                    'post' => [
                        'summary' => 'Logout current token',
                        'tags' => ['Auth'],
                        'security' => [['bearerAuth' => []]],
                        'responses' => [
                            '200' => ['description' => 'Logged out'],
                            '401' => ['description' => 'Unauthenticated'],
                        ],
                    ],
                ],
                '/users/me' => [
                    'get' => [
                        'summary' => 'Get authenticated user',
                        'tags' => ['Users'],
                        'security' => [['bearerAuth' => []]],
                        'responses' => [
                            '200' => [
                                'description' => 'Current user',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'data' => ['$ref' => '#/components/schemas/User'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            '401' => ['description' => 'Unauthenticated'],
                        ],
                    ],
                ],
                '/users' => [
                    'get' => [
                        'summary' => 'List users',
                        'tags' => ['Users'],
                        'security' => [['bearerAuth' => []]],
                        'responses' => [
                            '200' => ['description' => 'Paginated users'],
                            '401' => ['description' => 'Unauthenticated'],
                        ],
                    ],
                    'post' => [
                        'summary' => 'Create user',
                        'tags' => ['Users'],
                        'security' => [['bearerAuth' => []]],
                        'requestBody' => [
                            'required' => true,
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/UserPayload'],
                                ],
                            ],
                        ],
                        'responses' => [
                            '201' => [
                                'description' => 'Created',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'message' => ['type' => 'string'],
                                                'data' => ['$ref' => '#/components/schemas/User'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            '401' => ['description' => 'Unauthenticated'],
                            '422' => [
                                'description' => 'Validation error',
                                'content' => [
                                    'application/json' => [
                                        'schema' => ['$ref' => '#/components/schemas/ValidationError'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/users/{id}' => [
                    'get' => [
                        'summary' => 'Get user detail',
                        'tags' => ['Users'],
                        'security' => [['bearerAuth' => []]],
                        'parameters' => [
                            [
                                'name' => 'id',
                                'in' => 'path',
                                'required' => true,
                                'schema' => ['type' => 'integer'],
                            ],
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'User detail',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'data' => ['$ref' => '#/components/schemas/User'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            '401' => ['description' => 'Unauthenticated'],
                            '404' => ['description' => 'Not found'],
                        ],
                    ],
                    'put' => [
                        'summary' => 'Update user',
                        'tags' => ['Users'],
                        'security' => [['bearerAuth' => []]],
                        'parameters' => [
                            [
                                'name' => 'id',
                                'in' => 'path',
                                'required' => true,
                                'schema' => ['type' => 'integer'],
                            ],
                        ],
                        'requestBody' => [
                            'required' => true,
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/UserUpdatePayload'],
                                ],
                            ],
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Updated',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'message' => ['type' => 'string'],
                                                'data' => ['$ref' => '#/components/schemas/User'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            '401' => ['description' => 'Unauthenticated'],
                            '404' => ['description' => 'Not found'],
                            '422' => [
                                'description' => 'Validation error',
                                'content' => [
                                    'application/json' => [
                                        'schema' => ['$ref' => '#/components/schemas/ValidationError'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'delete' => [
                        'summary' => 'Delete user',
                        'tags' => ['Users'],
                        'security' => [['bearerAuth' => []]],
                        'parameters' => [
                            [
                                'name' => 'id',
                                'in' => 'path',
                                'required' => true,
                                'schema' => ['type' => 'integer'],
                            ],
                        ],
                        'responses' => [
                            '200' => ['description' => 'Deleted'],
                            '401' => ['description' => 'Unauthenticated'],
                            '404' => ['description' => 'Not found'],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
