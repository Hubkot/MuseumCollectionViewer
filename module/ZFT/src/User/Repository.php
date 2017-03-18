<?php

/*  Mit License

  /**
 * Description of Repository
 *
 * @author hubert
 */
namespace ZFT\User;

use ZFT\User;
class Repository {
    function __construct(IdentityMapInterface $identityMap, DataMapperInterface $dataMapper) {
        
    }
    
    public function getUserById(){
        return new User();
    }
}
