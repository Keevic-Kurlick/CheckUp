<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

class AddBasicRoles extends Migration
{

    /** @var array $roles */
    private array $roles = [
        Role::ROLE_PATIENT => 'Просмотр услуг и добавление заказов',
        Role::ROLE_DOCTOR => 'Обработка заказов',
        Role::ROLE_ADMIN => 'Работа со справками и услугами, назначение ролей',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->roles as $roleName => $roleRight) {
            $role = new Role();
            $role->name = $roleName;
            $role->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::whereIn('name', $this->roles)
            ->delete();
    }
}
