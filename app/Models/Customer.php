<?php
// app/Models/Customer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers'; // Pastikan nama tabel di sini benar

    protected $fillable = ['nama', 'alamat', 'phone'];
}
