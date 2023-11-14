     <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        class CreateProductsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create('products', function (Blueprint $table) {
                    $table->id();
                    $table->string('thumbnail', 255);
                    $table->string('name', 50);
                    $table->integer('price');
                    $table->integer('quantity')->default(0);
                    $table->unsignedBigInteger('cat_id');
                    $table->unsignedBigInteger('user_id');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                    $table->string('status')->default('Còn hàng');
                    $table->string('categories', 50);
                    $table->softDeletes();
                    $table->timestamps();
                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists('products');
            }
        }
