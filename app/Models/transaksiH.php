<?php
// app/Models/TransaksiH.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiH extends Model
{
    use HasFactory;

    protected $table = 'transaksi_h'; // Pastikan nama tabel di sini benar

    protected $fillable = ['id_customer', 'nomor_transaksi', 'tanggal_transaksi', 'total_transaksi'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function detail()
    {
        return $this->hasMany(TransaksiD::class, 'id_transaksi_h');
    }
}
