<?php

use App\Http\Middleware\AdminLanguageMiddleware;
use App\Http\Middleware\Cors;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\ForceJsonResponse;
use App\Http\Middleware\ForceLanguageMiddleware;
use App\Http\Middleware\LanguageMiddleware;
use App\Http\Middleware\ProAjaxMiddleware;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Middleware\RemoveSearchTermParamFromRequest;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\ToSweetAlert;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

return Application::configure(basePath: dirname(__DIR__))
                  ->withRouting(
                      web: [
                          __DIR__ . '/../routes/web.php',
                          __DIR__ . '/../routes/admin.php',
                      ],
                      commands: __DIR__ . '/../routes/console.php',
                      health: '/up',
                  )
                  ->withMiddleware(callback: function (Middleware $middleware) {
                      $middleware->appendToGroup('web', [
                          EncryptCookies::class,
                          VerifyCsrfToken::class,
                          ToSweetAlert::class,
                          ProAjaxMiddleware::class,
                      ]);
                      $middleware->alias([
                          'locale'             => LanguageMiddleware::class,
                          'locale.admin'       => AdminLanguageMiddleware::class,
                          'force.language'     => ForceLanguageMiddleware::class,
                          'admin'              => RedirectIfNotAdmin::class,
                          'remove.search.term' => RemoveSearchTermParamFromRequest::class,
                          'json.response'      => ForceJsonResponse::class,
                          'cors'               => Cors::class,
                      ]);
                  })
                  ->withExceptions(function (Exceptions $exceptions) {
                      $exceptions->renderable(function (Throwable $exception, Request $request) {
                          if ($request->expectsJson() && $request->is("api/*")) {
                              if (config('app.env') === 'local') {
                                  return null;
                              }

                              if ($exception instanceof NotFoundHttpException) {
                                  return response()->json([
                                      'message'     => __('exception.address_not_found'),
                                      'serverError' => $exception->getMessage(),
                                  ], $exception->getStatusCode());
                              }

                              if ($exception instanceof TooManyRequestsHttpException) {
                                  return response()->json([
                                      'message'     => __('exception.too_many_requests'),
                                      'serverError' => $exception->getMessage(),
                                  ], $exception->getStatusCode());
                              }

                              if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                                  return response()->json([
                                      'message'     => $exception->getMessage(),
                                      'serverError' => $exception->getMessage(),
                                  ], $exception->getStatusCode());
                              }

                              if ($exception instanceof ModelNotFoundException) {
                                  return response()->json([
                                      'message'     => __('exception.data_not_found'),
                                      'serverError' => $exception->getMessage(),
                                  ], 404);
                              }

                              if ($exception instanceof ValidationException) {
                                  return response()->json([
                                      'message' => $exception->getMessage() ?: __('exception.invalid_data_is_sent'),
                                      'errors'  => $exception->validator->errors(),
                                  ], $exception->status);
                              }

                              if ($exception instanceof AuthenticationException) {
                                  return response()->json([
                                      'message'     => __('auth.unauthenticated'),
                                      'serverError' => $exception->getMessage(),
                                  ], 401);
                              }

                              if ($exception instanceof BadMethodCallException) {
                                  return response()->json([
                                      'message'     => __('exception.calling_function_failed'),
                                      'serverError' => $exception->getMessage(),
                                  ], 500);
                              }

                              if ($exception instanceof ErrorException || $exception instanceof Error) {
                                  return response()->json([
                                      'message'     => __('exception.server_side_error'),
                                      'serverError' => $exception->getMessage(),
                                  ], 500);
                              }

                              if ($exception instanceof BadRequestException) {
                                  return response()->json([
                                      'message'     => __('exception.invalid_request_sent'),
                                      'serverError' => $exception->getMessage(),
                                  ], 400);
                              }

                              if ($exception instanceof AuthorizationException) {
                                  return response()->json([
                                      'message'     => __('exception.unauthorized'),
                                      'serverError' => $exception->getMessage(),
                                  ], 403);
                              }

                              try {
                                  $code = method_exists($exception, 'getStatusCode')
                                      ? $exception->getStatusCode()
                                      : (method_exists($exception, 'getCode')
                                          ? $exception->getCode()
                                          : 500);

                                  return response()->json([
                                      'code'        => $code,
                                      'message'     => $exception->getMessage(),
                                      'serverError' => null,
                                  ], 500);
                              } catch (Exception $e) {
                                  return response()->json([
                                      'message'     => __('exception.unexpected_error'),
                                      'serverError' => $e->getMessage(),
                                      'errors'      => $e->getTrace(),
                                  ], 500);
                              }
                          }

                          return null;
                      });
                  })->create();
