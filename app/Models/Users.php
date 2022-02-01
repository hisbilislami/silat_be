<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $no_telepon
 * @property string $nip
 * @property string $username
 * @property string $deleted_at
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Information[] $information
 * @property Information[] $information
 * @property MApplicant[] $mApplicants
 * @property MDepartement[] $mDepartements
 * @property MDepartement[] $mDepartements
 * @property MDepartementService[] $mDepartementServices
 * @property MDepartementService[] $mDepartementServices
 * @property MEmployeeOccupation[] $mEmployeeOccupations
 * @property MEmployeeOccupation[] $mEmployeeOccupations
 * @property MEmployeeOccupation[] $mEmployeeOccupations
 * @property MOccupation[] $mOccupations
 * @property MOccupation[] $mOccupations
 * @property MPrerequisite[] $mPrerequisites
 * @property MPrerequisite[] $mPrerequisites
 * @property MService[] $mServices
 * @property MService[] $mServices
 * @property MServicePrerequisite[] $mServicePrerequisites
 * @property MServicePrerequisite[] $mServicePrerequisites
 * @property TEvent[] $tEvents
 * @property TEvent[] $tEvents
 * @property TRegulation[] $tRegulations
 * @property TRegulation[] $tRegulations
 * @property TRunningText[] $tRunningTexts
 * @property TRunningText[] $tRunningTexts
 * @property TService[] $tServices
 * @property TService[] $tServices
 * @property TServiceDetail[] $tServiceDetails
 * @property TServiceDetail[] $tServiceDetails
 * @property TServiceDetail[] $tServiceDetails
 * @property TServicePrerequisite[] $tServicePrerequisites
 * @property TServicePrerequisite[] $tServicePrerequisites
 * @property TSuggestion[] $tSuggestions
 * @property TTutorial[] $tTutorials
 * @property TTutorial[] $tTutorials
 */
class Users extends Model
{
    use SoftDeletes;

    protected $table = 'users';
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'email_verified_at', 'password', 'no_telepon', 'nip', 'username', 'deleted_at', 'remember_token', 'created_at', 'updated_at'];


    public function get($limit, $page, $query)
    {
        $result = $this::where(function ($q) use ($query) {
            $q->where(DB::raw('lower(name)'), 'like', '%' . $query . '%')
                ->orWhere(DB::raw('lower(email)'), 'like', '%' . $query . '%')
                ->orWhere(DB::raw('lower(no_telepon)'), 'like', '%' . $query . '%')
                ->orWhere(DB::raw('lower(nip)'), 'like', '%' . $query . '%')
                ->orWhere(DB::raw('lower(username)'), 'like', '%' . $query . '%')
                ->get();
        });
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
