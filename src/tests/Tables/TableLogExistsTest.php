<?php
declare(strict_types=1);

namespace Tests\Tables;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Models\LogModel;

/**
 * @group log
 */
class TableLogExistsTest extends TestCase
{
    use DatabaseMigrations;
    
    protected $model;

    public function setUp() : void
    {
        parent::setUp();
        
        $this->model = new LogModel();
    }

    /** @test */
    public function table_exists_and_equal_model()
    {
        $this->assertTrue(Schema::hasTable($this->model->getTable()));
    }

    /** @test */
    public function columns_exists_and_name_column_equal_fillables()
    {
        foreach($this->model->getfillable() as $column)
        {
            $this->assertTrue(Schema::hasColumn($this->model->getTable(), $column));
        }
    }
}
