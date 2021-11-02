<?php

namespace App\Exceptions;

use App\Traits\Utils;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Utils;
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function render($request, Throwable $e) {
        if ($e instanceof NotFoundHttpException) {
            return $this->responses('No esta la url que buscas', 404, true);
        }
        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->responses('El metodo no esta disponible', 404, true);
        }
        if ($e instanceof ModelNotFoundException) {
            $modelo = class_basename($e->getModel());
            return $this->responses("No existe Ninguna Instancia de {$modelo} con el id espeficico", 404, true);
        }
        if ($e instanceof HttpResponseException) {
            return $this->responses($e->getResponse(), 400, true);
        } 
        if ($e instanceof AuthenticationException) {
            return $this->responses($e->getMessage(), 401, true);
        }
        if ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }
        if ($e instanceof QueryException) {//para db
            $code = $e->errorInfo[1];
            if ($code == 1451 ) {
                return $this->responses('Tiene relación borra antes sus items', 409, true);
            } 
        }
        return $this->responses($e->getMessage(), 500, true);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        
        return $this->responses($errors, 422, true);
    }
}
