<?php

namespace App\Models;

/**
 * Backward compatibility alias for Department
 */
class Division extends Department
{
    protected $table = 'departments';
}
