<?php
// app/Models/TransaksiD.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiD extends Model
{
    use HasFactory;
    protected $fillable = ['id_transaksi_h', 'kd_barang', 'nama_barang', 'qty', 'subtotal'];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiH::class, 'id_transaksi_h');
    }
}
