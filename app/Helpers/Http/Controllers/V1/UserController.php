<?php

namespace App\Helpers\Http\Controllers\V1;

use App\Contracts\UserInterface;
use App\Helpers\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param UserInterface $userRepository
     */
    public function __construct(private readonly UserInterface $userRepository){}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllUsers(Request $request): JsonResponse
    {
        return response()->json($this->userRepository->getAllUsers());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSingleUser(Request $request): JsonResponse
    {
        $user = $this->userRepository->getSingleUser($request->user_id);
        return response()->json(!empty($user) ? $user : ['message' => 'User not found.'],
            !empty($user) ? 200: 404
        );
    }

}
