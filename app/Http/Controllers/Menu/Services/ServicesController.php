<?php

namespace App\Http\Controllers\Menu\Services;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Admin\ServiceRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use function __;
use function redirect;
use function toastr;
use function view;

class ServicesController extends Controller
{
    /**
     * @param ServiceRepository $serviceRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        private ServiceRepository $serviceRepository,
        private UserRepository $userRepository
    ) {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function servicesList(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $services = Service::all()->toBase();

        return view('layouts.menu.services.index', compact('services'));
    }

    /**
     * @param int $serviceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(int $serviceId)
    {
        $service    = $this->serviceRepository->getServiceToShow($serviceId);
        $user       = null;

        if (empty($service)) {
            $notifyMessage = __("pages.services.show.not_found");
            toastr()->error($notifyMessage);

            return redirect()->route('menu.services.list');
        }

        $currentUser = Auth::user();

        if (!empty($currentUser)) {
            $user = $this->userRepository->getUserToShowServiceById($currentUser->id);
        }

        return view('layouts.menu.services.show', compact('service', 'user'));
    }
}
