
- table Role 1 :

    public function administrateurs()
    {
        return $this->hasMany(administrateur::class, 'id_Role');
    }


- table administrateur 1..* :

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_Role');
    }