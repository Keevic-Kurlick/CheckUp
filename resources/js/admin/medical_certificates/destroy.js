import axios from 'axios'

const iconClassTrash    = 'fa-trash-alt';
const iconClassSpinner  = 'fa-solid fa-spinner';

$(document).ready(function () {
    var $medicalCertificatesDestroyButtons  = $('.destroy-button.active');

    const csrfToken = getCsrfToken();

    $medicalCertificatesDestroyButtons.on('click', function (item) {
        let $medicalCertificateBlockEdit    = $(item.currentTarget);

        if (!$medicalCertificateBlockEdit.attr('disabled')) {
            let medicalCertificateId    = $medicalCertificateBlockEdit.data('medical_certificates-id');
            let url                     = 'medical_certificates/' + medicalCertificateId + '/destroy';

            disabledMedicalCertificates($medicalCertificatesDestroyButtons);
            replaceTrashToSpinner($medicalCertificateBlockEdit);

            axios.delete(url, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            }).then(function () {
                location.reload();
            });
        }
    });
});

function replaceTrashToSpinner($element) {
    $element.removeClass(iconClassTrash);
    $element.addClass(iconClassSpinner);
}

function disabledMedicalCertificates($medicalCertificates) {
    $medicalCertificates.removeClass('active');
    $medicalCertificates.addClass('disabled');
    $medicalCertificates.attr('disabled', 'disabled');
}

function getCsrfToken()
{
    let csrfToken = window.csrfToken;

    return csrfToken;
}