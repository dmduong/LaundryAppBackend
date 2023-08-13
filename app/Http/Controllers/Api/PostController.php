<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Services\Post\PostService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index()
    {
        $post = $this->postService->getAllPost();
        return response()->json(PostResource::collection($post), Response::HTTP_OK);
    }

    public function store(StorePostRequest $request)
    {
        $post = $this->postService->store($request->validated());
        return response()->json(new PostResource($post), Response::HTTP_OK);
    }
}