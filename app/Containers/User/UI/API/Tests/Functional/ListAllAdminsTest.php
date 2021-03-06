<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;

/**
 * Class ListAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllAdminsTest extends TestCase
{

    protected $endpoint = 'get@v1/admins';

    protected $access = [
        'roles'       => '',
        'permissions' => 'list-users',
    ];

    public function testListAllAdmins_()
    {
        // create some non-admin users
        $user1 = factory(User::class)->create();
        $adminRole = Role::where('name', 'admin')->first();
        $user1->assignRole($adminRole);

        $user2 = factory(User::class)->create();
        $adminRole = Role::where('name', 'admin')->first();
        $user2->assignRole($adminRole);

        // should not be returned
        factory(User::class)->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        $this->assertCount(3,
            $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }

    public function testListAllAdminsByNonAdmin_()
    {
        $this->getTestingUserWithoutAccess();

        // create some fake users
        factory(User::class, 2)->create();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(403);

        $this->assertResponseContainKeyValue([
            'errors' => 'You have no access to this resource!',
            'message' => 'This action is unauthorized.',
        ]);
    }

}
