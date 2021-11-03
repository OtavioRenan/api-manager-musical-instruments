<?php
declare(strict_types=1);

namespace Tests\Api\Routes;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\UserModel;
use Tests\TestCase;

/**
 * @group user
 */
class UserRouteTest extends TestCase
{
    use DatabaseMigrations;

    private $route = '/api/user/';

    /** @test */
    public function route_need_autentication()
    {
        $response = $this->call('GET', $this->route);
        $this->assertEquals($response->getStatusCode(), 401);

        $json = json_decode($response->getContent(), true);
        $this->assertEquals($json['message'], 'Token não informado.');
    }

    /** @test */
    public function access_route_get_not_return_datas()
    {
        $factory = [];

        $this->withoutMiddleware();

        $response = $this->call('GET', $this->route);

        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals($response->getData(), $factory);
    }

    /** @test */
    public function access_route_get_return_datas()
    {
        $factory = $this->factory();

        $this->withoutMiddleware();

        $response = $this->call('GET', $this->route);
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals((array)$response->getData()[0], $factory[0]);
    }

    /** @test */
    public function access_route_find_not_return_datas()
    {
        $this->withoutMiddleware();

        $response = $this->call('GET', $this->route . 1);
        $this->assertEquals($response->getStatusCode(), 400);
    }

    /** @test */
    public function access_route_find_return_datas()
    {
        $factory = $this->factory();

        $this->withoutMiddleware();

        $response = $this->call('GET', $this->route . $factory[0]['id']);
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals((array)$response->getData(), $factory[0]);
    }

    private function factory() : Array
    {
        $model = UserModel::factory()->create();
        return [
            [
                'id' => $model->id,
                'name' => $model->name,
                'login' => $model->login,
            ]
        ];
    }
}
