<?php

namespace App\Models;

use App\Models\SaleDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_name',
        'discount',
        'total'
    ];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetails::class, 'sale_id');
    }
}
