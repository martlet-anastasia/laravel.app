<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Image extends Model
    {
        protected $table = 'imageable';

        public function imageable() {
            return $this->morphTo();
        }

        use HasFactory;
    }
