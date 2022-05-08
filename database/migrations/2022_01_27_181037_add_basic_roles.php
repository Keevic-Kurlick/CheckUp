<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

class AddBasicRoles extends Migration
{

    /** @var array $roles */
    private array $roles = [
        Role::ROLE_PATIENT,
        Role::ROLE_DOCTOR,
        Role::ROLE_ADMIN,
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->roles as $roleName) {
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
