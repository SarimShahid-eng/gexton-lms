use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYourTableNameHere extends Migration
{
    public function up(): void
    {
        Schema::create('batch_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->time('from')->nullable();
            $table->time('to')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->bigInteger('session_year_id')->nullable();
            $table->string('group_name', 50)->nullable();
            $table->integer('is_completed')->default(0);

            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch_groups');
    }
}
