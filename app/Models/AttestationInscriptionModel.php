<?php
namespace App\Models;

use CodeIgniter\Model;

class AttestationInscriptionModel extends Model
{
    protected $table = 'attestation_inscription';
    protected $primaryKey = 'id';
    protected $allowedFields = [ 'student_id', 'email', 'password', 'created_at'];
}
