<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BallResource;
use App\Models\Ball;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BallApiController extends Controller
{
    public function index()
    {
        return new BallResource(Ball::all());
    }

    public function store(Request $request)
    {
        if (! Gate::allows('store-ball', $request)) {
            abort(403);
        }

        $ball = Ball::create($request->all());

        return (new BallResource($ball))
        ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ball $ball)
    {
        return new BallResource($ball);
    }

    public function update(Request $request, Ball $ball)
    {
        $ball->update($request->all());


        return (new BallResource($ball))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ball $ball)
    {
        $ball->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
