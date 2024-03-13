<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => $this->getAuth($request),
            'ziggy' => fn () => $this->getZiggy($request),
            'lang' => fn () => $this->getTranslations(),
        ];
    }

    private function getAuth(Request $request): array
    {
        return [
            'user' => $request->user(),
        ];
    }

    private function getZiggy(Request $request): array
    {
        return [
            ...(new Ziggy)->toArray(),
            'location' => $request->url(),
        ];
    }

    private function getTranslations(): array
    {
        $storage = Storage::disk('languages');
        $directories = $storage->directories();
        foreach ($directories as $directory) {
            $translations = [];
            $files = $storage->allFiles($directory);

            foreach ($files as $file) {
                $fileName = str_replace('.php', '', basename($file));
                $fileContent = require $storage->path($file);
                $translations[$fileName] = $fileContent;
            }

            return $translations;
        }

        return [];
    }
}
