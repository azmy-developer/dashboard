<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function successfulRequest(
        ?string $route = null,
        ?array $routeParams = [],
        bool $asJson = false
    ): RedirectResponse|JsonResponse {

        if ($asJson) {
            return response()->json([
                'status'  => true,
                'message' => __('dash.request_executed_successfully'),
            ]);
        }
        toast(t_('Request executed successfully'), 'success');
        if (\Route::is('dashboard.core.administration.profile.update')){
            return redirect()->route('dashboard.core.administration.profile.edit', auth()->user()->id)->with('success', __('dash.successful_operation'));
        }
        return redirect()->route($route ?: "{$this->path}.index", $routeParams)->with('success', __('dash.successful_operation'));
    }
}
