<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table      = 'students';  // The name of the table
    protected $primaryKey = 'id';        // The primary key for the table

    // List the fields that can be inserted into the database
    protected $allowedFields = ['fullname', 'dob', 'email', 'contact_number', 'address',  'photo'];

    // Automatically handles created_at and updated_at fields
    protected $useTimestamps = true;
}
