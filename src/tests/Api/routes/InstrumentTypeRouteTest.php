<?php
declare(strict_types=1);

namespace Tests\Tables;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\InstrumentTypeModel;

/**
 * @group instrumentType
 */
class InstrumentTypeRouteTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function route_need_autentication()
    {
        $response = $this->call('GET', '/api/instrument-type');
        $this->assertEquals($response->getStatusCode(), 401);

        $json = json_decode($response->getContent(), true);
        $this->assertEquals($json['message'], 'Token não informado.');
    }

    /** @test */
    public function route_get_return_datas()
    {
        $this->factory();

        $this->withoutMiddleware();

        $response = $this->call('GET', '/api/instrument-type');
    }

    /** @test */
    public function route_find_return_datas()
    {

    }

    /** @test */
    public function route_save_return_datas()
    {

    }

    /** @test */
    public function route_update_return_datas()
    {

    }

    /** @test */
    public function route_delete_return_datas()
    {

    }

    private function factory() : InstrumentTypeModel
    {
        return InstrumentTypeModel::factory()->make();
    }
}
