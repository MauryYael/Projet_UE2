<?php

namespace App\Utils;

trait Hydrator
{
 
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
        
          
            $methodName = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

        
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }
    }
}