<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VisitorModel extends Model
{
    use HasFactory;
    protected $table = "visitor";
    protected $primaryKey = "id_visitor";
    protected $fillable = [
        'id_user','created_at'
    ];

    public function simpanVisitor($data) 
    {
        DB::table('visitor')->insert($data);
    }
}
