<?php

namespace App\Factories;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Http\JsonResponse;

class ErrorFactory
{
    static function create(Throwable $exception, $request): JsonResponse
    {
        $locale = $request->header('Accept-Language', 'en');
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }
        app()->setLocale($locale);

        $apiError = match (true) {
            $exception instanceof ValidationException => [
                'title'   => __('errors.validation_failed'),
                'detail'  => $exception->getMessage() ?: $exception->validator->errors()->toArray(),
                'instance' => $request->url(),
                'status'  => 422,
            ],

            $exception instanceof AuthenticationException => [
                'title'   => __('errors.unauthenticated'),
                'detail'  => $exception->getMessage() ?: __('errors.unauthenticated_detail'),
                'instance' => $request->url(),
                'status'  => 401,
            ],

            $exception instanceof AuthorizationException => [
                'title'   => __('errors.forbidden'),
                'detail'  => $exception->getMessage() ?: __('errors.forbidden_detail'),
                'instance' => $request->url(),
                'status'  => 403,
            ],

            $exception instanceof ModelNotFoundException,
            $exception instanceof NotFoundHttpException => [
                'title'   => __('errors.not_found'),
                'detail'  =>$exception->getMessage() ?:  __('errors.not_found_detail'),
                'instance' => $request->url(),
                'status'  => 404,
            ],

            $exception instanceof MethodNotAllowedHttpException => [
                'title'   => __('errors.method_not_allowed'),
                'detail'  => $exception->getMessage() ?: __('errors.method_not_allowed_detail'),
                'instance' => $request->url(),
                'status'  => 405,
            ],

            $exception instanceof ThrottleRequestsException => [
                'title'   => __('errors.too_many_requests'),
                'detail'  => $exception->getMessage() ?: __('errors.too_many_requests_detail'),
                'instance' => $request->url(),
                'status'  => 429,
            ],

            default => [
                'title'   => __('errors.default_title'),
                'detail'  => $exception->getMessage() ?: __('errors.default_detail'),
                'instance' => $request->url(),
                'status'  => ($exception->getCode() >= 100 && $exception->getCode() <= 599)
                    ? $exception->getCode()
                    : 500,
            ]
        };

        return new JsonResponse($apiError, $apiError['status']);
    }
}
