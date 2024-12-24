<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulairebar extends Model
{
    use HasFactory;

    protected $fillable=[
        "compagnie_id",
        "trimestre",
        "users_id",
    ];
    public function compagnie()
    {
        return $this->belongsTo(Compagnie::class);
    }
    public function barometres()
    {
        return $this->hasOne(Barometre::class, 'formulairebars_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function notification()
    {
        return $this->hasOne(Notification::class, 'formulairebars_id');
    }
    
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', $value)->firstOrFail();
    }
    // Méthode qui vérifie si le Mensuel est en mode "Édition"  
    // public function getEditionAttribute() {  
    //     // Retourne true si vactivite ou cacircuits existe  
    //     return $this->barometres != null;  
    // }  

    // Méthode qui vérifie si le Mensuel est "Renseigné"  
    public function getEstRenseigneAttribute() {  
        // Retourne true seulement si vactivite et cacircuits existent  
        return $this->barometres != null;  
    } 
    public function getIsReadAttribute()
    {
        return $this->notification && $this->notification->read_at != null;
    }
}
