<?php
declare(strict_types=1);

namespace Tests\Api\Routes;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\LogModel;
use Tests\TestCase;

/**
 * @group log
 */
class LogRouteTest extends TestCase
{
    use DatabaseMigrations;

    private $route = '/api/log/';

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
        $model = LogModel::factory()->create();

        return [
            [
                'systemLogableId' => $model->system_logable_id,
                'systemLogableYype' => $model->system_logable_type,
                'userId' => $model->user_id,
                'guardName' => $model->guard_name,
                'action' => $model->action,
                'oldValue' => (!is_null($model->old_value)) ? json_decode((string)$model->old_value) : null,
                'newValue' => (!is_null($model->new_value)) ? json_decode((string)$model->new_value) : null,
                'ipAddress' => $model->ip_address,
            ]
        ];
    }
}
