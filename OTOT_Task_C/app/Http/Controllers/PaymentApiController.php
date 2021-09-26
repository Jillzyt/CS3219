<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentApiController extends Controller
{
    public function index(Request $request)
    {
        if (! Gate::allows('get-payment', $request)) {
            abort(403);
        }
        return new PaymentResource(Payment::all());
    }

    public function store(Request $request)
    {
        $payment = Payment::create($request->all());

        return (new PaymentResource($payment))
        ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    public function update(Request $request, Payment $payment)
    {
        $payment->update($request->all());


        return (new PaymentResource($payment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
