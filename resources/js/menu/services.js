$(document).ready(function () {
    const $serviceModel = $('#servicesModal');
    const $orderButton  = $('.orderButton');
    let services        = getServices();

    $orderButton.on('click', function (el) {
        let $currentButton = $(el.currentTarget);
        let serviceId        = $currentButton.data('service-id');
        let service          = getServiceById(serviceId, services);

        let $modalTitle = $serviceModel.find('.modal-title');
        let $modalBody  = $serviceModel.find('.modal-body')

        $modalTitle.html(service.name);
        $modalBody.find('.service-description').html(service.description);
        $modalBody.find('#service-price').html(service.price + 'руб.');
    });

});

/**
 * @param id
 * @param services
 * @return null|object
 */
function getServiceById(id, services) {
    let service = services.filter(function (service) {
        return service.id === id;
    });

    return (service.length !== 0) ? service[0] : null;
}

/**
 * @returns {jQuery|*}
 */
function getServices() {
    return $('script#services').data('services');
}
