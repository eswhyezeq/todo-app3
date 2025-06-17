<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status', 'user_id'];
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->integer('user_id');
            $table->enum('status', ['pending','completed']);
            $table->timestamps();
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
