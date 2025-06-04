use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key, AUTO_INCREMENT
            $table->bigInteger('session_year_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('total_marks')->nullable();
            $table->integer('marks_obt')->nullable();
            $table->integer('student_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
}
