use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomSessionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('custom_sessions', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key, AUTO_INCREMENT
            $table->string('session_year', 40)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->tinyInteger('is_selected', false, true)->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_sessions');
    }
}
