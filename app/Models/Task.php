<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // membuat nama model yang berbeda dengan nama tabel
    protected $table = 'task';

    // bagian yang harus diisi 
    protected $fillable = ['task', 'user'];

    // bagian yang tidak diisi
    protected $guarded = ['id'];

}
