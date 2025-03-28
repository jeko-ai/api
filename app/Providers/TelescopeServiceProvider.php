<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();

        $isLocal = app()->environment('local') ||
            app()->environment('dev') ||
            app()->environment('stage') ||
            app()->hasDebugModeEnabled();

        Telescope::filter(function (IncomingEntry $entry) use ($isLocal) {
            return $isLocal ||
                $entry->isReportableException() ||
                $entry->isFailedRequest() ||
                $entry->isFailedJob() ||
                $entry->isScheduledTask() ||
                $entry->hasMonitoredTag();
        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     */
    protected function hideSensitiveRequestDetails(): void
    {
        $isLocal = app()->environment('local') ||
            app()->environment('dev') ||
            app()->environment('stage') ||
            app()->hasDebugModeEnabled();

        if ($isLocal) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        $isLocal = app()->environment('local') ||
            app()->environment('dev') ||
            app()->environment('stage') ||
            app()->hasDebugModeEnabled();

        Gate::define('viewTelescope', function ($user) use ($isLocal) {
            return in_array($user->email, [
                //
                ]) || $isLocal;
        });
    }
}
