<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parking_overviews';

    protected $primaryKey = 'identifier';

    protected $fillable = ['identifier'];

}