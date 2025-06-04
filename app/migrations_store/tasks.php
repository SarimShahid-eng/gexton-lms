use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key, AUTO_INCREMENT
            $table->integer('session_year_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->string('task_title', 40)->nullable();
            $table->text('task_description')->nullable();
            $table->string('number_of_days', 20)->nullable();
            $table->integer('total_marks');
            $table->string('attachment_link', 199)->nullable();
            $table->string('group_name', 200)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
}
