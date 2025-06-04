use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->mediumIncrements('id'); // UNSIGNED mediumint AUTO_INCREMENT
            $table->string('name', 20);
            $table->string('description', 100);
            $table->bigInteger('session_year_id')->nullable();
            $table->integer('is_completed')->default(0);

            $table->timestamps(); // created_at and updated_at (optional)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
}
