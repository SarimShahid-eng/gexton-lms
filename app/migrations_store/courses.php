use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_title', 50)->nullable();
            $table->text('course_description')->nullable();
            $table->string('Duration', 60)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->bigInteger('session_year_id')->nullable();
            $table->time('test_time')->default('00:00:00');
            $table->integer('questions_limit')->default(1);

            $table->timestamps(); // created_at and updated_at (optional, but recommended)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
}
