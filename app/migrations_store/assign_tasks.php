use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYourTableNameHere extends Migration
{
    public function up(): void
    {
        Schema::create('assign_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id')->nullable();
            $table->integer('task_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->dateTime('assign_date')->nullable();
            $table->dateTime('last_date')->nullable();
            $table->integer('session_year_id')->nullable();
            $table->enum('task_status', ['assigned', 'submitted'])->default('assigned');
            $table->unsignedInteger('student_id')->nullable();
            $table->string('download_link', 199)->nullable();
            $table->text('reason')->nullable();
            $table->integer('obtanied_marks')->nullable(); // Consider renaming to 'obtained_marks' for spelling.
            $table->longText('Teacher_remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assign_tasks');
    }
}
