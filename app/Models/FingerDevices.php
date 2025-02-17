<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property mixed $name
 * @property mixed $ip
 */
class FingerDevices extends Model

{

    use HasFactory, SoftDeletes;



    protected $fillable = [

        "name",

        "ip",

        "serialNumber",

    ];

}

