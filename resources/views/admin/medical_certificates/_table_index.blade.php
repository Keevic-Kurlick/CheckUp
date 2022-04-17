@php
/**
 * @var \App\Models\MedicalCertificate[] $medicalCertificates
 */
@endphp
<div class="medical_certificates_table">
    <table class="table mt-3 table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Наименование</th>
            <th scope="col">Описание</th>
            <th scope="col">Создано</th>
            <th scope="col">Обновлено</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($medicalCertificates as $medicalCertificate)
            <tr class="medical_certificates-block">
                <td>
                    {{ $medicalCertificate->id }}
                </td>
                <td>
                    {{ $medicalCertificate->name }}
                </td>
                <td>
                    {{ $medicalCertificate->description }}
                </td>
                <td>
                    {{ $medicalCertificate->created_at }}
                </td>
                <td>
                    {{ $medicalCertificate->updated_at }}
                </td>
                <td>
                    <div class="row">
                        <div class="col-6 medical_certificates-block-edit">
                            <a href="{{ route('admin.medical_certificates.edit', $medicalCertificate->id) }}">
                                <i class="fas fa-edit icon-edit active"></i>
                            </a>
                        </div>
                        <div class="col-6 medical_certificates-block-destroy">
                            <i class='fas fa-trash-alt icon-remove destroy-button active' data-medical_certificates-id="{{ $medicalCertificate->id }}"></i>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr class="empty-table-data">
                <td colspan="2">Нет данных</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $medicalCertificates->links() }}
</div>