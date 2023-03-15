<?php
    function is_user_got_access($mod){
        $bdd = Data::getInstance();
        $isAdmin = $bdd->squery("SELECT 1 FROM t_user WHERE id=".$_SESSION[SESSION_NAME]['id_user']." AND isAdmin=1");
        if($isAdmin)
            return true;
        $id_mod = $bdd->squery("SELECT id FROM t_mod WHERE nom='".$mod."'");
        if($id_mod) {
            $got_right = $bdd->squery("SELECT 1 FROM t_user_mod WHERE fk_user=" . $_SESSION[SESSION_NAME]['id_user'] . " AND fk_mod=" . $id_mod);
            return $got_right;
        }else{
            return false;
        }
    }
