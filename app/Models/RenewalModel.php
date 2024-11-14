<?php

namespace App\Models;
use CodeIgniter\Model;

class RenewalModel extends Model
{
    protected $table = 'renewals';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'enrollment_id', 'renew_date', 'months', 'new_expiry_date', 'renewal_amount'
    ];
}
