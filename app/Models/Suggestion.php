<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property integer $m_departement_id
 * @property integer $updated_by
 * @property string $suggest
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property MDepartement $mDepartement
 */
class Suggestion extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 't_suggestion';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['m_departement_id', 'updated_by', 'suggest', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mDepartement()
    {
        return $this->belongsTo('App\Models\MDepartement');
    }

    public function get($limit, $page, $query)
    {
        $result = $this::join('m_departement', 't_suggestion.m_departement_id', '=', 'm_departement.id')
            ->where(DB::raw('lower(suggest)'), 'like', '%' . $query . '%')
            ->orWhere(DB::raw('lower(name)'), 'like', '%' . $query . '%');
        return $result->paginate($limit, '*', 'page', $page);
    }

    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    public function updateData($data)
    {
        return $this::where('id', $data['id'])->update($data);
    }

    public function deleteData($data)
    {
        return $this::where('id', $data['id'])->delete();
    }
}
