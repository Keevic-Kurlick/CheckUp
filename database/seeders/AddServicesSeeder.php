<?php

namespace Database\Seeders;

use App\Models\MedicalCertificate;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddServicesSeeder extends Seeder
{
    /**
     * @throws \Throwable
     */
    public function run()
    {
        DB::beginTransaction();

        $servicesInfo = [
            [
                'med_sert' => [
                    'name'          => 'Справка для бассейна',
                    'description'   => 'Справка формы 083/4-89',
                ],
                'service' => [
                    'name'          => 'Справка для бассейна',
                    'description'   => 'Медицинская справка в бассейн нужна для подтверждения того, что её предъявитель
                                        не страдает от заболеваний, которые передаются контактным путём: дерматита,
                                        грибка, гельминтоза и других.Медицинская справка в бассейн нужна для
                                        подтверждения того, что её предъявитель не страдает от заболеваний, которые
                                        передаются контактным путём: дерматита, грибка, гельминтоза и других.
                                        Для получения справки необходимы:
                                        Заключение врача терапевта или педиатра;
                                        При необходимости: заключения дерматолога, венеролога, гинеколога.',
                    'price'         => 600
                ],
            ],
            [
                'med_sert' => [
                    'name'          => 'Справка 086/у',
                    'description'   => 'Справка о состоянии текущего здоровья ребенка формы 086/у',
                ],
                'service' => [
                    'name'          => 'Справка 086/у',
                    'description'   => 'Описание: Справка о состоянии текущего здоровья ребенка формы 086/у – это
                                        документ установленного образца, в котором: указаны результаты последнего
                                        профосмотра, зафиксированы все проведенные прививки, представлена общая информация
                                        о болезнях, травмах или операциях, которые ранее перенес учащийся.
                                        Для получения справки необходимы:
                                        Заключения невролога, ЛОРа, офтальмолога, педиатра, гениколога;
                                        Результаты исследований: ЭКГ, флюорография, ОАК, анализ мочи',
                    'price'         => 500
                ],
            ],
            [
                'med_sert' => [
                    'name'          => 'Справка 003-В/у',
                    'description'   => 'Справка для получения прав на вождение',
                ],
                'service' => [
                    'name'          => 'Справка 003-В/у',
                    'description'   => 'Справка 003-В/у - это медсправка для получения или замены прав.
                                        Для получения прав категории  А, А1, В, В1, ВЕ, М необходимы заключения
                                        терапевта, офтальмолога, психиатра, психиатра-нарколога, невролога.
                                        Для получения прав категории С, C1, CE, D, D1, DE, D1E, Tm, Tb необходимы
                                        заключения терапевта, офтмальмолога, оториноларинголога, психиатра,
                                        психиатра-нарколога, невролога.' ,
                    'price'         => 800
                ],
            ],
            [
                'med_sert' => [
                    'name'          => 'Справка №079/у',
                    'description'   => 'Медицинская справка формы 079/у для отъезжающих в лагерь',
                ],
                'service' => [
                    'name'          => 'Справка №079/у',
                    'description'   => 'Назначение справки — обеспечить медицинский персонал лагеря всей необходимой
                                        информацией о состоянии здоровья ребенка, прибывшего на отдых и оздоровление.
                                        Эти данные дадут возможность работникам лагеря обеспечить правильный режим отдыха
                                        и оздоровительных мероприятий, подобрать индивидуальную физическую нагрузку для ребенка.
                                        Необходимые анализы: общеклинические анализы крови и мочи, анализ кала на яйца
                                        гельминтов и на энтеробиоз.
                                        Необходимы заключения: врача-хирурга, врача-дерматолога, педиатра',
                    'price'         => 1000
                ],
            ],
        ];

        $this->createServices($servicesInfo);

        DB::commit();
    }

    /**
     * @param $servicesInfo
     */
    private function createServices($servicesInfo) {

        foreach ($servicesInfo as $item) {
            $medCertInfo    = $item['med_sert'];
            $serviceInfo    = $item['service'];

            $medicalCertificate                 = new MedicalCertificate();
            $medicalCertificate->name           = $medCertInfo['name'];
            $medicalCertificate->description    = $medCertInfo['description'];
            $medicalCertificate->save();

            $service                        = new Service();
            $service->name                  = $serviceInfo['name'];
            $service->description           = $serviceInfo['description'];
            $service->price                 = $serviceInfo['price'];
            $service->medical_certificate   = $medicalCertificate->id;
            $service->save();
        }
    }
}
