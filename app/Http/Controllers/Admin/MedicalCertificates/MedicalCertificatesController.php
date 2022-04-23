<?php

namespace App\Http\Controllers\Admin\MedicalCertificates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MedicalCertificates\StoreMedicalCertificateRequest;
use App\Http\Requests\Admin\MedicalCertificates\UpdateMedicalCertificateRequest;
use App\Repositories\Admin\MedicalCertificateRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MedicalCertificatesController extends Controller
{
    /**
     * @param MedicalCertificateRepository $medicalCertificateRepository
     * @param MedicalCertificatesManager $medicalCertificatesManager
     */
    public function __construct(
        private MedicalCertificateRepository $medicalCertificateRepository,
        private MedicalCertificatesManager $medicalCertificatesManager
    ) {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $medicalCertificates = $this->medicalCertificateRepository->getMedicalCertificatesToIndex();

        return view('admin.medical_certificates.index', compact('medicalCertificates'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.medical_certificates.create');
    }

    /**
     * @param StoreMedicalCertificateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(StoreMedicalCertificateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $notifyMessageStatus = 'success';

        try {
            $this->medicalCertificatesManager->storeMedicalCertificate($request);
        } catch (\Exception $e) {
            $notifyMessageStatus = 'error';

            Log::error('App.Http.Controllers.Admin.MedicalCertificates.MedicalCertificatesController.store',
                [
                    'data' => [
                        'message' => $e->getMessage(),
                    ],
                ]
            );
        }

        $notifyMessage = __("admin.notifications.medical_certificate.medical_certificate_was_created.{$notifyMessageStatus}");
        toastr()->$notifyMessageStatus($notifyMessage);

        return redirect()->route('admin.medical_certificates.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|View
     */
    public function edit(int $id)
    {
        try {
            $medicalCertificate = $this->medicalCertificateRepository->getMedicalCertificatesToEdit($id);

            $response = view('admin.medical_certificates.edit', compact('medicalCertificate'));
        } catch (\Exception $e) {

            $response = redirect()->route('admin.medical_certificates.index');

            $notifyMessage = __("admin.notifications.medical_certificate.medical_certificate_not_found");
            toastr()->warning($notifyMessage);

            Log::error('App.Http.Controllers.Admin.MedicalCertificates.MedicalCertificatesController.edit',
                [
                    'data' => [
                        'message' => $e->getMessage(),
                    ],
                ]
            );
        }

        return $response;
    }

    /**
     * @param UpdateMedicalCertificateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function update(UpdateMedicalCertificateRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $notifyMessageStatus = 'success';

        try {
            $this->medicalCertificatesManager->updateMedicalCertificateById($request, $id);
        } catch (\Exception $e) {

            $notifyMessageStatus = 'error';

            Log::error('App.Http.Controllers.Admin.MedicalCertificates.MedicalCertificatesController.update',
                [
                    'data' => [
                        'message' => $e->getMessage(),
                    ],
                ]
            );
        }

        $notifyMessage = __("admin.notifications.medical_certificate.medical_certificate_was_updated.{$notifyMessageStatus}");
        toastr()->$notifyMessageStatus($notifyMessage);

        return redirect()->route('admin.medical_certificates.index');
    }

    /**
     * @param $id
     * @return void
     * @throws \Throwable
     */
    public function destroy(int $id) {
        $notifyMessageStatus = 'success';

        try {
            $this->medicalCertificatesManager->destroyMedicalCertificate($id);
        } catch (\Exception $e) {
            $notifyMessageStatus = 'error';

            Log::error('App.Http.Controllers.Admin.MedicalCertificates.MedicalCertificatesController.destroy',
                [
                    'data' => [
                        'message' => $e->getMessage(),
                    ],
                ]
            );
        }

        $notifyMessage = __("admin.notifications.medical_certificate.medical_certificate_was_destroyed.{$notifyMessageStatus}");
        toastr()->$notifyMessageStatus($notifyMessage);
    }
}