use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key, AUTO_INCREMENT
            $table->integer('user_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('question_id')->nullable();
            $table->integer('total_questions')->nullable();
            $table->string('answer', 255)->nullable();
            $table->enum('correct_answer', ['true', 'false'])->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
}
