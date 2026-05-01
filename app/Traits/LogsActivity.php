<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Log an administrative action.
     */
    protected function logActivity(string $action, ?string $model = null, $modelId = null, ?string $details = null)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model' => $model,
            'model_id' => $modelId,
            'details' => $details,
            'ip_address' => request()->ip(),
        ]);
    }
}
