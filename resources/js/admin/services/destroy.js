import axios from 'axios'

const iconClassTrash    = 'fa-trash-alt';
const iconClassSpinner  = 'fa-solid fa-spinner';

$(document).ready(function () {
    var $servicesDestroyButtons  = $('.destroy-button.active');

    const csrfToken = getCsrfToken();

    $servicesDestroyButtons.on('click', function (item) {
        let serviceBlockEdit    = $(item.currentTarget);

        if (!serviceBlockEdit.attr('disabled')) {
            let serviceId           = serviceBlockEdit.data('service-id');
            let url                 = 'services/' + serviceId + '/destroy';

            disabledServices($servicesDestroyButtons);
            replaceTrashToSpinner(serviceBlockEdit);

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

function disabledServices($services) {
    $services.removeClass('active');
    $services.addClass('disabled');
    $services.attr('disabled', 'disabled');
}

function getCsrfToken()
{
    let csrfToken = window.csrfToken;

    return csrfToken;
}