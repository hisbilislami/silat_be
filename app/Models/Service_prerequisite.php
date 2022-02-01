<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property integer $t_service_id
 * @property integer $m_prerequisite_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $file
 * @property string $status
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property MPrerequisite $mPrerequisite
 * @property User $user
 * @property User $user
 * @property TService $tService
 */
class Service_prerequisite extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 't_service_prerequisite';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['t_service_id', 'm_prerequisite_id', 'created_by', 'updated_by', 'file', 'status', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mPrerequisite()
    {
        return $this->belongsTo('App\Models\MPrerequisite');
    }

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
    public function tService()
    {
        return $this->belongsTo('App\Models\TService');
    }

    public function get($limit, $page, $query)
    {   
        $result = $this::select('file','status','m_prerequisite.name as prerequisite_name','m_departement.name as departement_name','m_service.name as service_name','m_applicant.name as applicant_name', 'm_applicant.nik as applicant_nik')
        ->join('t_service', 't_service_prerequisite.t_service_id', '=', 't_service.id')
        ->join('m_departement', 't_service.m_departement_id', '=', 'm_departement.id')
        ->join('m_service', 't_service.m_service_id', '=', 'm_service.id')
        ->join('m_applicant', 't_service.m_applicant_id', '=', 'm_applicant.id')
        ->join('m_prerequisite', 't_service_prerequisite.m_prerequisite_id', '=', 'm_prerequisite.id')
        ->where(DB::raw('lower(status)'), 'like', '%'.$query.'%')
        ->orHaving(DB::raw('lower(prerequisite_name)'), 'like', '%' . $query . '%')
        ->orHaving(DB::raw('lower(departement_name)'), 'like', '%' . $query . '%')
        ->orHaving(DB::raw('lower(applicant_name)'), 'like', '%' . $query . '%')
        ->orHaving(DB::raw('lower(applicant_nik)'), 'like', '%' . $query . '%')
        ->orHaving(DB::raw('lower(service_name)'), 'like', '%' . $query . '%');
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
