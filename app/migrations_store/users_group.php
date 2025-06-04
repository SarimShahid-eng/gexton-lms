use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersGroupTable extends Migration
{
    public function up(): void
    {
        Schema::create('users_group', function (Blueprint $table) {
            $table->id()->unsigned(); // Primary key with unsigned integer
            $table->unsignedInteger('user_id'); // Foreign key to users table
            $table->unsignedMediumInteger('group_id'); // Group ID field

            // Adding indexes to user_id and group_id for performance optimization
            $table->index('user_id');
            $table->index('group_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_group');
    }
}
